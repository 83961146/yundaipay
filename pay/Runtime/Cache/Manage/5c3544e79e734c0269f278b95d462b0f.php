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
                        <form class="layui-form form-container form-ajax form-horizontal" action="<?php echo U('Api/saveuser');?>" method="post">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        名称：
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control"  name="pzname" value="<?php echo ($edit["pzname"]); ?>" required lay-verify="required" placeholder="请输入名称" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        类型：
                                    </label>
                                    <div class="col-md-4">
                                        <select name="style" class="form-control style">
                                            <option value="wechat" <?php if($edit["style"] == 'wechat'): ?>selected="selected"<?php endif; ?>>微信</option>
                                            <option value="alipay" <?php if($edit["style"] == 'alipay'): ?>selected="selected"<?php endif; ?>>支付宝</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">
                                        回调地址：
                                    </label>
                                    <div class="col-md-4 huidiao">
                                    </div>
                                </div>
                                <div class="form-group wechat">
                                    <label class="col-md-2 control-label">
                                        APPID：
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control"  name="wechat_appid" value="<?php echo ($edit["wechat_appid"]); ?>" placeholder="请输入APPID" />
                                    </div>
                                </div>
                                <div class="form-group wechat">
                                    <label class="col-md-2 control-label">
                                        商户id：
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control"  name="wechat_mchid" value="<?php echo ($edit["wechat_mchid"]); ?>" placeholder="请输入商户ID" />
                                    </div>
                                </div>
                                <div class="form-group wechat">
                                    <label class="col-md-2 control-label">
                                        api秘钥：
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control"  name="wechat_key" value="<?php echo ($edit["wechat_key"]); ?>" placeholder="请输入api秘钥" />
                                    </div>
                                </div>
                                <div class="form-group wechat">
                                    <label class="col-md-2 control-label">
                                        APPSECRET：
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control"  name="wechat_appsecret" value="<?php echo ($edit["wechat_appsecret"]); ?>" placeholder="请输入APPSECRET" />
                                    </div>
                                </div>
                                <div class="form-group alipay">
                                    <label class="col-md-2 control-label">
                                        APPID：
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control"  name="alipay_appid" value="<?php echo ($edit["alipay_appid"]); ?>" placeholder="请输入APPID" />
                                    </div>
                                </div>
                                <div class="form-group alipay">
                                    <label class="col-md-2 control-label">
                                        签名方式：
                                    </label>
                                    <div class="col-md-4">
                                        <select name="alipay_sign" class="form-control flselect">
                                            <option value="RSA2" <?php if($edit["alipay_sign"] == 'RSA2'): ?>selected="selected"<?php endif; ?>>RSA2</option>
                                            <option value="RSA" <?php if($edit["alipay_sign"] == 'RSA'): ?>selected="selected"<?php endif; ?>>RSA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group alipay">
                                    <label class="col-md-2 control-label">
                                        私钥：
                                    </label>
                                    <div class="col-md-4">
                                        <textarea cols="50" rows="5" class="form-control" name="alipay_private"><?php echo ($edit["alipay_private"]); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group alipay">
                                    <label class="col-md-2 control-label">
                                        公钥：
                                    </label>
                                    <div class="col-md-4">
                                        <textarea cols="50" rows="5" class="form-control" name="alipay_public"><?php echo ($edit["alipay_public"]); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>选项</th>
                                            <th>接口名称</th>
                                            <th>费率(例如10%，这里输入10)</th>
                                            <th>开关</th>
                                        </tr>
                                        <?php if($list): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$n): $mod = ($i % 2 );++$i;?><tr>
                                            <td><input name="jkid[]" type="checkbox" <?php if($n["pzid"] != null): ?>checked="checked"<?php endif; ?> value="<?php echo ($n["jkid"]); ?>"/></td>
                                            <td><?php echo ($n["jkname"]); ?></td>
                                            <td><input name="fl_<?php echo ($n["jkid"]); ?>" class="form-control" type="text"  value="<?php echo ($n["fl"]); ?>"/></td>
                                            <td><select name="ifopen_<?php echo ($n["jkid"]); ?>" class="form-control">
                                                    <option value="0" <?php if($n["ifopen"] == '0'): ?>selected="selected"<?php endif; ?>>关闭</option>
                                                    <option value="1" <?php if($n["ifopen"] == '1'): ?>selected="selected"<?php endif; ?>>开启</option>
                                                </select></td>
                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="10" align="center">暂无数据 <a href="<?php echo U('Api/add');?>">添加</a></td>
                                        </tr><?php endif; ?>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-4">
                                        <input type="hidden" class="form-control" name="act" value="<?php echo ($act); ?>"/>
                                        <input type="hidden" class="form-control" name="pzid" value="<?php echo ($edit["pzid"]); ?>"/>
                                        <button type="submit" class="btn btn-success ">
                                            &nbsp;
                                            <span class="glyphicon glyphicon-save">
                                            </span>
                                            &nbsp;提交&nbsp;
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
<script>
    $(document).ready(function () {
        $('.style').on('change', function () {
            var t = $(this).find('option:selected').val();
            var tname = $(this).find('option:selected').html();
            if (t == 'alipay') {
                $('.alipay').css({'display': 'block'});
                $('.wechat').css({'display': 'none'});
            } else if (t == 'wechat') {
                $('.wechat').css({'display': 'block'});
                $('.alipay').css({'display': 'none'});
            }
            
            $('.huidiao').html('<p>'+tname+'异步 http://<?php echo ($_SERVER['HTTP_HOST']); ?>/Pay/notify/'+t+'</p>'+
                    '<p>'+tname+'同步 http://<?php echo ($_SERVER['HTTP_HOST']); ?>/Pay/backurl/'+t+'</p>');
        });
        $('.style').change();
    });
</script>
    <div id="footer">
        &copy;&nbsp;2017&nbsp;
        <?php echo ($config["sitename"]); ?>&nbsp;Powered by 风行
    </div>
</body>
</html>