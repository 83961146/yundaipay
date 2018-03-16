<?php

// +----------------------------------------------------------------------
// | easy pay [ pay to easy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 All rights reserved.
// +----------------------------------------------------------------------
// | Author: fengxing <QQ:51125330>
// +----------------------------------------------------------------------

namespace Common\Logic;

class PayLogic extends BaseLogic {

    protected $moduleName = '账单';
    public $zt = array(
        0 => '未支付',
        1 => '已支付',
        2 => '冻结');

    /**
     * 列表
     */
    public function index($request) {
        $map = array();
        $data = ' 1=1 ';
        //高级查询
        if ($request['userid']) {
            $map['userid'] = $request['userid'];
            $data .= ' AND userid = "' . $request['userid'] . '" ';
        }
        if (!is_numeric($request['status'])) {
            $request['status'] = 0;
            $_REQUEST['status'] = 0;
        }
        $map['status'] = $request['status'];
        $data .= ' AND status ="' . $request['status'] . '" ';

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

        $pay = SM('Pay');
        $count = $pay->selectCount(
                $data, 'id'); // 查询满足要求的总记录
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $perpage = C('FX_PERPAGE'); //每页行数
        $page = page($count, $request['p'], $perpage) . ',' . $perpage;
        $list = $pay->pageData('*', $data, 'id DESC', $page);
        foreach ($list as $i => $iList) {
            $list[$i]['statusname'] = $this->zt[$iList['status']];
            $list[$i]['addtime'] = date('Y-m-d H:i:s', $iList['addtime']);
            $list[$i] = stringChange('formatMoneyByArray', $list[$i], array(
                'money'));
        }
        $pageList = $this->pageList($count, $perpage, $map);

        $titlename = $this->zt[$request['status']];

        //统计数据
        $times = strtotime(date('Y-m-d', time()));
        $tj = array();
        $tj['today'] = $pay->sumData('money', 'addtime>=' . $times);
        $tj['paytoday'] = $pay->sumData('money', 'status=1 and addtime>=' . $times);
        $tj['all'] = $pay->sumData('money', '1=1');
        $tj['payall'] = $pay->sumData('money', 'status=1');
        foreach ($tj as $i => $iTj) {
            if (empty($iTj))
                $tj[$i] = 0;
        }

        $params = array(
            'zt' => $this->zt,
            'tj' => $tj,
            'list' => $list,
            'page' => $pageList,
            'pageName' => $titlename . $this->moduleName . '管理'
        );
        return [1,
            $params];
    }

    /**
     * 保存
     */
    public function save($request) {
        $id = $request['id']; //获取数据标识
        $status = $request['status']; //获取数据标识

        if (empty($id) || !is_numeric($status)) {
            return [0,
                '数据标识不能为空！'];
        }

        if (!is_array($id)) {
            $id = explode(',', $id);
        }

        //状态为1的数据不能修改状态

        $pay = SM('Pay');
        if ($pay->updateData(array(
                    'status' => $status), 'id in (' . implode(',', $id) . ') && status!=1') === false) {
            return [0,
                '修改失败！'];
        } else {
            $this->adminLog($this->moduleName, '修改账单状态id为【' . implode(',', $id) . '】的数据');
            return [1,
                '修改成功！'];
        }
    }

    /**
     * 已支付账单
     */
    public function yzf($request) {
        header('Location:' . U('Pay/index', array(
                    'status' => 1)));
        exit();
    }

