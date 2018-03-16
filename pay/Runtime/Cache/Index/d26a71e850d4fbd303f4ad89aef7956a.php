<?php if (!defined('THINK_PATH')) exit();?>

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
        
        <div id="page-wrapper" class="gray-bg">
            

            <div class="row wrapper wrapper-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body brand-danger" style="background:#F05033;">
                                        <div class="text-center">
                                            <span class="img-circle">
                                                <i class="fa fa-user fa-3x">
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <h4 class="pull-left">
                                            账户余额
                                        </h4>
                                        <h4 class="pull-right text-danger">

                                            <?php if($user[money] == null){ ?>￥0<?php }else{ ?>￥<?php $xs4=round($user[money],2);echo $xs4; } ?> </em>元

                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body brand-primary" style="background:#3498DB;">
                                        <div class="text-center">
                                            <span class="img-circle">
                                                <i class="fa fa-usd fa-3x">
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <h4 class="pull-left">
                                            等待支付
                                        </h4>
                                        <h4 class="pull-right text-primary">

                                            <?php if($paymoney == null){ ?>￥0<?php }else{ ?>￥<?php $xs4=round($paymoney,2);echo $xs4; } ?> </em>元
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body brand-info" style="background:#8E44AD;">
                                        <div class="text-center">
                                            <span class="img-circle">
                                                <i class="fa fa-bar-chart fa-3x">
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <h4 class="pull-left">
                                            已经提现
                                        </h4>
                                        <h4 class="pull-right text-info">
                                            <?php if($user[tx] == null){ ?>￥0<?php }else{ ?>￥<?php $xs4=round($user[tx],2);echo $xs4; } ?> </em>元
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body brand-info" style="background:#1FA67A;">
                                        <div class="text-center">
                                            <span class="img-circle">
                                                <i class="fa fa-diamond fa-3x">
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <h4 class="pull-left">
                                            订单总金额
                                        </h4>
                                        <h4 class="pull-right text-info">
                                            <?php if($money5 == null){ ?>￥0<?php }else{ ?>￥<?php $xs4=round($money5,2);echo $xs4; } ?> </em>元
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body brand-danger" style="background:#F05033;">
                                        <div class="text-center">
                                            <span class="img-circle">
                                                <i class="fa fa-user fa-3x">
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <h4 class="pull-left">
                                            今日收益 (元)
                                        </h4>
                                        <h4 class="pull-right text-danger">

                                            <?php if($money1 == null){ ?>￥0 <?php }else{ ?>￥<?php $xs1=round($money1,2);echo $xs1;?> <?php } ?>   元
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body brand-primary" style="background:#3498DB;">
                                        <div class="text-center">
                                            <span class="img-circle">
                                                <i class="fa fa-usd fa-3x">
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <h4 class="pull-left">
                                            昨日收益（元）
                                        </h4>
                                        <h4 class="pull-right text-primary">

                                            <?php if($money2 == null){ ?>￥0 <?php }else{ ?>￥<?php $xs2=round($money2,2);echo $xs2;?>  <?php } ?>  元
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body brand-info" style="background:#8E44AD;">
                                        <div class="text-center">
                                            <span class="img-circle">
                                                <i class="fa fa-bar-chart fa-3x">
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <h4 class="pull-left">
                                            今日订单（笔）
                                        </h4>
                                        <h4 class="pull-right text-info">
                                            <?php if($daydd == null){ ?>0 <?php }else{ echo $daydd?> <?php } ?> 笔
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="panel">
                                    <div class="panel-body brand-info" style="background:#1FA67A;">
                                        <div class="text-center">
                                            <span class="img-circle">
                                                <i class="fa fa-diamond fa-3x">
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <h4 class="pull-left">
                                            昨日订单（笔）
                                        </h4>
                                        <h4 class="pull-right text-info">
                                            <?php if($zuoridd == null){ ?>0 <?php }else{ echo $zuoridd?> <?php } ?>  笔
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
                                            <?php if(!empty($user['regmoney'])){ ?>
                                            <p>商户ID：<?php echo $user[userid]?></p>
                                            <p class="margin-small-top clearfix">
                                                <span class="fl">商户秘钥：<em class="text-blue-deep"><?php echo $user[miyao]?></em></span>
                                            </p><p>网关地址：http://<?php echo $wgurl?>/pay/</p>                                          									
                                            <?php }else{ ?>
                                            支付保证金后显示 <a href="api.php">去支付</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="panel">
                                    <div class="row">
                                        <div class="alert alert-warning" style="margin-bottom:0;font-size:14px;">
                                            <p><span class="glyphicon glyphicon-info-sign" style="margin-left:30px;"></span>
                                                微信H5WAP 可以接了 微信公众号 微信扫码 有量来对接吧！</p>
                                            <p><span class="glyphicon glyphicon-info-sign" style="margin-left:30px;"></span>
                                                微信H5WAP 可以接了 微信公众号 微信扫码 有量来对接吧！</p>
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