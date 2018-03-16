<?php
// +----------------------------------------------------------------------
// | easy pay [ pay to easy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 All rights reserved.
// +----------------------------------------------------------------------
// | Author: fengxing <QQ:51125330>
// +----------------------------------------------------------------------
namespace Index\Controller;

class TestController extends BaseController {

    protected $userTest; //测试用户信息

    public function __construct() {
        parent::__construct();
        global $publicData;
        $this->userTest = array(
            'notifyUrl' => "http://" . $_SERVER['HTTP_HOST'] . "/Test/notifyUrl", //异步回调地址，外网能访问
            'backUrl' => "http://" . $_SERVER['HTTP_HOST'] . "/Test/backUrl", //同步回调地址，外网能访问
            'fxid' => "2017100", //商户号
            'fxkey' => "ZVFjVNoCFluOoYcpzPUtYIIRsZVPilhC", //商户秘钥key 从用户后台获取
            'fxgetway' => "http://" . $_SERVER['HTTP_HOST'] . "/Pay", //网关
            'fxloaderror' => 0 //是否开启数据记录 用于排错 0不开启 1开启
        );
        //获取后台配置的收钱账户
        $thisuserid=$publicData['peizhi']['bzjuserid'];
        if($thisuserid){
            $userBuffer=SM('User')->findData('userid,miyao','userid='.$thisuserid);
            $this->userTest['fxid']=$userBuffer['userid'];
            $this->userTest['fxkey']=$userBuffer['miyao'];
        }
    }

    //支付体验
    public function index() {
        if(!IS_POST){
            //判断是否有可用的接口
            $list=SL('Api')->getOpenApi();
            $this->assign('list',$list);
            $this->display();
            exit();
        }
        //发起支付
        session_start();
        $fxfee = $_REQUEST['fxfee'];
        $fxpay = $_REQUEST['fxpay'];
        if (empty($fxpay))
            $fxpay = 'wxwap';
        if (empty($fxfee))
            $fxfee = 1;
        $ddh = time() . mt_rand(1000, 9999); //商户订单号
        session('ddh', $this->userTest['fxid'].$ddh); //session存储商户订单号
        $data = array(
            "fxid" => $this->userTest['fxid'], //商户号
            "fxkey" => $this->userTest['fxkey'], //商户秘钥key 从用户后台获取
            "fxddh" => $ddh, //商户订单号
            "fxdesc" => "test", //商品名
            "fxfee" => $fxfee, //支付金额 单位元
            "fxattch" => 'mytest', //附加信息
            "fxnotifyurl" => $this->userTest['notifyUrl'], //异步回调 , 支付结果以异步为准
            "fxbackurl" => $this->userTest['backUrl'], //同步回调 不作为最终支付结果为准，请以异步回调为准
            "fxpay" => $fxpay, //支付类型 此处可选项为 微信公众号：wxgzh   微信H5网页：wxwap  微信扫码：wxsm   支付宝H5网页：zfbwap  支付宝扫码：zfbsm 等参考API
            "fxip" => get_client_ip(0, true) //支付端ip地址
        );
        $data["fxsign"] = md5($data["fxid"] . $data["fxddh"] . $data["fxfee"] . $data["fxnotifyurl"] . $data["fxkey"]); //加密
        $r = curl($this->userTest['fxgetway'], $data);
        $backr = json_decode($r, true); //json转数组
        $return=array();
        //验证返回信息
        if ($backr["status"] == 1) {
            //转入支付页面
            $return=[1,$backr["payurl"]];
        } else {
            //exit(print_r($r));
            //$return=[0,$backr['error'].print_r($r)];//输出详细信息
            if($backr["error"]) $return=[0,$backr["error"]];//输出错误信息
            else $return=[0,$r];//输出错误信息
        }
        $this->reback($return);
    }