    /**
     * 发起支付
     * $check pzid支付id
     */
    public function payApi($request, $check = '') {
        $fxid = $request['fxid'];
        $fxddh = $request['fxddh'];
        $fxdesc = $request['fxdesc'];
        $fxfee = $request['fxfee'];
        $fxattch = $request['fxattch'];
        $fxnotifyurl = $request['fxnotifyurl'];
        $fxbackurl = $request['fxbackurl'];
        $fxpay = $request['fxpay'];
        $fxsign = $request['fxsign'];
        $fxip = $request['fxip'];

        //判断商户号 key是否存在
        $userBuffer = SM('User')->findData('*', 'userid=' . $fxid);
        if (!$userBuffer || $userBuffer['status'] == 1) {
            return [0,
                '商户号错误。'];
        }
        $fxkey = $userBuffer['miyao'];

        //判断订单长度
        if (strlen($fxddh) > 22) {
            return [0,
                '订单号长度必须小于22位。'];
        }

        if (empty($fxfee) || !is_numeric($fxfee * 100) || $fxfee <= 0) {
            return [0,
                '支付金额有误。'];
        }

        //判断回调地址是否是http
        if (!checkString('checkIfHttp', $fxnotifyurl) || !checkString('checkIfHttp', $fxbackurl)) {
            return [0,
                '同步、异步回调网址有误。'];
        }

        //判断签名是否正确 商务号+商户订单号+支付金额+异步通知地址+商户秘钥
        if ($fxsign != md5($fxid . $fxddh . $fxfee . $fxnotifyurl . $fxkey)) {
            return [0,
                '签名错误。'];
        }

        //判断订单号重复
        $ddBuffer = SM('Dingdan')->findData('*', 'ordernum="' . $fxid . $fxddh . '"');
        if ($ddBuffer) {
            return [0,
                '订单号重复，请更换后重试。'];
        }

        //pay是否在允许范围内 接口及配置都有数据
        $jiekou = SM('Jiekou')->selectData('*', '1=1', 'jkid asc');
        $jiekoubuffer = stringChange('arrayKey', $jiekou, 'jkstyle');
        if (!$jiekoubuffer[$fxpay]) {
            return [0,
                '请求类型有误。'];
        } else {
            $zjbuffer = SM('Jiekouzj')->findData('*', 'jkid=' . $jiekoubuffer[$fxpay]['jkid'] . ' and ifopen=1 and ifchoose=1');
            if (!$zjbuffer) {
                return [0,
                    '该请求类型暂时不可用。'];
            }
        }

        //查询支付账户和类型
        $jkpz = SM('Jiekoupeizhi')->findData('*', 'pzid=' . $zjbuffer['pzid']);
        if (!$jkpz) {
            return [0,
                '该请求类型暂时不可用。'];
        }

        $jkdata = array(
            'id' => $zjbuffer['zjid'],
            'peizhi' => unserialize($jkpz['params']),
            'style' => $jkpz['style'],
            'fxddh' => $fxid . $fxddh,
            'fxdesc' => $fxdesc,
            'fxfee' => $fxfee,
            'fxattch' => $fxattch,
            'fxnotifyurl' => "http://" . $_SERVER['HTTP_HOST'] . "/Pay/notify/" . $jkpz['style'], //本站回调
            'fxbackurl' => $fxbackurl, //用户同步回调 用户需要做订单查询以支持实时订单状态
            'fxpay' => $fxpay,
            'fxip' => $fxip
        );

        //调用接口返回
        $result = SL('PayApi')->index($jkdata);

        if ($result[0] == 1) {
            $fl = $zjbuffer['fl'];
            $havemoney = $fxfee - $fxfee * $fl / 100;
            if ($havemoney < 0.01) {
                $havemoney = 0;
            } else {
                $havemoney = round($havemoney, 2);
            }

            $fj = array(
                'fxdesc' => $fxdesc,
                'fxattch' => $fxattch,
                'fxnotifyurl' => $fxnotifyurl,
                'fxbackurl' => $fxbackurl,
                'fxip' => $fxip
            );

            //写入订单
            $data = array(
                'status' => 0,
                'ordernum' => $fxid . $fxddh,
                'userid' => $fxid,
                'totalmoney' => $fxfee,
                'havemoney' => $havemoney,
                'tz' => 0,
                'preordernum' => '',
                'zjid' => $zjbuffer['zjid'],
                'addtime' => time(),
                'fl' => $fl,
                'jkstyle' => $fxpay,
                'paytime' => 0,
                'fj' => serialize($fj)
            );
            SM('Dingdan')->insertData($data);
        }
        return $result;
    }

