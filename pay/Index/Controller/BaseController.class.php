<?php
// +----------------------------------------------------------------------
// | easy pay [ pay to easy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 All rights reserved.
// +----------------------------------------------------------------------
// | Author: fengxing <QQ:51125330>
// +----------------------------------------------------------------------
namespace Index\Controller;
use Common\Controller\DefaultController;
class BaseController extends DefaultController {

    public function __construct(){
        parent::__construct();
        $this->initial();
    }

    private function initial(){
        global $publicData;
        if(empty($publicData['peizhi'])){
            $peizhi=SL('Param')->getPZ();
            $publicData['peizhi']=$peizhi;
        }else{
            $peizhi=$publicData['peizhi'];
        }

        if($peizhi['closeweb']==1){
            exit('网站关闭。');
        }
        //检测用户登录
        if(CONTROLLER_NAME=='Home'){
            $checklogin=SL('User')->checklogin();
            $nowAction = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
            if($checklogin[0]==0){
                if(IS_AJAX){
                    $this->reback([0,'请登录。',U('/')]);
                }else{
                    header('Location:'.U('/'));
                }
                exit();
            }
            if(empty($publicData['user'])){
                $publicData['user']=$checklogin[1];
            }
        }


        $this->assign('config',$peizhi);
        $this->assign('sitename',$peizhi['sitename']);
        $this->assign('user',$checklogin[1]);
    }
}