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
<body>
    <div style="position:fixed;left:40%;z-index:999">
        <div class="woody-prompt">
            <div class="prompt-error alert alert-danger">
            </div>
        </div>
    </div>
    <div id="top-nav" class="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-15">
                    <ul>
                        <li class="current">
                            <a href="<?php echo U('Main/index');?>">
                                <?php echo ($config["sitename"]); ?>
                                &nbsp;
                                <span class="label label-primary">
                                    管理面板
                                </span>
                            </a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-6 clearfix">
                    <ul>
                        <li class="current"><a href="<?php echo U('Main/index');?>">管理首页</a></li>
                        <li><a href="<?php echo U('Param/index');?>">系统设置</a></li>
                        <li><a href="<?php echo U('User/index');?>">用户列表</a></li>
                        <li><a href="<?php echo U('Dingdan/index');?>">订单列表</a></li>
                        <li><a href="<?php echo U('Api/index');?>">接口管理</a></li>
                        <li><a href="<?php echo U('Kou/index');?>">扣量设置</a></li>
                        <li><a href="<?php echo U('Pay/yzf');?>">支付账单</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-3  clearfix">
                    <ul>
                        <li>
                            <a href="/" target="_blank">
                                <span class="glyphicon glyphicon-home">
                                </span>
                                &nbsp;返回网站
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                               role="button" aria-haspopup="true" aria-expanded="false">
                                账号
                                <?php echo ($admin['adminname']); ?>&nbsp;
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo U('Index/loginOut');?>">
                                <span class="glyphicon glyphicon-off">
                                </span>
                                &nbsp;登出
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#dropdownMenu').click(function () {
            if ($('.left-nav').is(':visible')) {
                $('.left-nav').addClass('hidden-sm hidden-xs').hide();
            } else {
                $('.left-nav').removeClass('hidden-sm hidden-xs').show();
            }
        });
    </script>
<div id="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
    <div class="left-nav">
        <dl>
            <dt>
                <span class="glyphicon glyphicon-asterisk">
                </span>
                &nbsp;管理菜单
            </dt>
            <dd><a href="<?php echo U('Main/index');?>">网站概览</a></dd>
            <dd><a href="<?php echo U('Admin/pass');?>">修改密码</a></dd>
        </dl>
        <dl>
            <dt>
                <span class="glyphicon glyphicon-cog">
                </span>
                &nbsp;系统配置
            </dt>
            <dd><a href="<?php echo U('Param/index');?>">参数配置</a></dd>
            <dd><a href="<?php echo U('Admin/index');?>">管理员管理</a></dd>
            <dd><a href="<?php echo U('Log/index');?>">系统日志</a></dd>
        </dl>
        <dl>
            <dt>
                <span class="glyphicon glyphicon-tint">
                </span>
                &nbsp;接口管理
            </dt>
            <dd><a href="<?php echo U('Api/index');?>">接口类型</a></dd>
            <dd><a href="<?php echo U('Api/user');?>">接口账户</a></dd>
        </dl>
        <dl>
            <dt>
                <span class="glyphicon glyphicon-adjust">
                </span>
                &nbsp;代理设置
            </dt>
            <dd><a href="<?php echo U('Agent/add');?>">添加代理等级</a></dd>
            <dd><a href="<?php echo U('Agent/index');?>">代理等级管理</a></dd>
        </dl>
        <dl>
            <dt>
                <span class="glyphicon glyphicon-th-list">
                </span>
                &nbsp;订单管理
            </dt>
            <dd><a href="<?php echo U('Dingdan/index');?>">成功订单列表</a></dd>
            <dd><a href="<?php echo U('Dingdan/kou');?>">扣量订单列表</a></dd>
            <dd><a href="<?php echo U('Dingdan/wei');?>">未支付订单列表</a></dd>
        </dl>
        <dl>
            <dt>
                <span class="glyphicon glyphicon-road">
                </span>
                &nbsp;财务管理
            </dt>
            <dd><a href="<?php echo U('Pay/index');?>">未支付账单</a></dd>
            <dd><a href="<?php echo U('Pay/yzf');?>">已支付账单</a></dd>
            <dd><a href="<?php echo U('Agent/fandian');?>">代理账单</a></dd>
        </dl>
        <dl>
            <dt>
                <span class="glyphicon glyphicon-user">
                </span>
                &nbsp;用户管理
            </dt>
            <dd><a href="<?php echo U('User/index');?>">用户列表</a></dd>
            <dd><a href="<?php echo U('Kou/index');?>">扣量列表</a></dd>
            <dd><a href="<?php echo U('Ka/index');?>">银行卡管理</a></dd>
        </dl>
    </div>
</div>
            <div class="col-md-10">
                <div class="right-content">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo ($pageName); ?>
                        </div>
                        <div class="panel-body">
                            <form class="layui-form form-container form-ajax form-horizontal" action="<?php echo U('User/save');?>" method="post">
                                <?php if($edit["userid"] != null): ?><div class="form-group">
                                    <label class="col-md-2 control-label">
                                        用户id：
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" disabled='' name="userid" value="<?php echo ($edit["userid"]); ?>" required lay-verify="required" placeholder="请输入用户id" />
                                    </div>
                                </div><?php endif; ?>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        用户账户：
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" <?php if($act == 'edit'): ?>disabled=''<?php endif; ?> name="username" value="<?php echo ($edit["username"]); ?>" required lay-verify="required" placeholder="请输入用户账户" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        密码：
                                    </label>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control" name="password" value="" />
                                        <?php if($edit["userid"] != null): ?>* 不修改请留空<?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        重复密码：
                                    </label>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control" name="password2" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        提现密码：
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="txpassword" value="" />
                                        <?php if($edit["userid"] != null): ?>* 不修改请留空<?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        qq：
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="qq" value="<?php echo ($edit["qq"]); ?>" placeholder="请输入qq" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        手机号：
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="phone" value="<?php echo ($edit["phone"]); ?>" placeholder="请输入手机号" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        邮箱：
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="email" value="<?php echo ($edit["email"]); ?>" placeholder="请输入邮箱" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        状态：
                                    </label>
                                    <div class="col-md-4">
                                        <select name="status" class="form-control flselect">
                                            <option value="0" <?php if($edit["status"] == '0'): ?>selected="selected"<?php endif; ?>>正常</option>
                                            <option value="1" <?php if($edit["status"] == '1'): ?>selected="selected"<?php endif; ?>>锁定</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        是否代理：
                                    </label>
                                    <div class="col-md-4">
                                        <select name="ifagent" class="form-control flselect">
                                            <option value="0" <?php if($edit["ifagent"] == '0'): ?>selected="selected"<?php endif; ?>>不是</option>
                                            <option value="1" <?php if($edit["ifagent"] == '1'): ?>selected="selected"<?php endif; ?>>是</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        代理id：
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="agent" value="<?php echo ($edit["agent"]); ?>" placeholder="请输入代理id" />
                                        * 可留空，如填写请填写用户id 例如20181000
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-4">
                                        <input type="hidden" class="form-control" name="act" value="<?php echo ($act); ?>"/>
                                        <input type="hidden" class="form-control" name="id" value="<?php echo ($edit["id"]); ?>"/>
                                        <button type="submit" class="btn btn-success ">
                                            &nbsp;
                                            <span class="glyphicon glyphicon-save">
                                            </span>
                                            &nbsp;提交&nbsp;
                                        </button>
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
    <div id="footer">
        &copy;&nbsp;2017&nbsp;
        <?php echo ($config["sitename"]); ?>&nbsp;Powered by 风行
    </div>
</body>
</html>