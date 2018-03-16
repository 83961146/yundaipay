<?php
// +----------------------------------------------------------------------
// | easy pay [ pay to easy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 All rights reserved.
// +----------------------------------------------------------------------
// | Author: fengxing <QQ:51125330>
// +----------------------------------------------------------------------
namespace Index\Controller;

class PayController extends BaseController {

    //发起支付 查询订单
    public function index() {
        switch ($_REQUEST['fxaction']) {
            case 'orderquery':
                $buffer = SL('Pay/payQuery', $_REQUEST);
                if ($buffer[0] == 1) {
                    $reback = $buffer[1];
                } else {
                    $reback = array(
                        'fxstatus' => 0,
                        'error' => $buffer[1]);
                }
                break;
            default:
                $buffer = SL('Pay/payApi', $_REQUEST);
                $reback = array();
                if ($buffer[0] == 1) {
                    $reback = array(
                        'status' => 1,
                        'payurl' => $buffer[1]);
                } else {
                    $reback = array(
                        'status' => 0,
                        'error' => $buffer[1]);
                }
                break;
        }
        $this->ajaxBack($reback);
    }

    //异步返回
    public function notify() {
	/* $back='{"appid":"wxd1155b98be1006c2","attach":"201710015074666982604","bank_type":"CFT","cash_fee":"100","fee_type":"CNY","is_subscribe":"N","mch_id":"1488975772","nonce_str":"klltl6memi6ceu5zp8mhsaq4c8f3bka5","openid":"oGkuH0dXTSyJiOTKvZAiRg0xndPc","out_trade_no":"201710015074666982604","result_code":"SUCCESS","return_code":"SUCCESS","sign":"38938CBD9DC55DB30F263AED2AA9310B","time_end":"20170926000142","total_fee":"100","trade_type":"MWEB","transaction_id":"4200000003201709264262461142"}';
          $json=  json_decode($back,true);
          $xml = "<xml>";
          foreach ($json as $key=>$val)
          {
          if (is_numeric($val) && gettype($val)!='string'){
          $xml.="<".$key.">".$val."</".$key.">";
          }else{
          $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
          }
          }
          $xml.="</xml>";
          $GLOBALS['HTTP_RAW_POST_DATA']=$xml; */
//        $arr=array(
//            'total_amount'=>1,
//            'buyer_id'=>'2088102116773037',
//            'body'=>'大乐透2.1',
//            'trade_no'=>'2016071921001003030200089909',
//            'refund_fee'=>'0.00',
//            'notify_time'=>'2016-07-19 14:10:49',
//            'subject'=>'大乐透2.1',
//            'sign_type'=>'RSA2',
//            'charset'=>'utf-8',
//            'notify_type'=>'trade_status_sync',
//            'out_trade_no'=>'201710015074676266665',
//            'gmt_close'=>'2016-07-19 14:10:46',
//            'gmt_payment'=>'2016-07-19 14:10:47',
//            'trade_status'=>'TRADE_SUCCESS',
//            'version'=>'1.0',
//            'sign'=>'ELAYeugH8LYFvxnNajOvZhuxNFbN2LhF0l/KL8ANtj8oyPM4NN7Qft2kWJTDJUpQOzCzNnV9hDxh5AaT9FPqRS6ZKxnzM=',
//            'gmt_create'=>'2016-07-19 14:10:44',
//            'app_id'=>'2015102700040153',
//            'seller_id'=>'2088102119685838',
//            'notify_id'=>'4a91b7a78a503640467525113fb7d8bg8e'
//            );
//        $_REQUEST=array_merge($_REQUEST,$arr);
		$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
		file_put_contents('./test.txt',$xml."\r\n".serialize($_GET)."\r\n".serialize($_POST)."\r\n",FILE_APPEND);
		/*$xml='<xml><appid><![CDATA[wx74fe7d5250d0ff3a]]></appid>
<attach><![CDATA[mytest]]></attach>
<bank_type><![CDATA[CFT]]></bank_type>
<cash_fee><![CDATA[100]]></cash_fee>
<fee_type><![CDATA[CNY]]></fee_type>
<is_subscribe><![CDATA[Y]]></is_subscribe>
<mch_id><![CDATA[1485670872]]></mch_id>
<nonce_str><![CDATA[lpdh262zrhfds70tjzvbkti16pns2kb8]]></nonce_str>
<openid><![CDATA[oQcbbvz29UhQDUMBs2vU3CH2EcP0]]></openid>
<out_trade_no><![CDATA[201710015127235225810]]></out_trade_no>
<result_code><![CDATA[SUCCESS]]></result_code>
<return_code><![CDATA[SUCCESS]]></return_code>
<sign><![CDATA[5A72F3144ACE7DC29E2D0F5F03C53262]]></sign>
<time_end><![CDATA[20171208165851]]></time_end>
<total_fee>100</total_fee>
<trade_type><![CDATA[JSAPI]]></trade_type>
<transaction_id><![CDATA[4200000021201712080157149404]]></transaction_id>
</xml>';*/
		//$GLOBALS['HTTP_RAW_POST_DATA']=$xml;
		
		/*
		if(!$xml){
			$aa=unserialize('a:26:{s:10:"gmt_create";s:19:"2017-12-08 20:56:44";s:7:"charset";s:5:"UTF-8";s:12:"seller_email";s:17:"2977253050@qq.com";s:7:"subject";s:10:"alipay wap";s:4:"sign";s:344:"GzqoX3sA+NsSQo9/a0UaLUPn6hoOUrvtQ6XyAkgStul6FMKCpeboGpdPS7cFSzs3sPb+70a0lNlLpd2xnQv4TwG9Mhdx12a9lxCoWvvPF7y3WfWmnmyINARThwuakZwsn2/XiAF+N8CPxZ4nWA/cLrIctSA5S+zxMTSeJQUeSyOz7xL7/IrOVEtcmISM+/ClMFGM66Vl2tN6wAab544W5wxeo6uVnyeDnw+KXmYMEAXVY2jMYufGuEgOVlhvHR6bhGd8Otheu+BVNe1wpYa8rgX6UdJEo9O0IAju3cNyjTfiXi7y6AwhOC0t1N4YhgIb2A6uxSQiG1pG/Xu9wDElJg==";s:4:"body";s:6:"mytest";s:8:"buyer_id";s:16:"2088002640641753";s:14:"invoice_amount";s:4:"0.01";s:9:"notify_id";s:34:"5c80f9a3ead76b669b7e6b46b6aac79lsh";s:14:"fund_bill_list";s:57:"[{\"amount\":\"0.01\",\"fundChannel\":\"ALIPAYACCOUNT\"}]";s:11:"notify_type";s:17:"trade_status_sync";s:12:"trade_status";s:13:"TRADE_SUCCESS";s:14:"receipt_amount";s:4:"0.01";s:16:"buyer_pay_amount";s:4:"0.01";s:6:"app_id";s:16:"2015122401036066";s:9:"sign_type";s:4:"RSA2";s:9:"seller_id";s:16:"2088611386176120";s:11:"gmt_payment";s:19:"2017-12-08 20:56:44";s:11:"notify_time";s:19:"2017-12-08 20:56:45";s:7:"version";s:3:"1.0";s:12:"out_trade_no";s:21:"201710015127377852022";s:12:"total_amount";s:4:"0.01";s:8:"trade_no";s:28:"2017120821001004750589705655";s:11:"auth_app_id";s:16:"2015122401036066";s:14:"buyer_logon_id";s:14:"511***@163.com";s:12:"point_amount";s:4:"0.00";}');
			foreach($aa as $i=>$ipost){
					$aa[$i]=stripslashes($ipost);
				}
				//unset($aa['/Pay/notify/alipay']);
			//$str='';
			//foreach($aa as $i=>$iaa){
			//	$str.=$i.'='.$iaa.'&';
			//}
			//exit($str);
			$buffer = SL('Pay/notify_alipay', $aa);
			exit($buffer[1]);
		}*/
		foreach ($_REQUEST as $i => $iBuffer) {
            if (strstr(strtolower($i), '/pay/notify')) {
                $action = str_replace('/pay/notify/', '', strtolower($i));
            }
        }
		
        switch ($action) {
            case 'wechat':
                $buffer = SL('Pay/notify_' . $action, $_REQUEST);
                break;
            case 'alipay':
				$post=$_POST;
				foreach($post as $i=>$ipost){
					$post[$i]=stripslashes($ipost);
				}
                $buffer = SL('Pay/notify_' . $action, $post);
                break;
			default:
                $buffer = SL('Pay/notify_' . $action, $_REQUEST);
                break;
        }
		
        exit($buffer[1]); //success
    }