    /**
     * 异步回调微信
     */
    public function notify_wechat($request) {
        include_once COMMON_PATH . "/Tool/wechat/lib/WxPay.Api.php";
        include_once COMMON_PATH . "/Tool/wechat/lib/WxPay.Notify.php";
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        libxml_disable_entity_loader(true);
        $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		$ddh = $values['out_trade_no'];
		
        //根据订单号查找对应支付账户
        $ddBuffer = SM('Dingdan')->findData('*', 'ordernum="' . $ddh . '"');
        if (!$ddBuffer) {
            return [0,
                '订单号不存在，请重试。'];
        }
        //获取支付账号
        $pzBuffer = SL('Api')->getJkByZj($ddBuffer['zjid']);
        $jkpz = unserialize($pzBuffer['params']);

        \WxPayConfig::setAPPID($jkpz['wechat_appid']);
        \WxPayConfig::setMCHID($jkpz['wechat_mchid']);
        \WxPayConfig::setKEY($jkpz['wechat_key']);
        \WxPayConfig::setAPPSECRET($jkpz['wechat_appsecret']);
		
		$result = \WxPayResults::Init($xml);
        $notify = new \WxPayNotify();
        $notify->Handle(false);
//        if(strstr($xml,'SUCCESS')){
//            $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
//            $result = WxPayResults::Init($xml);
//            $data=array();
//            $data['ddh']=$result['out_trade_no'];
//            $data['qudao']=$result['transaction_id'];
//            $data['fee']=$result['total_fee'];
//            $data['method']='post';
//            $return = $this->changeDingdan($data);
//        }
//        if($return[0]===0){
//            return ;
//        }
//        WxpayApi::replyNotify($this->ToXml());
        exit();
    }

    /**
     * 同步回调微信
     */
    public function backurl_wechat($request) {

    }

