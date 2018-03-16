<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>注册 - <?php echo ($sitename); ?></title>
        <link href="/Public/index/night/base.css" rel="stylesheet" type="text/css" media="all" />
        <link href="/Public/index/night/index.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>
        <div class="hd2">
            <div class="hdInner">
                <div class="l logo"><a href="/"><img src="/Public/index/night/logo.png" /></a></div>
                <ul>
                    <!--<li class=""><a href="/">首页</a></li>-->
                    <!--<li class=""><a href="new.php">联盟公告</a></li>-->
                </ul>
                <div class="l dlBtn"><a href="javascript:;" class="tbtn loginBtn">登录</a><a class="tbtn" href="<?php echo U('Index/Index/register');?>">注册</a></div>
            </div>
        </div>
        <div class="regWrap">
            <form action="" name="form1" method="post"  target="msgubotj">
                <div class="wzz">
                    <dl>
                        <dt>请填写注册类型</dt>
                        <dd><label>*账户类型：</label>
                            <input type="radio" class="agent" style="width:auto;" name="ifagent" checked="checked" value="0" />商户
                            <input type="radio" class="agent" style="width:auto;" name="ifagent" value="1" />代理
                        </dd>
                    </dl>
                    <input type="hidden" name="agent" class="agenthd" value="<?php echo ($_REQUEST['agent']); ?>" />
                    <dl>
                        <dt>请设置账户信息</dt>
                        <dd><label>*登录账户：</label><input type="text" class="yhm usernamereg" name="username" /></dd>
                        <dd><label>*登录密码：</label><input type="password" class="mm pass" name="pass" /></dd>
                        <dd><label>*重复登录密码：</label><input type="password" class="mm pass1" name="pass" /></dd>
                        <dd><label>*提现密码：</label><input type="password" class="mm txmm" name="txmm" /></dd>
                        <dd><label>*重复提现密码：</label><input type="password" class="mm txmm1" name="txmm" /></dd>
                    </dl>
                    <dl>
                        <dt>请设置个人信息</dt>
                        <dd><label>*QQ号：</label><input type="text" class="qq" name="qq" /></dd>
                        <dd><label>*手机：</label><input type="text" class="phone" name="phone" /></dd>
                        <dd><label>*邮箱：</label><input type="text" class="email" name="email" /></dd>
                    </dl>
                    <div style="margin-left:172px"><label for="checkboxAgree">
                            <input name="checkboxAgree" id="checkboxAgree" checked="checked" type="checkbox"> 已经阅读并同意</label><a href="javascript:;" class="serviceTerm">《注册协议》</a></div>
                    <p><input type="button" name="add" value="注册" class="zcBtn" /></p>
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
                    var agent=0;
                    if($('.agenthd').length==0){
                        agent=$('.agenthd').val();
                    }
                    var ifagent=0;
                    if($('.agent').length==0){
                        ifagent=$('.agent:checked').val();
                    }
                    var username = $('.usernamereg').val();
                    var pass = $('.pass').val();
                    var pass1 = $('.pass1').val();
                    var txmm = $('.txmm').val();
                    var txmm1 = $('.txmm1').val();
                    var qq = $('.qq').val();
                    var phone = $('.phone').val();
                    var email = $('.email').val();
                    
                    if (username == '' || pass == '') {
                        layer.alert('请输入用户名和密码');
                        return ;
                    }
                    if (pass != pass1) {
                        layer.alert('两次输入的密码不一致');
                        return ;
                    }
                    if (txmm != txmm1) {
                        layer.alert('两次输入的提现密码不一致');
                        return ;
                    }
                    if (qq == '') {
                        layer.alert('请输入qq号');
                        return ;
                    }
                    if (phone == '') {
                        layer.alert('请输入手机号');
                        return ;
                    }
                    if (email =='') {
                        layer.alert('请输入邮箱');
                        return ;
                    }
                    var index = layer.load();
                    $.post('<?php echo U("Index/Index/register");?>', {'agent':agent,'ifagent':ifagent,'username':username,'pass':pass,'pass1':pass1,'txmm':txmm,'txmm1':txmm1,'qq':qq,'phone':phone,'email':email,'t':Math.random()}, function (result) {
                        layer.close(index);
                        if (result.status == '0') {
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
            <p>还没有<?php echo ($sitename); ?>账号？<a href="<?php echo U('Index/Index/register');?>" class="ljzc">立即注册</a></p>
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