<?php
// +----------------------------------------------------------------------
// | easy pay [ pay to easy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 All rights reserved.
// +----------------------------------------------------------------------
// | Author: fengxing <QQ:51125330>
// +----------------------------------------------------------------------
namespace Common\Logic;

class DingdanLogic extends BaseLogic {

    protected $moduleName = '订单';
    public $tzzt = array(
        0 => '未通知',
        1 => '通知失败',
        2 => '通知成功');
    public $zt = array(
        0 => '未支付',
        1 => '已支付',
        2 => '扣量');
    protected $fj = array(
        'fxattach' => '',
        'fxbackurl' => '',
        'fxnotifyurl' => '',
        'fxgoodname' => '');

    /**
     * 列表
     */
    public function index($request) {
        $map = array();
        $data = ' 1=1 ';
        //高级查询
        if ($request['userid']) {
            $request['userid'] = $request['userid'];
            $data.=' AND userid = "' . $request['userid'] . '" ';
        }
        if ($request['ordernum']) {
            $map['ordernum'] = $request['ordernum'];
            $data.=' AND ordernum = "' . $request['ordernum'] . '" ';
        }
        if ($request['jkstyle']) {
            $map['jkstyle'] = $request['jkstyle'];
            $data.=' AND jkstyle = "' . $request['jkstyle'] . '" ';
        }
        $start = $request['start'];
        if (strstr($start, '-')) {
            $start = strtotime($start);
        }
        $end = $request['end'];
        if (strstr($end, '-')) {
            $end = strtotime($end);
        }
        if ($start) {
            if (empty($end))
                $end = time();
            $map['start'] = $start;
            $map['end'] = $end;
            $request['start'] = date('Y-m-d', $start);
            $request['end'] = date('Y-m-d', $end);
            $data .= ' AND addtime between ' . ($start) . ' and ' . ($end) . ' ';
        }
        if (!is_numeric($request['status'])) {
            $request['status'] = 1;
            $_REQUEST['status'] = 1;
        }
        $map['status'] = $request['status'];
        $data.=' AND status = "' . $request['status'] . '" ';

        $titlename = $this->zt[$request['status']];

        $jiekou = SM('Jiekou')->selectData('*', '1=1', 'jkid asc');
        $jiekoubuffer = stringChange('arrayKey', $jiekou, 'jkstyle');

        $perpage = C('FX_PERPAGE'); //每页行数
        $order = SM('Dingdan');
        $count = $order->selectCount(
                $data, 'ddid'
        ); // 查询满足要求的总记录数
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $page = page($count, $request['p'], $perpage) . ',' . $perpage;

        $list = $order->pageData(
                '*', $data, 'ddid DESC', $page
        );
        foreach ($list as $i => $iList) {
            $list[$i]['addtime'] = date('Y-m-d H:i:s', $list[$i]['addtime']);
            $list[$i]['paytime'] = $list[$i]['paytime']==0 ? '无' : date('Y-m-d H:i:s', $list[$i]['paytime']);
            $list[$i]['tzzt'] = $this->tzzt[$list[$i]['tz']];
            $list[$i]['status'] = $this->zt[$list[$i]['status']];
            $list[$i]['jkstyle'] = $jiekoubuffer[$list[$i]['jkstyle']]['jkname'];
            $list[$i] = stringChange('formatMoneyByArray', $list[$i], array(
                'totalmoney',
                'havemoney'));
        }
        $pageList = $this->pageList($count, $perpage, $map);

        //统计数据 今日订单笔数 	昨日订单笔数 	今日订单总金额 	今日支出金额 	昨日订单总金额 	昨日支出金额 	历史总笔数 	历史总金额 	历史总支出
        $times = strtotime(date('Y-m-d', time()));
        $tj = array();
        $tj['today'] = $order->sumData('totalmoney', 'status>0 and addtime>=' . $times);
        $tj['paytoday'] = $order->sumData('havemoney', 'status=1 and addtime>=' . $times);
        $tj['all'] = $order->sumData('totalmoney', 'status>0');
        $tj['payall'] = $order->sumData('havemoney', 'status=1');
        foreach ($tj as $i => $iTj) {
            if (empty($iTj))
                $tj[$i] = 0;
        }

        $params = array(
            'list' => $list,
            'tj' => $tj,
            'page' => $pageList,
            'jiekou' => $jiekou,
            'pageName' => $titlename . $this->moduleName . '管理'
        );
        return [1,
            $params];
    }