    public function notifyUrl() {
        session_start();
        $fxid = $_REQUEST['fxid']; //商户编号
        $fxddh = $_REQUEST['fxddh']; //商户订单号
        $fxorder = $_REQUEST['fxorder']; //平台订单号
        $fxdesc = $_REQUEST['fxdesc']; //商品名称
        $fxfee = $_REQUEST['fxfee']; //交易金额
        $fxattch = $_REQUEST['fxattch']; //附加信息
        $fxstatus = $_REQUEST['fxstatus']; //订单状态
        $fxtime = $_REQUEST['fxtime']; //支付时间
        $fxsign = $_REQUEST['fxsign']; //md5验证签名串

        //获取商户编号对应key
        $userBuffer=SM('User')->findData('*','userid='.$fxid);

        $mysign = md5($fxstatus . $fxid . $fxddh . $fxfee . $userBuffer['miyao']); //验证签名
        //记录回调数据到文件，以便排错
        if ($this->userTest['fxloaderror'] == 1)
            file_put_contents('./demo.txt', '异步：' . serialize($_REQUEST) . "\r\n", FILE_APPEND);

        if ($fxsign == $mysign) {
            if ($fxstatus == '1') {//支付成功
                echo 'success';
            } else { //支付失败
                echo 'fail';
            }
        } else {
            echo 'sign error';
        }
    }

    public function backUrl() {
        session_start();
        $fxid = $_REQUEST['fxid']; //商户编号
        $fxddh = $_REQUEST['fxddh']; //商户订单号
        $fxorder = $_REQUEST['fxorder']; //平台订单号
        $fxdesc = $_REQUEST['fxdesc']; //商品名称
        $fxfee = $_REQUEST['fxfee']; //交易金额
        $fxattch = $_REQUEST['fxattch']; //附加信息
        $fxstatus = $_REQUEST['fxstatus']; //订单状态
        $fxtime = $_REQUEST['fxtime']; //支付时间
        $fxsign = $_REQUEST['fxsign']; //md5验证签名串

        $mysign = md5($fxstatus . $fxid . $fxddh . $fxfee . $this->userTest['fxkey']); //验证签名
        //记录回调数据到文件，以便排错
        if ($this->userTest['fxloaderror'] == 1)
            file_put_contents('./demo.txt', '同步：' . serialize($_REQUEST) . "\r\n", FILE_APPEND);

        if ($fxsign == $mysign) {
            if ($fxstatus == '1') {//支付成功
                //支付成功 转入支付成功页面
                echo 'success';
            } else { //支付失败
                echo 'fail';
            }
            exit();
        } else {
            /** 判断订单是否已经支付成功 如果不成功等待10秒刷新* */
            $ddh = session('ddh'); //获取session订单号
            $ddhft = session('ddhft'); //订单刷新次数
            //验证订单号是否支付成功
            $buffer=SM('Dingdan')->findData('*',"ordernum='".$ddh."'");
            if ($buffer['status'] == 1) { //支付成功
                //跳转到支付成功后的页面
                exit('success,支付成功');
            } else {
                //支付失败等待刷新验证
                //完善流程 刷新3次跳出刷新
                if (!empty($ddhft) && $ddhft > 2) {
                    session('ddhft', NULL);
                    exit('error,支付失败');
                }else{
                    $ddhft = empty($ddhft) ? 1 : $ddhft + 1;
                    session('ddhft', $ddhft);
                }

                echo '请等待支付结果返回,预计<span id="times">10</span>秒后跳转..';
                echo "<script>function ShowCountDown(){var time=document.getElementById('times').innerHTML;if(parseInt(time)<=1){location.href='" . $backurl . "';}else{time=parseInt(time)-1;document.getElementById('times').innerHTML=time; window.setTimeout(function(){ShowCountDown();}, 1000);} } window.setTimeout(function(){ShowCountDown();}, 1000); </script>";
            }

            exit();
        }
    }

    public function preorder() {
        $ddh = $_REQUEST['ddh']; //需要查询的订单号
        $data = array(
            "fxid" => $this->userTest['fxid'], //商户号
            "fxkey" => $this->userTest['fxkey'], //商户秘钥key 从用户后台获取
            "fxddh" => $ddh, //商户订单号
            "fxaction" => "orderquery"//查询动作
        );

        $data["fxsign"] = md5($data["fxid"] . $data["fxddh"] . $data["fxaction"] . $data["fxkey"]); //加密
        $r = file_get_contents($this->userTest['fxgetway'] . "?" . http_build_query($data));
        $backr = json_decode($r, true); //json转数组
        if ($backr['fxstatus'] == 1) {
            //支付成功
            exit('订单支付成功');
        } else {
            //支付失败
            //exit(print_r($r)); //返回的详细信息
            exit('订单支付失败：'.$backr['error']); //返回的错误信息
        }
    }

}
