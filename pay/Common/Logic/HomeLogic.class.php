<?php
// +----------------------------------------------------------------------
// | easy pay [ pay to easy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 All rights reserved.
// +----------------------------------------------------------------------
// | Author: fengxing <QQ:51125330>
// +----------------------------------------------------------------------
namespace Common\Logic;

class HomeLogic extends BaseLogic {

    protected $peizhi = array();
    protected $user = array();

    /**
     * 构造函数
     */
    public function __construct() {
        global $publicData;
        if (empty($publicData['peizhi'])) {
            $this->peizhi = SL('Param')->getPZ();
            $publicData['peizhi'] = $this->peizhi;
        } else {
            $this->peizhi = $publicData['peizhi'];
        }
        $publicData['user']['money'] = sprintf("%.2f", $publicData['user']['money']);
        $this->user = $publicData['user'];
    }

    /**
     * 用户首页
     */
    public function index($request) {

        //获取统计信息
        $today = strtotime(date('Y-m-d', time()));
        $yes = strtotime(date('Y-m-d', time() - 24 * 3600));
        $tj = array();
        $tj['payhave'] = SM('Pay')->sumData('money', 'status=0 and userid=' . $this->user['userid']); //等待支付
        $tj['dingdanall'] = SM('Dingdan')->sumData('havemoney', 'status=1 and userid=' . $this->user['userid']); //订单总金额
        $tj['dingdantoday'] = SM('Dingdan')->sumData('havemoney', 'status=1 and userid=' . $this->user['userid'] . ' and addtime>=' . $today); //今日收益
        $tj['dingdanyes'] = SM('Dingdan')->sumData('havemoney', 'status=1 and userid=' . $this->user['userid'] . ' and (addtime between ' . $yes . ' and ' . $today . ')'); //昨日收益
        $tj['dingdantodaycount'] = SM('Dingdan')->selectCount('status=1 and userid=' . $this->user['userid'] . ' and addtime>=' . $today, 'id'); //今日订单笔数
        $tj['dingdanyescount'] = SM('Dingdan')->selectCount('status=1 and userid=' . $this->user['userid'] . ' and (addtime between ' . $yes . ' and ' . $today . ')', 'id'); //昨日订单笔数
        foreach ($tj as $i => $iTj) {
            if (empty($iTj))
                $tj[$i] = 0;
        }

        $params = array(
            'tj' => $tj,
            'pageName' => '用户中心'
        );
        return [1,
            $params];
    }

    /**
     * 修改密码
     */
    public function pass($request) {
        if (IS_POST) {
            $data = array();
            $data['qq'] = $request['qq'];
            $data['email'] = $request['email'];
            $data['phone'] = $request['phone'];


            if (!empty($data['phone']) && !checkString('checkIfPhone', $data['phone']))
                return [0,
                    '请输入正确的手机号！'];
            if (!empty($data['email']) && !checkString('checkIfEmail', $data['email']))
                return [0,
                    '请输入正确的邮箱地址！'];

            $user = SM('User');
            //判断新密码
            $passwordy = $request['passwordy'];
            $password = $request['password'];
            $password2 = $request['password2'];
            if ($passwordy) {
                if ($password2 != $password) {
                    return [0,
                        '两次输入的密码不一致！'];
                }

                //密码规范
                if (!checkString('checkUserPassWord', $password)) {
                    return [0,
                        '密码长度大于8，数字，字母组合！'];
                }
                $buffer = $user->findData('*', 'userid=' . $this->user['userid']);
                if ($buffer['password'] != md5($buffer['username'] . $passwordy)) {
                    return [0,
                        '原密码错误！'];
                }
                $data['password'] = md5($buffer['username'] . $password);
            }

            //判断提现密码
            $txmmy = $request['txmmy'];
            $txmm = $request['txmm'];
            $txmm2 = $request['txmm2'];
            if ($txmmy) {
                if ($txmm2 != $txmm) {
                    return [0,
                        '两次输入的提现密码不一致！'];
                }

                //密码规范
                if (!checkString('checkUserPassWord', $txmm)) {
                    return [0,
                        '提现密码长度大于8，数字，字母组合！'];
                }
                if (empty($buffer))
                    $buffer = $user->findData('*', 'userid=' . $this->user['userid']);
                if ($buffer['txpassword'] != md5($buffer['username'] . $txmmy)) {
                    return [0,
                        '原提现密码错误！'];
                }
                $data['txpassword'] = md5($buffer['username'] . $txmm);
            }


            if ($user->updateData(
                            $data, 'userid=' . $this->user['userid']) === false) {
                return [0,
                    '修改失败'];
            } else {
                //写入日志
                $this->userLog('用户账户', '修改用户UserID为【' . $this->user['userid'] . '】的数据', $this->user['userid']);
                return [1,
                    '修改成功！',
                    U('Index/Home/pass')];
            }
        }

        $params = array(
            'pageName' => '账户修改'
        );
        return [1,
            $params];
    }

