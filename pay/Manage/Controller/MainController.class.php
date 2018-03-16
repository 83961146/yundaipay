<?php
// +----------------------------------------------------------------------
// | easy pay [ pay to easy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 All rights reserved.
// +----------------------------------------------------------------------
// | Author: fengxing <QQ:51125330>
// +----------------------------------------------------------------------
namespace Manage\Controller;
class MainController extends BaseController {
    public function index(){
        $list=array(
            'phpversion'=>phpversion(),
            'php_uname'=>php_uname(),
            'php_sapi_name'=>php_sapi_name(),
            'DEFAULT_INCLUDE_PATH'=>DEFAULT_INCLUDE_PATH,
            'zend_version'=>zend_version(),
            'webserver'=>$_SERVER ['SERVER_SOFTWARE'],
            'upload'=>get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件",
            'mysql_get_server_info'=>mysql_get_server_info(),
            'ip'=>  get_client_ip(0,true),
        );
        $this->assign('list',$list);
        $this->assign('pageName','后台主页');
        $this->display();
    }
}