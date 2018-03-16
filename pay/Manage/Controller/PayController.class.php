<?php
// +----------------------------------------------------------------------
// | easy pay [ pay to easy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 All rights reserved.
// +----------------------------------------------------------------------
// | Author: fengxing <QQ:51125330>
// +----------------------------------------------------------------------
namespace Manage\Controller;
class PayController extends BaseController {
    public function yzf(){
        $buffer = SL(CONTROLLER_NAME.'/yzf', $_REQUEST);
        $this->reback($buffer,1);
    }
}