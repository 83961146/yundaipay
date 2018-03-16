<?php
// +----------------------------------------------------------------------
// | easy pay [ pay to easy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 All rights reserved.
// +----------------------------------------------------------------------
// | Author: fengxing <QQ:51125330>
// +----------------------------------------------------------------------
namespace Manage\Controller;
class DingdanController extends BaseController {

    public function kou(){
        $buffer = SL(CONTROLLER_NAME.'/kou', $_REQUEST);
        $this->reback($buffer,1);
    }
    public function wei(){
        $buffer = SL(CONTROLLER_NAME.'/wei', $_REQUEST);
        $this->reback($buffer,1);
    }
}
