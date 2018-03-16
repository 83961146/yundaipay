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
                            参数配置
                        </div>
                            <form class="lrcontent layui-form form-container form-ajax form-horizontal" action="<?php echo U('Param/save');?>" method="post" target="msgubotj">
                                
                        <div class="panel-body">
                        <div class="panel-heading">
                            网站相关
                        </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        网站名称：
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="sitename" value="<?php echo ($edit['sitename']); ?>" required lay-verify="required" placeholder="请输入网站名称" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        网站开关：
                                    </label>
                                    <div class="col-md-10">
                                        <select name="closeweb" class="form-control">
                                            <option value="1" <?php if($edit['closeweb'] == '1'): ?>selected="selected"<?php endif; ?>>关闭</option>
                                            <option value="0" <?php if($edit['closeweb'] == '0'): ?>selected="selected"<?php endif; ?>>开启</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        代理开关：
                                    </label>
                                    <div class="col-md-10">
                                        <select name="ifagent" class="form-control">
                                            <option value="1" <?php if($edit['ifagent'] == '1'): ?>selected="selected"<?php endif; ?>>关闭</option>
                                            <option value="0" <?php if($edit['ifagent'] == '0'): ?>selected="selected"<?php endif; ?>>开启</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        注册商户审核：
                                    </label>
                                    <div class="col-md-10">
                                        <select name="ifregcheck" class="form-control">
                                            <option value="1" <?php if($edit['ifregcheck'] == '1'): ?>selected="selected"<?php endif; ?>>审核</option>
                                            <option value="0" <?php if($edit['ifregcheck'] == '0'): ?>selected="selected"<?php endif; ?>>不审核</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        提现账户审核：
                                    </label>
                                    <div class="col-md-10">
                                        <select name="ifcheckka" class="form-control">
                                            <option value="1" <?php if($edit['ifcheckka'] == '1'): ?>selected="selected"<?php endif; ?>>审核</option>
                                            <option value="0" <?php if($edit['ifcheckka'] == '0'): ?>selected="selected"<?php endif; ?>>不审核</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        最小支付金额：
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="minpay" value="<?php echo ($edit['minpay']); ?>" required lay-verify="required" placeholder="请输入最小支付金额" />
                                        例如满100元提现，则输入100
                                    </div>
                                </div>
                        <div class="panel-heading">
                            api相关
                        </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        收款(体验)用户id：
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="bzjuserid" value="<?php echo ($edit['bzjuserid']); ?>" required lay-verify="required" placeholder="请输入收取保证金用户id" />
                                        *为保证金收款的用户id 例如2017256 不填写请留空或0
                                    </div>
                                </div>
                        <div class="panel-heading">
                            扣量相关
                        </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        扣量开关：
                                    </label>
                                    <div class="col-md-10">
                                        <select name="ifkl" class="form-control">
                                            <option value="1" <?php if($edit['ifkl'] == '1'): ?>selected="selected"<?php endif; ?>>扣量</option>
                                            <option value="0" <?php if($edit['ifkl'] == '0'): ?>selected="selected"<?php endif; ?>>不扣量</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        扣量初始值：
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="klvalue" value="<?php echo ($edit['klvalue']); ?>" required lay-verify="required" placeholder="请输入扣量初始值" />
                                        例如满十笔支付扣一笔这里输入10，满5笔扣一笔这里输入5
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        扣量基数：
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="klzijian" value="<?php echo ($edit['klzijian']); ?>" required lay-verify="required" placeholder="请输入扣量基数" />
                                        例如第一次扣量发生在第100笔交易，这里填100
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        起扣金额：
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="klinitmoney" value="<?php echo ($edit['klinitmoney']); ?>" required lay-verify="required" placeholder="请输入起扣金额" />
                                        例如低于十元不扣量，则输入10
                                    </div>
                                </div>
                        <div class="panel-heading">
                            其他
                        </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        客服电话：
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="phone" value="<?php echo ($edit['phone']); ?>" required lay-verify="required" placeholder="请输入客服电话" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        客服qq：
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="qq" value="<?php echo ($edit['qq']); ?>" required lay-verify="required" placeholder="请输入客服qq" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        公告：
                                    </label>
                                    <div class="col-md-10">
                                        <textarea name="notice" class="form-control" rows="10" cols="80"><?php echo ($edit['notice']); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        注册协议：
                                    </label>
                                    <div class="col-md-10">
                                        <textarea name="xieyi" class="form-control" rows="10" cols="80"><?php echo ($edit['xieyi']); ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-4">
                                        <button type="submit" class="btn btn-success">
                                            &nbsp;
                                            <span class="glyphicon glyphicon-save">
                                            </span>
                                            &nbsp;保存设置&nbsp;
                                        </button>
                                    </div>
                                </div>
                        </div>
                            </form>
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