    /**
     * 退出登录
     */
    public function loginout($request) {
        $this->setCookieCode(null, null);
        $this->setCookieUserID(null, null);
        $this->setCookieUserName(null, null);
        header('Location:' . U('/'));
        exit();
    }

    /**
     * 交易订单
     */
    public function dingdan($request) {
        $map = array();

        $data = ' userid=' . $this->user['userid'] . ' ';

        if (is_numeric($request['status'])) {
            if ($request['status'] < 2) {
                $map['status'] = $request['status'];
                $data .=' AND status = "' . $request['status'] . '" ';
            }
        } else {
            $data .= ' AND status<2 ';
        }

        //高级查询
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

        $jiekou = SM('Jiekou')->selectData('*', '1=1', 'jkid asc');
        $jiekoubuffer = stringChange('arrayKey', $jiekou, 'jkstyle');


        $dingdanLogic = SL('Dingdan');
        foreach ($list as $i => $iList) {
            $list[$i]['addtime'] = date('Y-m-d H:i:s', $list[$i]['addtime']);
            $list[$i]['paytime'] = $list[$i]['paytime']==0 ? '无' : date('Y-m-d H:i:s', $list[$i]['paytime']);
            $list[$i]['tzzt'] = $dingdanLogic->tzzt[$list[$i]['tz']];
            $list[$i]['status'] = $dingdanLogic->zt[$list[$i]['status']];
            $list[$i]['jkstyle'] = $jiekoubuffer[$list[$i]['jkstyle']]['jkname'];
            $list[$i] = stringChange('formatMoneyByArray', $list[$i], array(
                'totalmoney',
                'havemoney'));
        }
        $pageList = $this->pageList($count, $perpage, $map);

        //统计数据 今日订单笔数 	昨日订单笔数 	今日订单总金额 	今日支出金额 	昨日订单总金额 	昨日支出金额 	历史总笔数 	历史总金额 	历史总支出
        $today = strtotime(date('Y-m-d', time()));
        $yes = strtotime(date('Y-m-d', time() - 24 * 3600));
        $tj = array();
        $tj['today'] = $order->sumData('havemoney', 'userid=' . $this->user['userid'] . ' and status=1 and addtime>=' . $today);
        $tj['yes'] = $order->sumData('havemoney', 'userid=' . $this->user['userid'] . ' and status=1 and (addtime between ' . $yes . ' and ' . $today . ')');
        $tj['all'] = $order->sumData('havemoney', 'userid=' . $this->user['userid'] . ' and status=1');
        foreach ($tj as $i => $iTj) {
            if (empty($iTj))
                $tj[$i] = 0;
        }

        $params = array(
            'list' => $list,
            'tj' => $tj,
            'page' => $pageList,
            'jiekou' => $jiekou,
            'pageName' => '交易记录'
        );
        return [1,
            $params];
    }

    /**
     * 交易订单重发通知
     */
    public function dingdancf($request) {
        if (IS_POST) {
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
            'fzattach' => $fj['fxattach'],
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
            'pageName' => '订单重发'
        );
        return [1,$params];
    }

