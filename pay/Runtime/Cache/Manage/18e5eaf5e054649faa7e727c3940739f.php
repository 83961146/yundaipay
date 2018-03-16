<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
    <html>
        
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <title><?php echo ($pageName); ?> - <?php echo ($siteName); ?></title>
            <link href="/Public/plugin/bootstrap/bootstrap.css" type="text/css" rel="stylesheet" />
            <script src="/Public/plugin/jquery-1.8.0.min.js" type="text/javascript"></script>
            <script src="/Public/plugin/jquery.zclip.min.js" type="text/javascript"></script>
            <script language=javascript src="/Public/plugin/layer/layer.js"></script>
            <link href="/Public/admin/css/app.css" type="text/css" rel="stylesheet" />
            <script language=javascript src="/Public/admin/js/app.js"></script>
            <SCRIPT language=javascript src="/Public/plugin/laydate/laydate.js" charset="utf-8"></SCRIPT>
        </head>
    <body class="bgimg">
        <div id="login">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="box">
                            <div class="logo">
                                <img src="/Public/index/common/logo.png"/>
                            </div>
                                <form class="layui-form login-form form-ajax form-horizontal" action="<?php echo U('Index/login');?>" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" id="username"
                                    placeholder="管理账号" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password"
                                    placeholder="登录密码" required>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">
                                        立即登录
                                    </button>
                                </div>
                                <div class="woody-prompt">
                                    <span class="prompt-error">
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>