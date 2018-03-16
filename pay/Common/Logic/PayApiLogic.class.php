<?php
// +----------------------------------------------------------------------
// | easy pay [ pay to easy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 All rights reserved.
// +----------------------------------------------------------------------
// | Author: fengxing <QQ:51125330>
// +----------------------------------------------------------------------
namespace Common\Logic;

class PayApiLogic extends BaseLogic {

    /**
     * 总接口
     * $request = array(
      'id' => $jkpz['jzid'],
      'peizhi' => unserialize($jkpz['params']),
      'style' => $jkpz['style'],
      'fxddh' => $fxid . $fxddh,
      'fxdesc' => $fxdesc,
      'fxfee' => $fxfee,
      'fxattch' => $fxattch,
      'fxnotifyurl' => $fxnotifyurl,
      'fxbackurl' => $fxbackurl,
      'fxpay' => $fxpay,
      'fxip' => $fxip
     * 'isjsapi'=>0 或1 是否调用jsapi
      );
     */
    public function index($request) {
        //调用接口
        $style = $request['style'];
        return $this->$style($request);
    }

    /**
     * 微信接口
     */
    protected function wechat($request) {
        $types = 'MWEB';
        switch ($request['fxpay']) {
            case 'wxwap':
                $types = 'MWEB';
                break;
            case 'wxgzh':
                $types = 'JSAPI';
                break;
            case 'wxsm':
                $types = 'NATIVE';
                break;
        }

        if ($types == "JSAPI" && empty($request['isjsapi'])) {
            return [1,"http://" . $_SERVER['HTTP_HOST'] . "/Pay/jsapi?style=wechat&id=" . $request['id'] . '&ddh=' . $request['fxddh'] . '&t=' . time()];
            //return [1,"http://" . $_SERVER['HTTP_HOST'] . "/Index/Pay/jsapi/style/wechat/id/" . $request['id'] . '/ddh/' . $request['fxddh'] . '/t/' . time()];
        }

        include_once COMMON_PATH . "/Tool/wechat/lib/WxPay.Api.php";
        if ($types == 'JSAPI') {
            include_once COMMON_PATH . "/Tool/wechat/WxPay.JsApiPay.php";
            $tools = new \JsApiPay();
            $openId = $tools->GetOpenid($request['peizhi']['wechat_appid'],$request['peizhi']['wechat_appsecret']);
        } else {
        }
        include_once COMMON_PATH . "/Tool/wechat/WxPay.NativePay.php";

        \WxPayConfig::setAPPID($request['peizhi']['wechat_appid']);
        \WxPayConfig::setMCHID($request['peizhi']['wechat_mchid']);
        \WxPayConfig::setKEY($request['peizhi']['wechat_key']);
        \WxPayConfig::setAPPSECRET($request['peizhi']['wechat_appsecret']);

        $input = new \WxPayUnifiedOrder();
        $input->SetBody((string) $request['fxdesc']);
        $input->SetAttach((string) $request['fxattch']);
        $input->SetOut_trade_no((string) $request['fxddh']);
        $input->SetTotal_fee($request['fxfee'] * 100);
        $input->SetNotify_url($request['fxnotifyurl']);
        $input->SetTrade_type((string) $types);
        if ($types == 'MWEB')
            $input->SetSpbill_create_ip((string) $request['fxip']);
        else {
            $input->SetTime_start((string) date("YmdHis"));
            $input->SetTime_expire((string) (date("YmdHis", time() + 600)));
            $input->SetGoods_tag("");

            if ($types == 'NATIVE') {
                $input->SetSpbill_create_ip((string) get_client_ip(0, true));
                $input->SetProduct_id((string) $request['fxddh']);
            }

            if ($types == 'JSAPI') {
                $input->SetOpenid($openId);
            }
        }

        $notify = new \NativePay();
        $result = $notify->GetPayUrl($input);

        if ($types == 'JSAPI') {
            $jsApiParameters = $tools->GetJsApiParameters($result);
            $editAddress = $tools->GetEditAddressParameters();
            return array(
                1,
                array(
                    'jsApiParameters' => $jsApiParameters,
                    'editAddress' => $editAddress));
        }

        if ($result["return_msg"] != 'OK') {
            return array(
                0,
                $result["return_msg"]);
        }
        if ($types == "NATIVE")
            $result = 'http://pan.baidu.com/share/qrcode?w=150&h=150&url=' . $result["code_url"];
        else
            $result = 'http://' . $_SERVER['HTTP_HOST'] . '/Pay/go?u=' . urlencode($result["mweb_url"]);

        return array(
            1,
            $result);
    }

