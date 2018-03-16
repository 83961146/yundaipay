<?php
// +----------------------------------------------------------------------
// | easy pay [ pay to easy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 All rights reserved.
// +----------------------------------------------------------------------
// | Author: fengxing <QQ:51125330>
// +----------------------------------------------------------------------
namespace Index\Controller;
class IndexController extends BaseController {
    public function index(){
        echo "999";
        exit();
        $this->display();
    }
    public function reg(){
        $buffer = SL('User/reg', $_REQUEST);
        $this->reback($buffer,!IS_AJAX);
    }
    public function login(){
        $buffer = SL('User/login', $_REQUEST);
        $this->reback($buffer,!IS_AJAX);
    }
    //获取协议
    public function getxy(){
        global $publicData;
        $xieyi=$publicData['peizhi']['xieyi'];
        $xieyi=str_replace("\r\n","<br/>",$xieyi);
        $buffer = [1,$xieyi];
        $this->reback($buffer);
    }
}