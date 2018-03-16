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
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <em class="fa fa-list">
                                    </em>
                                    <?php echo ($pageName); ?></div>
                            </div>
                            <div class="panel-body">
                                <div class="content-box">
                                    <form class="form-horizontal"  action="<?php echo U('Index/Home/dingdancf');?>" method="post">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">
                                                系统订单号：
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control ddh" name="ordernum" value="<?php echo ($edit["ordernum"]); ?>" required lay-verify="required" placeholder="请输入订单号">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">
                                                我的订单号：
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control ddh" name="sigleddh" value="<?php echo ($edit["sigleddh"]); ?>" required lay-verify="required" placeholder="请输入订单号"  />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">
                                                参数：
                                            </label>
                                            <div class="col-md-4">
                                                <textarea class="form-control params" cols="50" rows="5" name="params" ><?php echo ($edit["params"]); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">
                                                发送地址：
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control notifyurl" name="notifyurl" value="<?php echo ($edit["notifyurl"]); ?>" required lay-verify="required" placeholder="请输入发送地址" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">
                                                返回值：
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control returntxt" name="return" value="" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-offset-2 col-md-4">
                                                <input type="hidden" class="form-control" name="act" value="<?php echo ($act); ?>"/>
                                                <input type="hidden" class="form-control" name="ddid" value="<?php echo ($edit["ddid"]); ?>"/>
                                                <?php if($edit["status"] == '0'): ?>订单未支付
                                                <?php else: ?>
                                                <button type="button" class="btn btn-success resend">
                                                    &nbsp;
                                                    <span class="glyphicon glyphicon-save">
                                                    </span>
                                                    &nbsp;提交&nbsp;
                                                </button><?php endif; ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.resend').on('click', function () {
            var index = layer.load();
            var ddh = $('.ddh').val();
            var notifyurl = $('.notifyurl').val();
            var params = $('.params').html();
            $.post('<?php echo U("Index/Home/dingdancf");?>', {'url': notifyurl, 'ddh': ddh, 'params': params, 'times': Math.random()}, function (data) {
                layer.close(index);
                if(data.status==1){
                    $('.returntxt').val(data['data'][0]);
                    layer.alert('返回信息：' + data['data'][0]);
                }else if(data.status==0){
                    layer.alert('返回信息：' + data['data']);
                }else{
                    layer.alert('返回信息：' + data);
                }
            });
        });

    </script>
    <div id="footer">
    &copy;&nbsp;2017&nbsp;
    <?php echo ($config["sitename"]); echo (C("FX_VERSION")); ?>&nbsp;Powered by 风行
</div>

<!-- END modal-->
</body>
</html>