<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <title>注册 - <?php echo ($sitename); ?></title>
        <link href="/Public/plugin/bootstrap/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <link href="/Public/index/night/base.css" rel="stylesheet" type="text/css" media="all" />
        <link href="/Public/index/night/index.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" src="/Public/plugin/jquery-1.8.0.min.js"></script>
        <script type="text/javascript" src="/Public/home/app.js"></script>
    </head>
    <body class="singlebg">
        <div class="hd2">
            <div class="hdInner">
                <div class="l logo"><a href="/"><img src="/Public/index/night/logo.png" /></a></div>
                <div class="l dlBtn"><a href="javascript:;" class="tbtn loginBtn">登录</a><a class="tbtn" href="<?php echo U('/reg');?>">注册</a><a class="tbtn" href="<?php echo U('Test/index');?>">支付体验</a></div>
            </div>
        </div>
        <div class="regWrap">
            <form action="" class="regform form-horizontal" name="form1" method="post"  target="msgubotj">
                <div class="wzz">
                    <dl style="height:50px;line-height:30px;margin-top:20px;">
                        <dt>请填写注册类型</dt>
                    </dl>
                    <?php if($config["ifagent"] == '0'): ?><div class="form-group">
                        <label for="input3" class="col-sm-3 control-label">*账户类型</label>
                        <div class="col-sm-8">
                            <select class="agent form-control" name="ifagent">
                                <option value="0" selected="selected">商户</option>
                                <option value="1">代理</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="agent" class="agenthd" value="<?php echo ($_REQUEST['agent']); ?>" /><?php endif; ?>
                    <div class="form-group">
                        <label for="input1" class="col-sm-3 control-label">*登录账户</label>
                        <div class="col-sm-8">
                            <input type="text" id="input1" class="yhm usernamereg form-control" placeholder="登录账户" name="username" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input2" class="col-sm-3 control-label">*登录密码</label>
                        <div class="col-sm-8">
                            <input type="password" id="input2" class="mm pass form-control" placeholder="登录密码" name="pass" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input3" class="col-sm-3 control-label">*重复登录密码</label>
                        <div class="col-sm-8">
                            <input type="password" id="input3" class="mm pass1 form-control" placeholder="重复登录密码" name="pass2" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input4" class="col-sm-3 control-label">*提现密码</label>
                        <div class="col-sm-8">
                            <input type="password" id="input4" class="mm txmm form-control" placeholder="提现密码" name="txmm" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input5" class="col-sm-3 control-label">*重复提现密码</label>
                        <div class="col-sm-8">
                            <input type="password" id="input5" class="mm txmm1 form-control" placeholder="重复提现密码" name="txmm2" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input6" class="col-sm-3 control-label">*QQ号</label>
                        <div class="col-sm-8">
                            <input type="text" id="input6" class="qq form-control" placeholder="QQ号" name="qq" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input7" class="col-sm-3 control-label">*手机</label>
                        <div class="col-sm-8">
                            <input type="text" id="input7" class="phone form-control" placeholder="手机" name="phone" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input8" class="col-sm-3 control-label">*邮箱</label>
                        <div class="col-sm-8">
                            <input type="text" id="input8" class="email form-control" placeholder="邮箱" name="email" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="verifyCode" class="col-sm-3 control-label">*验证码</label>
                        <div class="col-sm-4">
                            <input type="text" id="verifyCode" class="yzm form-control" placeholder="验证码" name="yzm" />
                        </div>
                        <div class="col-sm-4">
                            <img height="33" width="95" id="verifyImg" src="<?php echo U('Index/Index/verify');?>" border="0" title="点击刷新验证码" align="absmiddle" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <div class="checkbox">
                                <label>
                                    <input name="checkboxAgree" id="checkboxAgree" checked="checked" type="checkbox"> 已经阅读并同意 <a href="javascript:;" class="serviceTerm">《注册协议》</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="text-align:center;">
                        <button type="button" name="add" class="zcBtn btn btn-default" >注册</button>
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
                    var agent = 0;
                    if ($('.agenthd').length> 0) {
                        agent = $('.agenthd').val();
                    }
                    var ifagent = 0;
                    if ($('.agent').length> 0) {
                        ifagent = $('.agent option:selected').val();
                    }
                    var username = $('.usernamereg').val();
                    var pass = $('.pass').val();
                    var pass1 = $('.pass1').val();
                    var txmm = $('.txmm').val();
                    var txmm1 = $('.txmm1').val();
                    var qq = $('.qq').val();
                    var phone = $('.phone').val();
                    var email = $('.email').val();
                    var yzm = $('.yzm').val();

                    if (username == '' || pass == '') {
                        layer.alert('请输入用户名和密码');
                        return;
                    }
                    if (pass != pass1) {
                        layer.alert('两次输入的密码不一致');
                        return;
                    }
                    if (txmm != txmm1) {
                        layer.alert('两次输入的提现密码不一致');
                        return;
                    }
                    if (qq == '') {
                        layer.alert('请输入qq号');
                        return;
                    }
                    if (phone == '') {
                        layer.alert('请输入手机号');
                        return;
                    }
                    if (email == '') {
                        layer.alert('请输入邮箱');
                        return;
                    }
                    if (yzm == '') {
                        layer.alert('请输入验证码');
                        return;
                    }
                    var index = layer.load();
                    $.post('<?php echo U("/reg");?>', {'agent': agent, 'ifagent': ifagent, 'username': username, 'pass': pass, 'pass1': pass1, 'txmm': txmm, 'txmm1': txmm1, 'qq': qq, 'phone': phone, 'email': email,'yzm':yzm, 't': Math.random()}, function (result) {
                        layer.close(index);
                        if (result.status == '0') {
                            layer.alert(result['data']);
                            return;
                        }
                        if (result.status == '1') {
                            layer.msg(result['data'][0], {'time': 1000 * parseInt(result['data'][2])}, function () {
                                if (typeof (result['data'][1]) != 'undefined' && result['data'][1]) {
                                    window.location.href = result['data'][1];
                                }
                            });
                            return;
                        }
                        layer.alert(result);
                    });
                });
                //注册协议
                var xy='';
                var title='协议内容';
                $('.serviceTerm').on('click',function(){
                    if(xy==''){
                        var index=layer.load();
                        $.post('<?php echo U("Index/Index/getxy");?>',{},function(data){
                            layer.close(index);
                            if(data['status']==1){
                                xy=data['data'][0];
                                index = layer.open({
                                    title:title,
                                    content: xy,
                                    area:['500px','300px']
                                });
                            }else{
                                layer.alert(data['data']);
                            }
                        });
                    }else{
                        var index = layer.open({
                            title:title,
                            content: xy
                        });
                    }
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