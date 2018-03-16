<?php
// +----------------------------------------------------------------------
// | easy pay [ pay to easy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 All rights reserved.
// +----------------------------------------------------------------------
// | Author: fengxing <QQ:51125330>
// +----------------------------------------------------------------------
/**
 * 用户模型
 * @author fengxing
 */
namespace Common\Model;
class UserModel extends BaseModel {

    /**
     * 生成安全码
     * @param int $length 安全码长度
     * @return String
     * @author fengxing
     */
    public function saveCode($length=15){
        return stringChange('saveCode',$length);
    }
}