    /**
     * 异步回调支付宝
     */
    public function notify_alipay($request) {
        include_once COMMON_PATH . "/Tool/alipay/config.php";
        include_once COMMON_PATH . "/Tool/alipay/wappay/service/AlipayTradeService.php";
        $ddh = $request['out_trade_no'];
        //根据订单号查找对应支付账户
        $ddBuffer = SM('Dingdan')->findData('*', 'ordernum="' . $ddh . '"');
        if (!$ddBuffer) {
            return [0,
                '订单号不存在，请重试。'];
        }
        //获取支付账号
        $pzBuffer = SL('Api')->getJkByZj($ddBuffer['zjid']);
        $jkpz = unserialize($pzBuffer['params']);
        $config['app_id'] = $jkpz['alipay_appid'];
        $config['sign_type'] = $jkpz['alipay_sign'];
        $config['merchant_private_key'] = $jkpz['alipay_private'];
        $config['alipay_public_key'] = $jkpz['alipay_public'];

        $alipaySevice = new \AlipayTradeService($config);
        $alipaySevice->writeLog(var_export($request, true));
        $result = $alipaySevice->check($request);
        if ($result) {
            //商户订单号
            $out_trade_no = $request['out_trade_no'];
            //支付宝交易号
            $trade_no = $request['trade_no'];
            //交易状态
            $trade_status = $request['trade_status'];
            //订单金额
            $total_amount = $request['total_amount'];
            //描述
            $body = $request['body'];

            $newdata = array();
            $newdata['ddh'] = $out_trade_no;
            $newdata['qudao'] = $trade_no;
            $newdata['fee'] = $total_amount;
            $newdata['method'] = 'post';

            if ($request['trade_status'] == 'TRADE_FINISHED') {
                $return = $this->changeDingdan($newdata);
                if ($return[0] === 0)
                    exit('fail');
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序
                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
            } else if ($request['trade_status'] == 'TRADE_SUCCESS') {
                $return = $this->changeDingdan($newdata);
                if ($return[0] === 0)
                    exit('fail');
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            echo "success";  //请不要修改或删除
        } else {
            //验证失败
            echo "fail"; //请不要修改或删除
        }
        exit();
    }

    /**
     * 同步回调支付宝
     */
    public function backurl_alipay($request) {

    }

    /**
     * 公众号类H5支付
     */
    public function jsapi($request) {
        $style = $request['style'];

        $id = $request['id'];
        $ddh = $request['ddh'];
        //判断订单号
        $ddBuffer = SM('Dingdan')->findData('*', 'ordernum="' . $ddh . '"');
        if (!$ddBuffer) {
            return [0,
                '订单号不存在，请重试。'];
        }

        //获取支付账号
        $pzBuffer = SL('Api')->getJkByZj($id);
        if (!$pzBuffer) {
            return [0,
                '数据id错误，请重试。'];
        }
        if (!$pzBuffer['params']) {
            return [0,
                '数据id错误，请重试。。'];
        }
        if (!$pzBuffer['jkstyle']) {
            return [0,
                '数据id错误，请重试。。。'];
        }
        switch ($style) {
            case 'wechat':
                return $this->jsapi_wechat($pzBuffer, $ddBuffer);
                break;
        }
    }

    //微信公众号
    protected function jsapi_wechat($pzBuffer, $ddBuffer) {
        global $publicData;
        $peizhi = $publicData['peizhi'];

        $fj = unserialize($ddBuffer['fj']);
        $jkdata = array(
            'id' => $pzBuffer['zjid'],
            'peizhi' => unserialize($pzBuffer['params']),
            'apihttp' => $peizhi['apihttp'],
            'style' => $pzBuffer['style'],
            'fxddh' => $ddBuffer['ordernum'],
            'fxdesc' => $fj['fxdesc'],
            'fxfee' => $ddBuffer['totalmoney'],
            'fxattch' => $fj['fxattch'],
            'fxnotifyurl' => "http://" . $_SERVER['HTTP_HOST'] . "/Pay/notify/" . $pzBuffer['style'], //本站回调
            'fxbackurl' => $fj['fxbackurl'], //用户同步回调 用户需要做订单查询以支持实时订单状态
            'fxpay' => $ddBuffer['jkstyle'],
            'fxip' => $fj['fxip'],
            'isjsapi' => 1
        );

        //调用接口返回
        return SL('PayApi')->index($jkdata);
    }

    /**
     * 订单状态改变，在支付成功后
     * @param array $data ['ddh'=>订单号,'fee'=>金额,'qudao'=>渠道,'method'=>'post or get','back'=>【1代表返回路径】]
     */
    public function changeDingdan($data) {
        global $publicData;
        $peizhi = $publicData['peizhi'];

        //判断订单是否已经支付
        $dingdan = SM('Dingdan');
        $ddBuffer = SM('Dingdan')->findData('*', 'ordernum="' . $data['ddh'] . '"');
        if (!$ddBuffer)
            return [0,
                'no order in db'];

        if ($ddBuffer['totalmoney'] != $data['fee']) {
            return [0,
                'pay money diff'];
        }

        if ($ddBuffer['status'] == 0) {
            $dingdan->dbStartTrans(); //开始事务
            $flag = true; //事务标志
            $status = 1;
            $money = 0;
            //获取用户扣量信息
            $zijianBuffer = SM('Zijian')->findData('*', 'userid=' . $ddBuffer['userid']);
            if (!$zijianBuffer || $zijianBuffer['initval'] == 0) {
                //不扣量状态
                $money = $ddBuffer['havemoney'];
            } else {
                $zijian = $zijianBuffer['zijian'] - 1;
                if ($zijian == 0) {
                    if ($ddBuffer['totalmoney'] > $peizhi['klinitmoney'] && $ddBuffer['totalmoney'] > 0) {
                        SM('Zijian')->updateData(array(
                            'zijian' => $zijianBuffer['initval']), 'userid=' . $ddBuffer['userid']);
                        $status = 2;
                    } else {
                        $money = $ddBuffer['havemoney'];
                    }
                } else {
                    SM('Zijian')->updateData(array(
                        'zijian' => $zijian), 'userid=' . $ddBuffer['userid']);
                    $money = $ddBuffer['havemoney'];
                }
            }
            //改变订单状态
            $ddBuffer['paytime'] = time();
            $ddBuffer['status'] = $status;
            $ddBuffer['preordernum'] = $data['qudao'];

            $result = $dingdan->updateData(array(
                'status' => $status,
                'paytime' => time(),
                'preordernum' => $data['qudao']), 'ddid=' . $ddBuffer['ddid']);
            if ($result === false)
                $flag = false;

            if ($money > 0) {
                $result = SM('User')->conAddData('money=money+' . $money, 'userid=' . $ddBuffer['userid'], 'money');
                if ($result === false)
                    $flag = false;
            }

            //处理事务
            if ($flag === false) {
                $dingdan->dbRollback();
                return [0,
                    'db change error'];
            } else {
                $dingdan->dbCommit();
            }
        } else {
            $status = $ddBuffer['status'];
        }

        if ($status != 2) {
            //通知用户
            $userBuffer = SM('User')->findData('*', 'userid=' . $ddBuffer['userid']);
            $fj = unserialize($ddBuffer['fj']);
            $ddhYuan = substr($ddBuffer['ordernum'], strlen($ddBuffer['userid']));
            $pp = $status . $ddBuffer['userid'] . $ddhYuan . $ddBuffer['totalmoney'] . $userBuffer['miyao'];
            $k = md5($pp);
            $post_data = array(
                'fxid' => $ddBuffer['userid'],
                'fxddh' => $ddhYuan,
                'fxorder' => $ddBuffer['preordernum'],
                'fxdesc' => $fj['fxdesc'],
                'fxfee' => $ddBuffer['totalmoney'],
                'fxattch' => $fj['fxattch'],
                'fxstatus' => $status,
                'fxtime' => $ddBuffer['paytime'],
                'fxsign' => $k
            );


            if ($data['method'] == 'post') {
                $url = $fj['fxnotifyurl'];
                $result = curl($url, $post_data);
            } else {
                $url = $fj['fxbackurl'];
                $arr = array();
                foreach ($post_data as $i => $k) {
                    $arr[] = $i . '=' . urlencode($k);
                }
                $url = $url . '?' . implode('&', $arr);
                if ($data['back'] == 1)
                    return $url;

                $result = curl($url);
            }

            if (strtolower($result) == 'success' && $ddBuffer['tz'] < 2) {
                //通知成功
                SM('Dingdan')->updateData(array(
                    'tz' => 2), 'ddid=' . $ddBuffer['ddid']);
            } elseif ($ddBuffer['tz'] < 1) {
                SM('Dingdan')->updateData(array(
                    'tz' => 1), 'ddid=' . $ddBuffer['ddid']);
                $num=cookie('ddid'.$ddBuffer['ddid']);
                if(empty($num)) $num=0;
                if($num<4){
                    cookie('ddid'.$ddBuffer['ddid'],$num+1);
                    return [0,
                            'notify error'];
                }
            }
        }

        return [1,
            'success'];
    }

    /**
     * 查询订单状态
     */
    public function payQuery($request) {
        $fxid = $request['fxid'];
        $fxddh = $request['fxddh'];
        $fxsign = $request['fxsign'];
        $fxaction = $request['fxaction'];

        //判断商户号 key是否存在
        $userBuffer = SM('User')->findData('*', 'userid=' . $fxid);
        if (!$userBuffer || $userBuffer['status'] == 1) {
            return [0,
                '商户号错误。'];
        }

		$fxkey = $userBuffer['miyao'];
        //判断订单长度
        if (strlen($fxddh) > 22) {
            return [0,
                '订单号长度必须小于22位。'];
        }

        //判断签名是否正确 商务号+商户订单号+商户秘钥
        if ($fxsign != md5($fxid . $fxddh . $fxaction . $fxkey)) {
            return [0,
                '签名错误。'];
        }

        $buffer = SM('Dingdan')->findData('*', 'ordernum="' . $fxid . $fxddh . '" and status<2');
        if (!$buffer) {
            return [0,
                '订单号不存在。'];
        }

        $fj = unserialize($buffer['fj']);
        $data = array(
            'fxid' => $fxid,
            'fxstatus' => $buffer['status'],
            'fxddh' => $fxddh,
            'fxorder' => $buffer['preordernum'],
            'fxdesc' => $fj['fxdesc'],
            'fxfee' => $buffer['totalmoney'],
            'fxattch' => $fj['fxattch'],
            'fxtime' => $buffer['paytime'],
            'fxsign' => md5($buffer['status'] . $fxid . $fxddh . $buffer['totalmoney'] . $fxkey)
        );
        //订单状态+商务号+商户订单号+支付金额+商户秘钥

        return [1,
            $data];
    }

}
