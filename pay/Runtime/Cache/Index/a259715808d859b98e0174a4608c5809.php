<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=gb2312">
        <meta charset="gb2312">
        <title><?php echo ($pageName); ?> - <?php echo ($sitename); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
        <meta name="renderer" content="webkit">
        <link href="/Public/plugin/bootstrap/bootstrap.css" type="text/css" rel="stylesheet">
        <link href="/Public/home/font-awesome.css" type="text/css" rel="stylesheet">
        <link href="/Public/home/style.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="/Public/plugin/jquery-1.8.0.min.js"></script>
        <script type="text/javascript" src="/Public/plugin/layer/layer.js"></script>
        <script type="text/javascript"src="/Public/plugin/laydate/laydate.js"></script>
        <script type="text/javascript" src="/Public/home/app.js"></script>
    </head>

<body class="">
    <div style="position:absolute;left:40%">
        <div class="woody-prompt">
            <div class="prompt-error alert alert-danger">
            </div>
        </div>
    </div>

    <div class="pace pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner">
            </div>
        </div>
        <div class="pace-activity">
        </div>
    </div>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu" style="display: block;">
            <li class="nav-header">
                <div class="dropdown profile-element text-center">
                    <span style="font-size:26px;color:#fff;font-weight:bold;">
                        <?php echo ($sitename); ?>
                    </span>
                </div>
            </li>
            <?php if($user["ifagent"] == '1' && $config["ifagent"] == '0'): ?><li class="active">
                <a href="#">
                    <span class="nav-label">
                        <i class="fa fa-home">
                        </i>
                        代理管理
                    </span></a>
            </li>
            <li class="">
                <a href="<?php echo U('Index/Home/dl');?>">
                    <span class="nav-label">
                        <i class="fa fa-newspaper-o">
                        </i>
                        代理详情
                    </span></a>
            </li>
            <li class="">
                <a href="<?php echo U('Index/Home/dluser');?>">
                    <span class="nav-label">
                        <i class="glyphicon glyphicon-user">
                        </i>
                        下级商户
                    </span></a>
            </li>
            <li class="">
                <a href="<?php echo U('Index/Home/dldingdan');?>">
                    <span class="nav-label">
                        <i class="fa fa-line-chart">
                        </i>
                        交易订单
                    </span></a>
            </li>
            <li class="">
                <a href="<?php echo U('Index/Home/dlfandian');?>">
                    <span class="nav-label">
                        <i class="fa fa-map-signs">
                        </i>
                        交易返点
                    </span></a>
            </li><?php endif; ?>

            <li class="active">
                <a href="#">
                    <span class="nav-label">
                        <i class="fa fa-home">
                        </i>
                        用户中心
                    </span></a>
            </li>
            <li class="">
                <a href="<?php echo U('Index/Home/index');?>">
                    <span class="nav-label">
                        <i class="fa fa-home">
                        </i>
                        用户首页
                    </span></a>
            </li>
            <li>
                <a href="<?php echo U('Index/Home/pass');?>">
                    <span class="nav-label">
                        <i class="fa fa-newspaper-o">
                        </i>
                        我的资料
                    </span></a>
            </li>
            <li>
                <a href="<?php echo U('Index/Home/dingdan');?>">
                    <span class="nav-label">
                        <i class="fa fa-line-chart">
                        </i>
                        交易记录
                    </span>
                </a>
            </li><li>
                <a href="<?php echo U('Index/Home/yhk');?>">
                    <span class="nav-label">
                        <i class="fa fa-server"></i>
                        提现账户
                    </span>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Index/Home/tx');?>">
                    <span class="nav-label">
                        <i class="fa fa-calendar-check-o">
                        </i>
                        申请提现
                    </span>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Index/Home/txjl');?>">
                    <span class="nav-label">
                        <i class="fa fa-calculator">
                        </i>
                        提现记录
                    </span></a>
            </li>
            <li>
                <a href="<?php echo U('Index/Home/fl');?>">
                    <span class="nav-label">
                        <i class="fa fa-map-signs">
                        </i>
                        费率详情
                    </span>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Index/Home/api');?>">
                    <span class="nav-label">
                        <i class="fa fa-wrench">
                        </i>
                        接入支付API
                    </span>
                </a>
            </li>
            <li>
                <a href="<?php echo U('Index/Home/loginout');?>">
                    <span class="nav-label">
                        <i class="fa fa-building-o">
                        </i>
                        退出系统
                    </span>
                </a>
            </li>
        </ul>
    </div>
</nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a href="<?php echo U('Index/Home/pass');?>" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user">
                    </span>
                    &nbsp;<?php echo ($user["username"]); ?>&nbsp;
                </a>
            </li>
            <li>
                <a href="<?php echo U('Index/Home/loginout');?>">
                    <i class="fa fa-sign-out">
                    </i>
                    退出登录
                </a>
            </li>
        </ul>
    </nav>
</div>
            <div class="row wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <em class="fa fa-list">
                                    </em>
                                    <?php echo ($pageName); ?>&nbsp;&nbsp;
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="alert alert-warning" style="margin-bottom:0;">
                                            <p><span class="glyphicon" style="margin-left:30px;"></span>您的商户ID：<font color="#000000"><?php echo ($user["userid"]); ?></font></p>
                                            <p><span class="glyphicon" style="margin-left:30px;"></span>商户密钥：<font color="#000000"><?php echo ($user["miyao"]); ?></font> </p>
                                            <p><span class="glyphicon" style="margin-left:30px;"></span>网关地址：http://<?php echo ($_SERVER['HTTP_HOST']); ?>/Pay/</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <em class="fa fa-list">
                                    </em>
                                    接口流程&nbsp;&nbsp;
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="alert alert-warning" style="margin-bottom:0;">
                                            <p><span class="glyphicon" style="margin-left:30px;"></span>①阅读下方接口文档 &nbsp;&nbsp;&nbsp;&nbsp;②获取上方商户ID及商户秘钥 &nbsp;&nbsp;&nbsp;&nbsp;③制作接口程序 &nbsp;&nbsp;&nbsp;&nbsp;④接口上线开始走量</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <em class="fa fa-list">
                                    </em>
                                    接口DEMO&nbsp;&nbsp;
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="alert alert-warning" style="margin-bottom:0;">
                                            <a href="/demo/php.rar">PHP版下载</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <em class="fa fa-list">
                                    </em>
                                    接口开发文档&nbsp;&nbsp;
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <h1>支付接口</h1>
                                        <p>支付接口参数(请求方式：GET或POST均可)</p>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>参数名称</th>
                                                    <th>参数含义</th>
                                                    <th>必填</th>
                                                    <th>说明</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>fxid</td>
                                                    <td>商务号</td>
                                                    <td>是</td>
                                                    <td>唯一号，由<?php echo ($sitename); ?>提供</td>
                                                </tr>
                                                <tr>
                                                    <td>fxddh</td>
                                                    <td>商户订单号</td>
                                                    <td>是</td>
                                                    <td>仅允许字母或数字类型,不超过22个字符，不要有中文</td>
                                                </tr>
                                                <tr>
                                                    <td>fxdesc</td>
                                                    <td>商品名称</td>
                                                    <td>是</td>
                                                    <td>utf-8编码</td>
                                                </tr>
                                                <tr>
                                                    <td>fxfee</td>
                                                    <td>支付金额</td>
                                                    <td>是</td>
                                                    <td>请求的价格(单位：元) 可以0.01元</td>
                                                </tr>
                                                <tr>
                                                    <td>fxattch</td>
                                                    <td>附加信息</td>
                                                    <td>否</td>
                                                    <td>原样返回，utf-8编码</td>
                                                </tr>
                                                <tr>
                                                    <td>fxnotifyurl</td>
                                                    <td>异步通知地址</td>
                                                    <td>是</td>
                                                    <td>异步接收支付结果通知的回调地址，通知url必须为外网可访问的url，不能携带参数。</td>
                                                </tr>
                                                <tr>
                                                    <td>fxbackurl</td>
                                                    <td>同步通知地址</td>
                                                    <td>是</td>
                                                    <td>支付成功后跳转到的地址，不参与签名。</td>
                                                </tr>
                                                <tr>
                                                    <td>fxpay</td>
                                                    <td>请求类型
                                                        <?php if(is_array($jiekou)): $i = 0; $__LIST__ = $jiekou;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$n): $mod = ($i % 2 );++$i;?>【<?php echo ($n["jkname"]); ?>：<?php echo ($n["jkstyle"]); ?>】<?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </td>
                                                    <td>是</td>
                                                    <td>请求支付的接口类型。</td>
                                                </tr>
                                                <tr>
                                                    <td>fxsign</td>
                                                    <td>签名【md5(商务号+商户订单号+支付金额+异步通知地址+商户秘钥)】</td>
                                                    <td>是</td>
                                                    <td>通过签名算法计算得出的签名值。</td>
                                                </tr>
                                                <tr>
                                                    <td>fxip</td>
                                                    <td>支付用户IP地址</td>
                                                    <td>是</td>
                                                    <td>用户支付时设备的IP地址</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <p>支付接口返回【数据格式：json】</p>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>参数</th>
                                                    <th>参数含义</th>
                                                    <th>必须</th>
                                                    <th>说明</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>status</td>
                                                    <td>状态</td>
                                                    <td>是</td>
                                                    <td>状态【1代表正常】【0代表错误】</td>
                                                </tr>
                                                <tr>
                                                    <td>payurl</td>
                                                    <td>支付链接</td>
                                                    <td>是</td>
                                                    <td>正常状态下返回支付跳转路径，跳转到该路径即可支付</td>
                                                </tr>
                                                <tr>
                                                    <td>error</td>
                                                    <td>错误信息</td>
                                                    <td>是</td>
                                                    <td>错误状态下返回错误信息utf-8编码数据</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <p>同步（GET）/异步（POST）返回参数【仅在成功状态下有参数返回，失败状态返回但不带参数】</p>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>参数</th>
                                                    <th>参数含义</th>
                                                    <th>必须</th>
                                                    <th>说明</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>fxid</td>
                                                    <td>商务号</td>
                                                    <td>是</td>
                                                    <td>唯一号，由<?php echo ($sitename); ?>提供</td>
                                                </tr>
                                                <tr>
                                                    <td>fxddh</td>
                                                    <td>商户订单号</td>
                                                    <td>是</td>
                                                    <td>平台返回商户提交的订单号</td>
                                                </tr>
                                                <tr>
                                                    <td>fxorder</td>
                                                    <td>平台订单号</td>
                                                    <td>是</td>
                                                    <td>平台内部生成的订单号</td>
                                                </tr>
                                                <tr>
                                                    <td>fxdesc</td>
                                                    <td>商品名称</td>
                                                    <td>是</td>
                                                    <td>utf-8编码</td>
                                                </tr>
                                                <tr>
                                                    <td>fxfee</td>
                                                    <td>支付金额</td>
                                                    <td>是</td>
                                                    <td>支付的价格(单位：元)</td>
                                                </tr>
                                                <tr>
                                                    <td>fxattch</td>
                                                    <td>附加信息</td>
                                                    <td>是</td>
                                                    <td>原样返回，utf-8编码</td>
                                                </tr>
                                                <tr>
                                                    <td>fxstatus</td>
                                                    <td>订单状态</td>
                                                    <td>是</td>
                                                    <td>【1代表支付成功】</td>
                                                </tr>
                                                <tr>
                                                    <td>fxtime</td>
                                                    <td>支付时间</td>
                                                    <td>是</td>
                                                    <td>支付成功时的时间，unix时间戳。</td>
                                                </tr>
                                                <tr>
                                                    <td>fxsign</td>
                                                    <td>签名【md5(订单状态+商务号+商户订单号+支付金额+商户秘钥)】</td>
                                                    <td>是</td>
                                                    <td>通过签名算法计算得出的签名值。</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p><font color="red">【商户接收数据后需要返回success代表通知成功】</font></p>

                                        <p>订单查询【提交参数GET或POST均可】</p>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>参数</th>
                                                    <th>参数含义</th>
                                                    <th>必须</th>
                                                    <th>说明</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>fxid</td>
                                                    <td>商务号</td>
                                                    <td>是</td>
                                                    <td>唯一号，由<?php echo ($sitename); ?>提供</td>
                                                </tr>
                                                <tr>
                                                    <td>fxddh</td>
                                                    <td>商户订单号</td>
                                                    <td>是</td>
                                                    <td>平台返回商户提交的订单号</td>
                                                </tr>
                                                <tr>
                                                    <td>fxaction</td>
                                                    <td>商户查询动作</td>
                                                    <td>是</td>
                                                    <td>商户查询动作，这里填写【orderquery】</td>
                                                </tr>
                                                <tr>
                                                    <td>fxsign</td>
                                                    <td>签名【md5(商务号+商户订单号+商户查询动作+商户秘钥)】</td>
                                                    <td>是</td>
                                                    <td>通过签名算法计算得出的签名值。</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p>订单查询返回【数据格式：json】</p>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>参数</th>
                                                    <th>参数含义</th>
                                                    <th>必须</th>
                                                    <th>说明</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>fxid</td>
                                                    <td>商务号</td>
                                                    <td>是</td>
                                                    <td>唯一号，由<?php echo ($sitename); ?>提供</td>
                                                </tr>
                                                <tr>
                                                    <td>fxstatus</td>
                                                    <td>状态</td>
                                                    <td>是</td>
                                                    <td>支付状态【1正常支付】【0支付异常】</td>
                                                </tr>
                                                <tr>
                                                    <td>fxddh</td>
                                                    <td>商户订单号</td>
                                                    <td>是</td>
                                                    <td>平台返回商户提交的订单号</td>
                                                </tr>
                                                <tr>
                                                    <td>fxorder</td>
                                                    <td>平台订单号</td>
                                                    <td>是</td>
                                                    <td>平台内部生成的订单号</td>
                                                </tr>
                                                <tr>
                                                    <td>fxdesc</td>
                                                    <td>商品名称</td>
                                                    <td>是</td>
                                                    <td>utf-8编码</td>
                                                </tr>
                                                <tr>
                                                    <td>fxfee</td>
                                                    <td>支付金额</td>
                                                    <td>是</td>
                                                    <td>支付的价格(单位：元)</td>
                                                </tr>
                                                <tr>
                                                    <td>fxattch</td>
                                                    <td>附加信息</td>
                                                    <td>是</td>
                                                    <td>原样返回，utf-8编码</td>
                                                </tr>
                                                <tr>
                                                    <td>fxtime</td>
                                                    <td>支付时间</td>
                                                    <td>是</td>
                                                    <td>支付成功时的时间，unix时间戳。</td>
                                                </tr>
                                                <tr>
                                                    <td>fxsign</td>
                                                    <td>签名【md5(订单状态+商务号+商户订单号+支付金额+商户秘钥)】</td>
                                                    <td>是</td>
                                                    <td>通过签名算法计算得出的签名值。</td>
                                                </tr>
                                                <tr>
                                                    <td>error</td>
                                                    <td>错误信息</td>
                                                    <td>是</td>
                                                    <td>错误状态下返回错误信息utf-8编码数据</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
    &copy;&nbsp;2017&nbsp;
    <?php echo ($config["sitename"]); echo (C("FX_VERSION")); ?>&nbsp;Powered by 风行
</div>

<!-- END modal-->
</body>
</html>