    /**
     * 银行卡管理
     */
    public function yhk($request) {
        if ($request['id']) { //删除数据
            $zijianID = $request['id']; //获取数据标识
            $idArray = explode(',', $zijianID);

            if (!$zijianID) {
                return [0,
                    '数据标识不能为空'];
            }
            $idstr = implode(',', $idArray);
            $ka = SM('Ka');
            $buffer = $ka->selectData('*', 'id in (' . $idstr . ')');
            foreach ($buffer as $iBuffer) {
                if ($iBuffer['userid'] != $this->user['userid']) {
                    return [0,
                        '数据id错误。'];
                }
            }

            if ($ka->deleteData(
                            'id in (' . $idstr . ')') === false) {
                return [0,
                    '删除失败'];
            } else {
                //写入日志
                $this->userLog('银行卡', '删除银行卡ID为【' . $idstr . '】的数据');
                return [1,
                    '删除成功',
                    U('Index/Home/yhk')];
            }
        }
        $map = array();
        $data = ' userid=' . $this->user['userid'] . ' ';
        //高级查询
        if ($request['ka']) {
            $map['ka'] = $request['ka'];
            $data.=' AND ka ="' . $request['ka'] . '" ';
        }
        if ($request['username']) {
            $map['username'] = $request['username'];
            $data.=' AND username ="' . $request['username'] . '" ';
        }
        if (is_numeric($request['ifcheck'])) {
            $map['ifcheck'] = $request['ifcheck'];
            $data.=' AND ifcheck ="' . $request['ifcheck'] . '" ';
        }
        $perpage = C('FX_PERPAGE'); //每页行数
        $zijian = SM('Ka');
        $count = $zijian->selectCount(
                $data, 'id'
        ); // 查询满足要求的总记录数
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $page = page($count, $request['p'], $perpage) . ',' . $perpage;

        $list = $zijian->pageData(
                '*', $data, 'id DESC', $page
        );

        foreach ($list as $i => $iList) {
            $list[$i]['addtime'] = date('Y-m-d H:i:s', $iList['addtime']);
            $list[$i]['ifcheckname'] = $iList['ifcheck'] == 1 ? '通过' : '未通过';
            if (empty($iList['checktime']))
                $list[$i]['checktime'] = '-';
            else
                $list[$i]['checktime'] = date('Y-m-d H:i:s', $iList['checktime']);
        }

        $pageList = $this->pageList($count, $perpage, $map);

        $params = array(
            'list' => $list,
            'page' => $pageList,
            'pageName' => '提现账户管理'
        );
        return [1,
            $params];
    }

    /**
     * 银行卡添加
     */
    public function yhkadd($request) {
        if (IS_POST) {
            $zjid = $request['id']; //获取数据标识
            $act = $request['act']; //获取模板标识
            //判断数据标识
            if (empty($zjid) && $act == 'edit') {
                return [0,
                    '数据标识不能为空！'];
            }
            if (empty($act)) {
                return [0,
                    '模板标识不能为空！'];
            }
            $zijian = SM('Ka');
            $data = array();
            $data['userid'] = $this->user['userid'];
            $data['username'] = $request['username'];
            $data['ka'] = $request['ka'];
            $data['address'] = $request['address'];
            $data['ifcheck'] = 0;
            if ($this->peizhi['ifcheckka'] != 1)
                $data['ifcheck'] = 1;

            if ($act == 'add') {
                $data['addtime'] = time();
                if ($zijian->insertData($data) === false) {
                    return [0,
                        '添加失败'];
                } else {
                    //写入日志
                    $this->userLog('银行卡', '添加银行卡【' . $data['ka'] . '】', $data['userid']);
                    return [1,
                        '添加成功！',
                        U('Index/Home/yhk')];
                }
            } elseif ($act == 'edit') {
                $data['id'] = $zjid;
                $buffer = $zijian->findData(
                        'userid,checktime', 'id="' . $data['id'] . '"');
                if (!$buffer) {
                    return [0,
                        '银行卡不存在'];
                }
                if ($buffer['userid'] != $this->user['userid']) {
                    return [0,
                        '修改数据有误。'];
                }
                if ($zijian->updateData(
                                $data, 'id=' . $data['id']) === false) {
                    return [0,
                        '修改失败'];
                } else {
                    //写入日志
                    $this->userLog('银行卡', '修改银行卡ID为【' . $data['id'] . '】的数据', $data['userid']);
                    return [1,
                        '修改成功！',
                        U('Index/Home/yhk')];
                }
            }
        }

        if (!$request['id']) {
            $params = array(
                'act' => 'add',
                'pageName' => '添加账户'
            );
            return [1,
                $params];
        }
        $zijianModel = SM('Ka');
        $row = $zijianModel->findData('*', 'id=' . $request['id']);
        if ($row['userid'] != $this->user['userid']) {
            return [0,
                '修改数据有误。'];
        }

        $params = array(
            'edit' => $row,
            'act' => 'edit',
            'pageName' => '修改账户'
        );
        return [1,
            $params];
    }