    //同步返回
    public function backurl() {
        foreach ($_REQUEST as $i => $iBuffer) {
            if (strstr(strtolower($i), '/pay/backurl')) {
                $action = str_replace('/pay/backurl/', '', strtolower($i));
            }
        }
        switch ($action) {
            case 'wechat':
                $buffer = SL('Pay/backurl_' . $action, $_REQUEST);
                break;
            case 'alipay':
                $buffer = SL('Pay/backurl_' . $action, $_REQUEST);
                break;
			default:
                $buffer = SL('Pay/backurl_' . $action, $_REQUEST);
                break;
        }
        header('Location:' . $buffer[1]); //跳转
        exit();
    }

    /**
     * 公众号类H5支付
     */
    public function jsapi() {
        $buffer = SL('Pay/jsapi', $_REQUEST);
        $this->reback($buffer, 1);
    }

    /**
     * 跳转
     */
    public function go() {
        $http = $_GET['u'];
        exit('<script>location.href="' . $http . '";</script>');
    }

    /**
     * 提交
     */
    public function formpost() {
        $http = $_GET;
        $tjurl=$http['wg'];
        unset($http['wg']);
        header("Content-type: text/html; charset=utf-8");
        $str = '<form id="Form1" name="Form1" method="post" action="' . $tjurl . '">';
        foreach ($http as $key => $val) {
            if(empty($val)) continue;
            $str = $str . '<input type="hidden" name="' . $key . '" value="' . $val . '"/>';
        }
        //$str = $str . '<input type="submit" style="width:20%;height:40px;" value="确认支付"/>';
        $str = $str . '</form>';
        $str = $str . '<script>';
        $str = $str . 'document.Form1.submit();';
        $str = $str . '</script>';
        exit($str);
    }

}
