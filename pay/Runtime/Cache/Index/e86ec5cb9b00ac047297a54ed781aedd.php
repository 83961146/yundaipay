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
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body" style="background:#fff;">
                                        <h4 class="pull-left">
                                            账户余额
                                        </h4>
                                        <h4 class="pull-right text-danger">
                                            ￥<?php echo ($user["money"]); ?> 元
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body" style="background:#fff;">
                                        <h4 class="pull-left">
                                            等待支付
                                        </h4>
                                        <h4 class="pull-right text-primary">
                                            ￥<?php echo ($tj["payhave"]); ?> 元
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body" style="background:#fff;">
                                        <h4 class="pull-left">
                                            已经提现
                                        </h4>
                                        <h4 class="pull-right text-info">
                                            ￥<?php echo ($user["tx"]); ?> 元
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body" style="background:#fff;">
                                        <h4 class="pull-left">
                                            订单总金额
                                        </h4>
                                        <h4 class="pull-right text-info">
                                            ￥<?php echo ($tj["dingdanall"]); ?> 元
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body" style="background:#fff;">
                                        <h4 class="pull-left">
                                            今日收益 (元)
                                        </h4>
                                        <h4 class="pull-right text-danger">
                                            ￥<?php echo ($tj["dingdantoday"]); ?> 元
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body" style="background:#fff;">
                                        <h4 class="pull-left">
                                            昨日收益（元）
                                        </h4>
                                        <h4 class="pull-right text-primary">
                                            ￥<?php echo ($tj["dingdanyes"]); ?> 元
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body" style="background:#fff;">
                                        <h4 class="pull-left">
                                            今日订单（笔）
                                        </h4>
                                        <h4 class="pull-right text-info">
                                            <?php echo ($tj["dingdantodaycount"]); ?> 笔
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body" style="background:#fff;">
                                        <h4 class="pull-left">
                                            昨日订单（笔）
                                        </h4>
                                        <h4 class="pull-right text-info">
                                            <?php echo ($tj["dingdanyescount"]); ?> 笔
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <em class="fa fa-bell-o fa-fw">
                                            </em>
                                            商户信息
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="list-group">
                                            <p>商户ID：<?php echo ($user["userid"]); ?></p>
                                            <p class="margin-small-top clearfix">
                                                <span class="fl">商户秘钥：<em class="text-blue-deep"><?php echo ($user["miyao"]); ?></em></span>
                                            </p><p>网关地址：http://<?php echo ($_SERVER['HTTP_HOST']); ?>/Pay/</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <em class="fa fa-bell-o fa-fw">
                                            </em>
                                            公告信息
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="list-group">
                                            <?php echo ($config["notice"]); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <em class="fa fa-bell-o fa-fw">
                                            </em>
                                            客服信息
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="list-group">
                                            <p>手机：<?php echo ($config["phone"]); ?></p>
                                            <p>QQ：<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo ($config["qq"]); ?>&amp;Menu=yes" target='_blank'><i class="iconfont icon-qq"><?php echo ($config["qq"]); ?></i></a></p>
                                        </div>
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