    /**
     * 申请提现
     */
    public function tx($request) {
        //可申请金额，减去当天的订单数据
        $today = strtotime(date('Y-m-d', time()));
        $todaymoney = SM('Dingdan')->sumData('havemoney', 'status=1 and userid=' . $this->user['userid'] . ' and addtime>=' . $today);
        $nowmoney = $this->user['money'] - (int) $todaymoney;

        if (IS_POST) {
            $act = $request['act']; //获取模板标识
            //判断数据标识
            if (empty($act)) {
                return [0,
                    '模板标识不能为空！'];
            }

            //获取银行卡
            $yhk = $request['yhk'];
            if (empty($yhk)) {
                return [0,
                    '请选择银行卡！'];
            }
            $kaBuffer = SM('Ka')->findData('*', 'ifcheck=1 and userid=' . $this->user['userid'] . ' and id=' . $yhk);
            if (!$kaBuffer) {
                return [0,
                    '银行卡无法提现，请更换！'];
            }

            //判断提现密码
            $txmm = $request['txmm'];
            if ($this->user['txpassword'] != md5($this->user['username'] . $txmm)) {
                return [0,
                    '提现密码错误！'];
            }

            $data = array();
            $data['userid'] = $this->user['userid'];
            $data['money'] = $request['money'];
            $data['status'] = 0;
            $data['realname'] = $kaBuffer['username'];
            $data['ka'] = $kaBuffer['ka'];
            $data['address'] = $kaBuffer['address'];

            //判断提现金额
            if ($data['money'] > $nowmoney) {
                return [0,
                    '提现金额不足！'];
            }

            if ($data['money'] < $this->peizhi['minpay']) {
                return [0,
                    '提现金额小于最小要求金额！'];
            }

            $zijian = SM('Pay');
            if ($act == 'add') {
                $data['addtime'] = time();
                $zijian->dbStartTrans(); //开始事务

                $userBuffer=SM('User')->findData('*','userid="'.$this->user['userid'].'"');
                $flag = false;
                if ($zijian->insertData($data) === false)
                    $flag = true;

                //提现后更新金额
                $newmoney = $userBuffer['money'] - $data['money'];
                $newtx = $userBuffer['tx'] + $data['money'];
                $result=SM('User')->updateData(array(
                    'money' => $newmoney,
                    'tx' => $newtx), 'userid=' . $userBuffer['userid']);

                if($result===false || $flag){
                    $zijian->dbRollback();
                    return [0,'申请失败。'];
                }else{
                    $zijian->dbCommit();
                }

                //写入日志
                $this->userLog('申请提现', '申请提现【' . $data['money'] . '】', $data['userid']);
                return [1,
                    '申请成功！',
                    U('Index/Home/txjl')];
					
            } elseif ($act == 'edit') {

            }
        }

        $kaBuffer = SM('Ka')->selectData('*', 'userid=' . $this->user['userid'] . ' and ifcheck=1');

        $params = array(
            'act' => 'add',
            'nowmoney' => sprintf("%.2f", $nowmoney),
            'ka' => $kaBuffer,
            'pageName' => '申请提现'
        );
        return [1,
            $params];
    }