    /**
     * 支付宝接口
     */
    protected function alipay($request) {
        switch ($request['fxpay']) {
            case 'zfbwap':
                //调用接口
                include_once COMMON_PATH . "/Tool/alipay/wappay/service/AlipayTradeService.php";
                include_once COMMON_PATH . "/Tool/alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php";
                include_once COMMON_PATH . "/Tool/alipay/config.php";

                $config['app_id'] = $request['peizhi']['alipay_appid'];
                $config['sign_type'] = $request['peizhi']['alipay_sign'];
                $config['merchant_private_key'] = $request['peizhi']['alipay_private'];
                $config['alipay_public_key'] = $request['peizhi']['alipay_public'];
                $config['notify_url'] = $request['fxnotifyurl'];
                $config['return_url'] = $request['fxbackurl'];

                $subject = $request['fxdesc'];
                if (!$subject)
                    $subject = 'alipay wap';

                $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
                $payRequestBuilder->setBody($request['fxattch']); //商品描述，可空
                $payRequestBuilder->setSubject($subject); //订单名称，必填
                $payRequestBuilder->setOutTradeNo($request['fxddh']); //商户订单号，商户网站订单系统中唯一订单号，必填
                $payRequestBuilder->setTotalAmount($request['fxfee']); //付款金额，必填
                $payRequestBuilder->setTimeExpress("1m"); //超时时间

                $payResponse = new \AlipayTradeService($config);
                $result = $payResponse->wapPay($payRequestBuilder, $request['fxbackurl'], $request['fxnotifyurl']);
                return [1,$result];
                break;
            case 'zfbsm':
                include COMMON_PATH . "/Tool/alipay/config.php";
                include_once COMMON_PATH . "/Tool/alipay/f2fpay/service/AlipayTradeService.php";
                include_once COMMON_PATH . "/Tool/alipay/f2fpay/model/builder/AlipayTradePrecreateContentBuilder.php";
                $config['app_id'] = $request['peizhi']['alipay_appid'];
                $config['sign_type'] = $request['peizhi']['alipay_sign'];
                $config['merchant_private_key'] = $request['peizhi']['alipay_private'];
                $config['alipay_public_key'] = $request['peizhi']['alipay_public'];
                $config['notify_url'] = $request['fxnotifyurl'];
                $config['return_url'] = $request['fxbackurl'];
                // (必填) 商户网站订单系统中唯一订单号，64个字符以内，只能包含字母、数字、下划线，
                // 需保证商户系统端不能重复，建议通过数据库sequence生成，
                //$outTradeNo = "qrpay".date('Ymdhis').mt_rand(100,1000);
                $outTradeNo = $request['fxddh'];

                // (必填) 订单标题，粗略描述用户的支付目的。如“xxx品牌xxx门店当面付扫码消费”
                $subject=$request['fxdesc'];
                if (!$subject)  $subject = 'alipay sm';

                // (必填) 订单总金额，单位为元，不能超过1亿元
                // 如果同时传入了【打折金额】,【不可打折金额】,【订单总金额】三者,则必须满足如下条件:【订单总金额】=【打折金额】+【不可打折金额】
                $totalAmount = $request['fxfee'];


                // (不推荐使用) 订单可打折金额，可以配合商家平台配置折扣活动，如果订单部分商品参与打折，可以将部分商品总价填写至此字段，默认全部商品可打折
                // 如果该值未传入,但传入了【订单总金额】,【不可打折金额】 则该值默认为【订单总金额】- 【不可打折金额】
                //String discountableAmount = "1.00"; //
                // (可选) 订单不可打折金额，可以配合商家平台配置折扣活动，如果酒水不参与打折，则将对应金额填写至此字段
                // 如果该值未传入,但传入了【订单总金额】,【打折金额】,则该值默认为【订单总金额】-【打折金额】
                //$undiscountableAmount = "0.01";
                // 卖家支付宝账号ID，用于支持一个签约账号下支持打款到不同的收款账号，(打款到sellerId对应的支付宝账号)
                // 如果该字段为空，则默认为与支付宝签约的商户的PID，也就是appid对应的PID
                //$sellerId = "";
                // 订单描述，可以对交易或商品进行一个详细地描述，比如填写"购买商品2件共15.00元"
                $body = $request['fxattch'];

                //商户操作员编号，添加此参数可以为商户操作员做销售统计
                //$operatorId = "test_operator_id";
                // (可选) 商户门店编号，通过门店号和商家后台可以配置精准到门店的折扣信息，详询支付宝技术支持
                //$storeId = "test_store_id";
                // 支付宝的店铺编号
                //$alipayStoreId= "test_alipay_store_id";
                // 业务扩展参数，目前可添加由支付宝分配的系统商编号(通过setSysServiceProviderId方法)，系统商开发使用,详情请咨询支付宝技术支持
                //$providerId = ""; //系统商pid,作为系统商返佣数据提取的依据
                //$extendParams = new ExtendParams();
                //$extendParams->setSysServiceProviderId($providerId);
                //$extendParamsArr = $extendParams->getExtendParams();
                // 支付超时，线下扫码交易定义为5分钟
                $timeExpress = "5m";
                /*
                  // 商品明细列表，需填写购买商品详细信息，
                  $goodsDetailList = array();

                  // 创建一个商品信息，参数含义分别为商品id（使用国标）、名称、单价（单位为分）、数量，如果需要添加商品类别，详见GoodsDetail
                  $goods1 = new GoodsDetail();
                  $goods1->setGoodsId("apple-01");
                  $goods1->setGoodsName("iphone");
                  $goods1->setPrice(3000);
                  $goods1->setQuantity(1);
                  //得到商品1明细数组
                  $goods1Arr = $goods1->getGoodsDetail();

                  // 继续创建并添加第一条商品信息，用户购买的产品为“xx牙刷”，单价为5.05元，购买了两件
                  $goods2 = new GoodsDetail();
                  $goods2->setGoodsId("apple-02");
                  $goods2->setGoodsName("ipad");
                  $goods2->setPrice(1000);
                  $goods2->setQuantity(1);
                  //得到商品1明细数组
                  $goods2Arr = $goods2->getGoodsDetail();

                  $goodsDetailList = array($goods1Arr,$goods2Arr);
                 */
                //第三方应用授权令牌,商户授权系统商开发模式下使用
                //$appAuthToken = "";//根据真实值填写
                // 创建请求builder，设置请求参数
                $qrPayRequestBuilder = new \AlipayTradePrecreateContentBuilder();
                $qrPayRequestBuilder->setOutTradeNo($outTradeNo);
                $qrPayRequestBuilder->setTotalAmount($totalAmount);
                $qrPayRequestBuilder->setTimeExpress($timeExpress);
                $qrPayRequestBuilder->setSubject($subject);
                $qrPayRequestBuilder->setBody($body);
                //$qrPayRequestBuilder->setUndiscountableAmount($undiscountableAmount);
                //$qrPayRequestBuilder->setExtendParams($extendParamsArr);
                //$qrPayRequestBuilder->setGoodsDetailList($goodsDetailList);
                //$qrPayRequestBuilder->setStoreId($storeId);
                //$qrPayRequestBuilder->setOperatorId($operatorId);
                //$qrPayRequestBuilder->setAlipayStoreId($alipayStoreId);
                //$qrPayRequestBuilder->setAppAuthToken($appAuthToken);
                // 调用qrPay方法获取当面付应答
                $qrPay = new \AlipayTradeServicef2f($config);
                $qrPayResult = $qrPay->qrPay($qrPayRequestBuilder);

                //根据状态值进行业务处理
                switch ($qrPayResult->getTradeStatus()) {
                    case "SUCCESS":
                        //echo "支付宝创建订单二维码成功:"."<br>---------------------------------------<br>";
                        $response = $qrPayResult->getResponse();
                        return [1,'http://pan.baidu.com/share/qrcode?w=150&h=150&url=' .$response->qr_code];
                        //print_r($response);
                        break;
                    case "FAILED":
                        return [0,"支付宝创建订单二维码失败!!!"];
                        //if(!empty($qrPayResult->getResponse())){
                        //print_r($qrPayResult->getResponse());
                        //}
                        break;
                    case "UNKNOWN":
                        return [0,"系统异常，状态未知!!!"];
                        //if(!empty($qrPayResult->getResponse())){
                        //print_r($qrPayResult->getResponse());
                        //}
                        break;
                    default:
                        return [0,"不支持的返回状态，创建订单二维码返回异常!!!"];
                        break;
                }
                break;
        }
    }
}