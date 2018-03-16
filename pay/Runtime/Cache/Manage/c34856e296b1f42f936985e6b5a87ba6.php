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
                <div class="right-content">    <h3>
                        <span class="current">
                            <?php echo ($pageName); ?>
                    </h3>
                    <br>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="layui-form layui-form-pane form-inline" action="" method="get">
                                <div class="form-group">
                                    <input class="form-control" name="userid" placeholder="用户ID" value="<?php echo ($_REQUEST['userid']); ?>" size="12" type="text">
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-search">
                                    </span>
                                    &nbsp;立即查询
                                </button>
                            </form>
                        </div>
                    </div>

                    <form action="" method="post"  class="ajax-form">
                        <div class="set set0 table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td colspan="10">
                                            <button class="btn btn-danger anniu delbtn" type="button" data-url="<?php echo U('Kou/delete');?>">删除</button>
                                            <button class="btn btn-success anniu addbtn" type="button" data-url="<?php echo U('Kou/add');?>">添加</button>
                                            <button class="btn btn-primary anniu flushbtn" type="button" data-url="#">刷新</button>
                                        </td>
                                    </tr>
                                    <tr class="info">
                                        <th style="width: 15px;"><input type="checkbox" name="mmAll" class="selectAllCheckbox"/></th>
                                        <th align="center" >用户ID</th>
                                        <th align="center">初始值</th>
                                        <th align="center">自减值</th>
                                        <th align="center">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($list): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$n): $mod = ($i % 2 );++$i;?><tr id="tr<?php echo ($n["zjid"]); ?>" >
                                        <td align="center"><input type="checkbox" class="thisid checkbox" title="<?php echo ($n["zjid"]); ?>" name="thisid[]" value="<?php echo ($n["zjid"]); ?>"/></td>
                                        <td align="center"><a href="<?php echo U('Kou/edit',array('id'=>$n['zjid'],'p'=>$_GET['p']));?>"><?php echo ($n["userid"]); ?></a></td>
                                        <td align="center"><?php echo ($n["initval"]); ?></td>
                                        <td align="center"><?php echo ($n["zijian"]); ?></td>
                                        <td align="center">
                                            <a href="<?php echo U('Kou/edit',array('id'=>$n['zjid'],'p'=>$_GET['p']));?>" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                                            <a href="javascript:;" data-id="<?php echo ($n["zjid"]); ?>" data-url="<?php echo U('Kou/delete',array('id'=>$n['zjid'],'p'=>$_GET['p']));?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete">删除</a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="15" align="center">暂无数据</td>
                                    </tr><?php endif; ?>
                                </tbody>
                            </table>
                            <div id="wypage"><?php echo ($page); ?></div>
                        </div>
                    </form>
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