    /**
     * 提现记录
     */
    public function txjl($request) {
        $map = array();

        $data = ' userid=' . $this->user['userid'] . ' ';

        //高级查询
        if (is_numeric($request['status'])) {
            $map['status'] = $request['status'];
            $data .=' AND status = "' . $request['status'] . '" ';
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

        $perpage = C('FX_PERPAGE'); //每页行数
        $pay = SM('Pay');
        $count = $pay->selectCount(
                $data, 'id'
        ); // 查询满足要求的总记录数
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $page = page($count, $request['p'], $perpage) . ',' . $perpage;

        $list = $pay->pageData(
                '*', $data, 'id DESC', $page
        );
        $payLogic = SL('Pay');
        foreach ($list as $i => $iList) {
            $list[$i]['addtime'] = date('Y-m-d H:i:s', $list[$i]['addtime']);
            $list[$i]['statusname'] = $payLogic->zt[$list[$i]['status']];
            $list[$i] = stringChange('formatMoneyByArray', $list[$i], array(
                'money'));
        }
        $pageList = $this->pageList($count, $perpage, $map);

        //统计数据
        $today = strtotime(date('Y-m-d', time()));
        $yes = strtotime(date('Y-m-d', time() - 24 * 3600));
        $tj = array();
        $tj['today'] = $pay->sumData('money', 'userid=' . $this->user['userid'] . ' and addtime>=' . $today);
        $tj['yes'] = $pay->sumData('money', 'userid=' . $this->user['userid'] . ' and (addtime between ' . $yes . ' and ' . $today . ')');
        $tj['all'] = $pay->sumData('money', 'userid=' . $this->user['userid']);
        foreach ($tj as $i => $iTj) {
            if (empty($iTj))
                $tj[$i] = 0;
        }

        $params = array(
            'list' => $list,
            'tj' => $tj,
            'page' => $pageList,
            'pageName' => '提现记录'
        );
        return [1,
            $params];
    }

    /**
     * 我的费率
     * 费率相关 接口配置
     * 接口开关 接口配置
     * 接口名称 接口状态 接口费率 接口开关
     */
    public function fl($request) {
        $jiekouBuffer = SM('Jiekou')->selectData('*', '1=1', 'jkid asc');

        //接口配置费率
        $jiekouzjBuffer = SM('Jiekouzj')->selectData('*', 'ifchoose=1 and ifopen=1');
        if ($jiekouzjBuffer) {
            $jiekouzjBuffer = stringChange('arrayKey', $jiekouzjBuffer, 'jkid');
            foreach ($jiekouBuffer as $i => $iJiekouBuffer) {
                $jiekouBuffer[$i]['fl'] = $jiekouzjBuffer[$iJiekouBuffer['jkid']]['fl'];
                $jiekouBuffer[$i]['ifjkopen'] = $jiekouzjBuffer[$iJiekouBuffer['jkid']]['ifopen'];
            }
        }

        //系统配置
        foreach ($jiekouBuffer as $i => $iJiekouBuffer) {
            if (empty($jiekouBuffer[$i]['ifjkopen']))
                $jiekouBuffer[$i]['ifjkopen'] = 0;

            if ($jiekouBuffer[$i]['ifjkopen'] == 1) {
                $jiekouBuffer[$i]['ifjkopen'] = '开启';
            } else {
                $jiekouBuffer[$i]['ifjkopen'] = '<font color="red">关闭</font>';
            }

            $jiekouBuffer[$i] = stringChange('formatMoneyByArray', $jiekouBuffer[$i], array(
                'fl'));
            if (empty($jiekouBuffer[$i]['fl']))
                $jiekouBuffer[$i]['fl'] = '-';
            else
                $jiekouBuffer[$i]['fl'].='%';
        }

        $params = array(
            'list' => $jiekouBuffer,
            'pageName' => '我的费率'
        );
        return [1,
            $params];
    }

    /**
     * 代理详情
     */
    public function dl($request) {

        $today = strtotime(date('Y-m-d'), time());
        $tom = strtotime(date('Y-m-d', time() + 24 * 3600));
        $month = strtotime(date('Y-m-1'), time());
        $year = strtotime(date('Y-1-1'), time());

        //总代理金
        $tj = array();
        $tj['all'] = SM('Fandian')->sumData('havemoney', 'userid=' . $this->user['userid'] . ' and status=2');
        //当月代理金
        $tj['month'] = SM('Fandian')->sumData('havemoney', 'userid=' . $this->user['userid'] . ' and status=2 and addtime>=' . $month);
        //商户总数
        $tj['user'] = SM('User')->selectCount('agent=' . $this->user['userid'], 'id');
        //商户当天充值量
        $tj['usertoday'] = SM('Dingdan')->getAgentMoneyByAgent($this->user['userid'], $today, $tom);
        //商户当月充值量
        $tj['usermonth'] = SM('Dingdan')->getAgentMoneyByAgent($this->user['userid'], $month, $tom);
        //商户当年充值量
        $tj['useryear'] = SM('Dingdan')->getAgentMoneyByAgent($this->user['userid'], $year, $tom);
        foreach ($tj as $i => $iTj) {
            if (empty($iTj))
                $tj[$i] = 0;
        }
        $params = array(
            'tj' => $tj,
            'pageName' => '代理详情'
        );
        return [1,
            $params];
    }

    /**
     * 代理商户列表
     */
    public function dluser($request) {
        $map = array();
        $data = ' agent=' . $this->user['userid'] . ' ';
        //高级查询
        if ($request['userid']) {
            $map['userid'] = $request['userid'];
            $data.=' AND userid ="' . $request['userid'] . '" ';
        }
        if ($request['qq']) {
            $map['qq'] = $request['qq'];
            $data.=' AND qq ="' . $request['qq'] . '" ';
        }
        if (is_numeric($request['status'])) {
            $map['status'] = $request['status'];
            $data.=' AND status ="' . $request['status'] . '" ';
        }
        $perpage = C('FX_PERPAGE'); //每页行数
        $user = SM('User');
        $count = $user->selectCount(
                $data, 'id'
        ); // 查询满足要求的总记录数
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $page = page($count, $request['p'], $perpage) . ',' . $perpage;

        $list = $user->pageData(
                '*', $data, 'id DESC', $page
        );

        foreach ($list as $i => $iList) {
            $list[$i]['addtime'] = date('Y-m-d H:i:s', $iList['addtime']);
            $list[$i]['statusname'] = $iList['status'] == 1 ? '锁定' : '正常';
            $list[$i] = stringChange('formatMoneyByArray', $list[$i], array(
                'money',
                'tx'));
        }

        $pageList = $this->pageList($count, $perpage, $map);

        $params = array(
            'list' => $list,
            'page' => $pageList,
            'pageName' => '用户列表'
        );
        return [1,
            $params];
    }

    /**
     * 代理订单
     */
    public function dldingdan($request) {
        $map = array();

        $data = ' 1=1 ';

        if (is_numeric($request['status'])) {
            if ($request['status'] < 2) {
                $map['status'] = $request['status'];
                $data .=' AND d.status = "' . $request['status'] . '" ';
            }
        } else {
            $data .= ' AND d.status<2 ';
        }

        //高级查询
        if ($request['ordernum']) {
            $map['ordernum'] = $request['ordernum'];
            $data.=' AND d.ordernum = "' . $request['ordernum'] . '" ';
        }
        if ($request['jkstyle']) {
            $map['jkstyle'] = $request['jkstyle'];
            $data.=' AND d.jkstyle = "' . $request['jkstyle'] . '" ';
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
            $data .= ' AND d.addtime between ' . ($start) . ' and ' . ($end) . ' ';
        }

        $perpage = C('FX_PERPAGE'); //每页行数
        $order = SM('Dingdan');
        $count = $order->getAgentCount($this->user['userid'], $data); // 查询满足要求的总记录数
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $page = page($count, $request['p'], $perpage) . ',' . $perpage;

        $list = $order->getAgentList($this->user['userid'], $data, $page);

        $jiekou = SM('Jiekou')->selectData('*', '1=1', 'jkid asc');
        $jiekoubuffer = stringChange('arrayKey', $jiekou, 'jkstyle');

        $dingdanLogic = SL('Dingdan');
        foreach ($list as $i => $iList) {
            $list[$i]['addtime'] = date('Y-m-d H:i:s', $list[$i]['addtime']);
            $list[$i]['paytime'] = date('Y-m-d H:i:s', $list[$i]['paytime']);
            $list[$i]['tzzt'] = $dingdanLogic->tzzt[$list[$i]['tz']];
            $list[$i]['status'] = $dingdanLogic->zt[$list[$i]['status']];
            $list[$i]['jkstyle'] = $jiekoubuffer[$list[$i]['jkstyle']]['jkname'];
            $list[$i] = stringChange('formatMoneyByArray', $list[$i], array(
                'totalmoney',
                'havemoney'));
        }
        $pageList = $this->pageList($count, $perpage, $map);

        //统计数据 今日订单笔数 	昨日订单笔数 	今日订单总金额 	今日支出金额 	昨日订单总金额 	昨日支出金额 	历史总笔数 	历史总金额 	历史总支出
        $today = strtotime(date('Y-m-d', time()));
        $tom = strtotime(date('Y-m-d', time() + 24 * 3600));
        $yes = strtotime(date('Y-m-d', time() - 24 * 3600));
        $tj = array();
        $tj['today'] = $order->getAgentSum($this->user['userid'], $today, $tom);
        $tj['yes'] = $order->getAgentSum($this->user['userid'], $yes, $today);
        $tj['all'] = $order->getAgentSum($this->user['userid']);
        foreach ($tj as $i => $iTj) {
            if (empty($iTj))
                $tj[$i] = 0;
        }

        $params = array(
            'list' => $list,
            'tj' => $tj,
            'page' => $pageList,
            'jiekou' => $jiekou,
            'pageName' => '用户交易记录'
        );
        return [1,
            $params];
    }

    /**
     * 代理返点
     */
    public function dlfandian($request) {
        $fandianLogic = SL('Agent');
        $fandianLogic->fandianupdate(); //更新返点

        $data = ' userid=' . $this->user['userid'];

        $fandian = SM('Fandian');
        $count = $fandian->selectCount(
                $data, 'id'); // 查询满足要求的总记录
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $perpage = C('FX_PERPAGE'); //每页行数
        $page = page($count, $request['p'], $perpage) . ',' . $perpage;
        $list = $fandian->pageData(
                '*', $data, 'id DESC', $page
        );

        foreach ($list as $i => $iList) {
            $list[$i]['statusname'] = $fandianLogic->zt[$iList['status']];
            $list[$i]['addtime'] = date('Y-m-d H:i:s', $iList['addtime']);
            $list[$i] = stringChange('formatMoneyByArray', $list[$i], array(
                'totalmoney',
                'havemoney',
                'fl'));
        }
        $pageList = $this->pageList($count, $perpage, $map);

        $params = array(
            'list' => $list,
            'page' => $pageList,
            'pageName' => '代理返点'
        );
        return [1,
            $params];
    }

    /**
     * 接入支付
     */
    public function api($request) {
        $jiekou = SM('Jiekou')->selectData('*', '1=1', 'jkid asc');
        $params = array(
            'jiekou' => $jiekou,
            'pageName' => '接口Api'
        );
        return [1,
            $params];
    }
}