    /**
     * 重新发送订单
     */
    public function edit($request) {
        if (!$request['id']) {
            return [0,
                '参数错误！'];
        }
        $order = SM('Dingdan');
        $row = $order->findData('*', 'ddid=' . $request['id']);

        $userBuffer = SM('User')->findData('*', 'userid="' . $row['userid'] . '"');
        $status = '1';
        $userid = $userBuffer["userid"];
        $key = $userBuffer["miyao"];
        $ordermoney = $row['totalmoney'];
        $ddh = $row['ordernum'];
        $fj = unserialize($row['fj']);

        $ddh = substr($ddh, strlen($userid));
        $k = md5($status . $userid . $ddh . $ordermoney . $key);
        $post_data = array(
            'fxid' => $userid,
            'fxddh' => $ddh,
            'fxdesc' => $fj['fxdesc'],
            'fxorder' => $row['preordernum'],
            'fxfee' => $ordermoney,
            'fxattach' => $fj['fxattach'],
            'fxtime' => $row['paytime'],
            'fxstatus' => $status,
            'fxsign' => $k
        );
        $str = array();
        foreach ($post_data as $k => $buffer) {
            $str[] = $k . '=' . urlencode($buffer);
        }

        $row['params'] = implode('&', $str);
        $row['notifyurl'] = $fj['fxnotifyurl'];
        $row['sigleddh'] = substr($row['ordernum'],strlen($row['userid']));

        $params = array(
            'edit' => $row,
            'act' => 'edit',
            'pageName' => '修改' . $this->moduleName
        );
        return [1,
            $params,
            'Dingdan/add'];
    }

    /**
     * 重新发送订单
     */
    public function save($request) {
        $ddh = $request['ddh'];
        $url = $request['url'];
        $params = $request['params']; //获取模板标识
        //判断数据标识
        if (empty($ddh)) {
            return [0,
                '订单号不能为空！'];
        }
        if (empty($params)) {
            return [0,
                '参数不能为空！'];
        }
        if (empty($url)) {
            return [0,
                '返回地址不能为空！'];
        }

        $dingdan = SM('Dingdan');
        $buffer = $dingdan->findData('*', 'ordernum="' . $ddh . '"');
        if (!$buffer) {
            return [0,
                '订单号不存在！'];
        }
        $params=htmlspecialchars_decode($params);
        $result = curl($url . '?' . $params);
        //返回数据正常则修改订单返回通知
        if (strtolower($result) == 'success' && $buffer['tz'] != 2) {
            $dingdan->updateData(array(
                'tz' => '2'), 'ddid="' . $buffer['ddid'] . '"');
        }
        return [1,
            $result];
    }

    /**
     * 删除
     */
    public function delete($request) {
        $orderID = $request['id']; //获取数据标识
        $clear = $request['clear']; //获取数据标识
        //清除三天以上的未支付订单
        if ($clear) {
            if (SM('Dingdan')->deleteData('addtime<' . (time() - 3*24 * 3600) . ' and status=0') === false) {
                return [0,
                    '删除失败'];
            } else {
                //写入日志
                $this->adminLog($this->moduleName, '删除订单3天以上未支付的数据');
                return [1,
                    '删除成功',
                    __URL__];
            }
        }

        $idArray = explode(',', $orderID);

        if (!$orderID) {
            return [0,
                '数据标识不能为空',
                __URL__];
        }

        //只能删除未支付订单
        if (SM('Dingdan')->deleteData(
                        'status=0 and ddid in (' . implode(',', $idArray) . ')') === false) {
            return [0,
                '删除失败'];
        } else {
            //写入日志
            $this->adminLog($this->moduleName, '删除订单DingdanID为【' . implode(',', $idArray) . '】的数据');
            return [1,
                '删除成功',
                __URL__];
        }
    }

    /**
     * 未支付订单
     */
    public function wei($request) {
        header('Location:' . U('Dingdan/index', array(
                    'status' => 0)));
        exit();
    }

    /**
     * 扣量订单
     */
    public function kou($request) {
        header('Location:' . U('Dingdan/index', array(
                    'status' => 2)));
        exit();
    }

}
