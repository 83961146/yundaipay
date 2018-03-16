<?php
// +----------------------------------------------------------------------
// | easy pay [ pay to easy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 All rights reserved.
// +----------------------------------------------------------------------
// | Author: fengxing <QQ:51125330>
// +----------------------------------------------------------------------
namespace Common\Logic;
class ParamLogic extends BaseLogic {
    protected $moduleName='参数';

    /**
     * 列表
     */
    public function index($request){
        $pezhi=SM('Peizhi');
        $edit = $pezhi->findData(
            '*',
            'id=1'
           );

        $edit=stringChange('formatMoneyByArray',$edit,array('klinitmoney','minpay'));

        $params = array(
            'edit'=>$edit,
            'pageName' => $this->moduleName.'管理'
        );
        return [1, $params];
    }
    /**
     * 保存
     */
    public function save($request){
        $data=array();
        $data['sitename'] = $request['sitename'];
        $data['closeweb'] = $request['closeweb'];
        $data['ifregcheck'] = $request['ifregcheck'];
        $data['ifagent'] = $request['ifagent'];
        $data['ifcheckka'] = $request['ifcheckka'];
        $data['bzjuserid'] = $request['bzjuserid'];
        $data['ifkl'] = $request['ifkl'];
        $data['klvalue'] = $request['klvalue'];
        $data['klzijian'] = $request['klzijian'];
        $data['klinitmoney'] = $request['klinitmoney'];
        $data['minpay'] = $request['minpay'];
        $data['xieyi'] = $request['xieyi'];
        $data['notice'] = $request['notice'];
        $data['phone'] = $request['phone'];
        $data['qq'] = $request['qq'];

        if(empty($data['sitename'])){
            return [0,'请填写网站名称'];
        }
        if(!empty($data['bzjuserid'])){
            $buffer=SM('User')->findData('username','userid="'.$data['bzjuserid'].'"');
            if(!$buffer) return [0,'保证金收款用户id不存在。请更换。'];
        }

        $pezhi=SM('Peizhi');

        if($pezhi->updateData(
                $data,
                'id=1')===false){
                return [0,'修改失败'];
            }else{
                //写入日志
                $this->adminLog($this->moduleName,'修改配置参数数据');
                return [1,'修改成功！', __URL__];
            }
    }


    /**
     * 获取配置信息
     */
    public function getPZ(){
        return SM('Peizhi')->findData('*','id=1');
    }
}