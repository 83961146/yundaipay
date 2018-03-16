<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <title>支付体验 - <?php echo ($sitename); ?></title>
        <link href="/Public/plugin/bootstrap/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <link href="/Public/index/night/base.css" rel="stylesheet" type="text/css" media="all" />
        <link href="/Public/index/night/index.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body class="singlebg">
        <div class="hd2">
            <div class="hdInner">
                <div class="l logo"><a href="/"><img src="/Public/index/night/logo.png" /></a></div>
                <div class="l dlBtn"><a href="javascript:;" class="tbtn loginBtn">登录</a><a class="tbtn" href="<?php echo U('/reg');?>">注册</a><a class="tbtn" href="<?php echo U('Test/index');?>">支付体验</a></div>
            </div>
        </div>
        <div class="regWrap">
            <form action="" class="regform form-horizontal" name="form1" method="post">
                <div class="wzz">
                    <dl style="height:50px;line-height:30px;margin-top:20px;">
                        <dt>请选择支付方式</dt>
                    </dl>
                    <div class="form-group">
                        <label for="input3" class="col-sm-3 control-label">*支付方式</label>
                        <div class="col-sm-8 ">
                            <select class="fxpay form-control" name="fxpay">
                                <?php if($list): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$n): $mod = ($i % 2 );++$i;?><option value="<?php echo ($n["jkstyle"]); ?>" ><?php echo ($n["jkname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                <?php else: ?>
                                <option value="">暂无可用接口</option><?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input1" class="col-sm-3 control-label">*支付金额</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" id="input1" value="1" class="fxfee form-control" placeholder="支付金额" name="fxfee" aria-describedby="basic-addon1" />
                                <span class="input-group-addon" id="basic-addon1">元</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ewmdiv" style="display:none;">
                        <label for="input1" class="col-sm-3 control-label">二维码扫描</label>
                        <div class="col-sm-8 ewm">
                            
                        </div>
                    </div>
                    <div class="form-group" style="text-align:center;padding-top:30px;">
                        <button type="button" name="add" class="zcBtn btn btn-default" >支付</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="ft">

        </div><div class="copyright">Copyright @2015-2017 <?php echo ($sitename); ?> All Rights Reserved</div>
        <script language="javascript" src="/Public/plugin/jquery-1.8.0.min.js"></script>
        <script language="javascript" src="/Public/plugin/layer/layer.js"></script>
        <script>
            $(document).ready(function () {
                $('.zcBtn').on('click', function () {
                    $('.ewmdiv').css({'display':'none'});
                    var fxpay= $('.fxpay option:selected').val();
                    var fxfee= $('.fxfee').val();
                    if(fxpay==''){
                        layer.alert('请选择支付接口。');
                        return;
                    }
                    if(parseFloat(fxfee)<0.01){
                        layer.alert('请填写正确的支付金额。');
                        return;
                    }
                    var index = layer.load();
                    $.post('<?php echo U("Test/index");?>', {'fxpay': fxpay, 'fxfee': fxfee, 't': Math.random()}, function (result) {
                        layer.close(index);
                        if (result.status == '0') {
                            layer.alert(result['data']);
                            return;
                        }
                        if (result.status == '1') {
                            if(fxpay.indexOf('sm')!=-1){
                                $('.ewm').html('<img src="'+result['data'][0]+'"/>');
                                $('.ewmdiv').css({'display':'block'});
                            }else{
                                location.href=result['data'][0];
                            }
                            return;
                        }
                        layer.alert(result);
                    });
                });
            });
        </script>
        <div class="mask"></div>
<form name="form1" method="post" action="<?php echo U('Index/login');?>">
    <div class="logTc">
        <div class="closeBar"><span class="close"></span></div>
        <h2>用户登录</h2>
        <div class="dlCon">
            <span class="tip1"></span>
            <p class="p1"><input type="text" placeholder="请输入用户名" class="username usernamelogin" name="username"  value="" /></p>
            <span class="tip1"></span>
            <p class="p1"><input type="password" placeholder="请输入密码" class="password passwordlogin" name="password"  value="" /></p>
            <p class="p3"><input type="button" value="登录" name="btn" class="loginedbtn" /></p>
        </div>
        <div class="dlBot">
            <p>还没有<?php echo ($sitename); ?>账号？<a href="<?php echo U('/reg');?>" class="ljzc">立即注册</a></p>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        //登录弹出框
        $(".loginBtn").click(function (event) {
            event.preventDefault();
            $(".mask").show();
            $(".logTc").show();
            $(".close").click(function () {
                $(".mask").hide();
                $(".logTc").hide();
            });
        });
        $('.loginedbtn').on('click', function () {
            var username = $('.usernamelogin').val();
            var password = $('.passwordlogin').val();
            if (username == '' || password == '') {
                layer.alert('请输入用户名和密码');
                return;
            }
            var index = layer.load();
            $.post('<?php echo U("Index/Index/login");?>', {'username':username,'password':password,'t':Math.random()}, function (result) {
                layer.close(index);
                if(result.status=='0'){
                    layer.alert(result['data']);
                            return ;
                }
                if (result.status == '1') {
                    layer.msg(result['data'][0], {'time': 1000 * parseInt(result['data'][2])}, function () {
                        if (typeof (result['data'][1]) != 'undefined' && result['data'][1]) {
                            window.location.href = result['data'][1];
                        }
                    });
                            return ;
                }
                        layer.alert(result);
            });
        });
    });
</script>
    </body>
</html>