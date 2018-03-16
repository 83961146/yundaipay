<?php
// +----------------------------------------------------------------------
// | easy pay [ pay to easy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 All rights reserved.
// +----------------------------------------------------------------------
// | Author: fengxing <QQ:51125330>
// +----------------------------------------------------------------------
namespace Common\Logic;
class ApiLogic extends BaseLogic {
    protected $moduleName='接口';

    /**
     * 列表
     */
    public function index($request){
        $map=array();
        $data=' 1=1 ';

        $jiekou=SM('Jiekou');

        $list = $jiekou->selectData(
            '*',
            $data,
            'jkid ASC'
           );
        $params = array(
            'list'=>$list,
            'pageName' => $this->moduleName.'类型管理'
        );
        return [1, $params];
    }
    /**
     * 添加
     */
    public function add($request){
        $params = array(
            'act'=>'add',
            'pageName' => '添加'.$this->moduleName.'类型'
        );
        return [1, $params];
    }
    /**
     * 修改
     */
    public function edit($request){
        if(!$request['id']){
            return [0, '参数错误！'];
        }
        $Jiekou = SM('Jiekou');
        $row = $Jiekou->findData('*', 'jkid=' . $request['id']);
        $params = array(
            'edit' => $row,
            'act'=>'edit',
            'pageName' => '修改'.$this->moduleName.'类型'
        );
        return [1, $params,'Api/add'];
    }

    /**
     * 保存
     */
    public function save($request){
        $jiekouID = $request['jkid']; //获取数据标识
        $act = $request['act']; //获取模板标识
        //判断数据标识
        if (empty ($jiekouID) && $act == 'edit') {
            return [0,'数据标识不能为空！'];
        }
        if (empty ($act)) {
            return [0,'模板标识不能为空！'];
        }
        $jiekou = SM('Jiekou');
        $data = array();
        $data['jkname'] = $request['jkname'];
        $data['jkstyle'] = $request['jkstyle'];

        if ($act == 'add') {

            //检查名称重复
            $buffer = $jiekou->selectData(
                'jkid',
                'jkname="'.$data['jkname'].'"');
            if($buffer){
                return [0,'名称重复请更换'];
            }
            if($jiekou->insertData($data)===false){
                return [0,'添加失败'];
            }else{
                //写入日志
                $this->adminLog($this->moduleName,'添加接口类型【'.$data['jkname'].'】');
                return [1,'添加成功！',__URL__];
            }
        } elseif ($act == 'edit') {
            $data['jkid'] = $jiekouID;
            $buffer = $jiekou->selectData(
                'jkid,jkname',
                'jkid="'.$data['jkid'].'"');
            if(!$buffer){
                return [0,'接口类型不存在'];
            }
            $buffer = $jiekou->selectData(
                'jkid,jkname',
                'jkname="'.$data['jkname'].'" && jkid!="'.$data['jkid'].'"');
            if($buffer){
                return [0,'接口名称重复'];
            }
            if($jiekou->updateData(
                $data,
                'jkid='.$data['jkid'])===false){
                return [0,'修改失败'];
            }else{
                //写入日志
                $this->adminLog($this->moduleName,'修改接口类型jkid为【'.$jiekouID.'】的数据');
                return [1,'修改成功！', __URL__];
            }
        }
    }

    /**
     * 删除
     */
    public function delete($request){
        $jiekouID = $request['id']; //获取数据标识
        $idArray=explode(',',$jiekouID);
        if (!$jiekouID) {
            return [0,'数据标识不能为空',__URL__];
        }
        if (SM('Jiekou')->deleteData(
                'jkid in ('.implode(',',$idArray).')') === false) {
            return [0,'删除失败'];
        } else {
            //写入日志
            $this->adminLog($this->moduleName,'删除接口类型jkID为【'.implode(',',$idArray).'】的数据');
            return [1,'删除成功',__URL__];
        }
    }
    /**
     * 接口账户列表
     */
    public function user($request){
        global $publicData;
        $map=array();
        $data=' 1=1 ';

        $jiekou=SM('Jiekou');
        $list = $jiekou->selectData(
            '*',
            $data,
            'jkid ASC'
           );
        $jiekouArr=array();
        foreach($list as $iList){
            $jiekouArr[$iList['jkid']]=$iList;
        }

        $jiekouzj=SM('Jiekouzj');
        $list = $jiekouzj->selectData(
            '*',
            $data,
            'zjid ASC'
           );
        $jiekouzjArr=array();
        foreach($list as $iList){
            $iList['jkname']=$jiekouArr[$iList['jkid']]['jkname'];
            $iList['jkstyle']=$jiekouArr[$iList['jkid']]['jkstyle'];
            $iList=stringChange('formatMoneyByArray',$iList,array('fl'));
            $iList['ifopen']=$iList['ifopen']==0?'关闭':'<font color="red">开启</font>';
            $iList['ifchoose']=$iList['ifchoose']==0?'<a href="javascript:;" class="ifchoose" tid="'.$iList['zjid'].'">未应用</a>':'<font color="red">应用</font>';

            $jiekouzjArr[$iList['pzid']][]=$iList;
        }

        $jiekoupeizhi=SM('Jiekoupeizhi');
        $list = $jiekoupeizhi->selectData(
            '*',
            $data,
            'pzid ASC'
           );
        foreach($list as $i=>$iList){
            $list[$i]['params']=(($iList['params']));
            $list[$i]['sub']=$jiekouzjArr[$iList['pzid']];
        }

        $params = array(
            'list'=>$list,
            'pageName' => $this->moduleName.'账户管理'
        );
        return [1, $params];
    }
    /**
     * 添加
     */
    public function adduser($request){
        $jiekou=SM('Jiekou');
        $list = $jiekou->selectData(
            '*',
            $data,
            'jkid ASC'
           );

        $params = array(
            'act'=>'add',
            'list'=>$list,
            'pageName' => '添加'.$this->moduleName.'账户'
        );
        return [1, $params];
    }
    /**
     * 修改
     */
    public function edituser($request){
        if(!$request['id']){
            return [0, '参数错误！'];
        }

        $jiekouzj=SM('Jiekouzj');
        $list = $jiekouzj->selectData(
            '*',
            'pzid='.$request['id'],
            'zjid ASC'
           );
        $jiekouzjArr=array();
        foreach($list as $iList){
            $jiekouzjArr[$iList['jkid']]=$iList;
        }

        $jiekou=SM('Jiekou');
        $list = $jiekou->selectData(
            '*',
            '1=1',
            'jkid ASC'
           );
        $jiekouArr=array();
        foreach($list as $i=>$iList){
            $list[$i]['pzid']=$jiekouzjArr[$iList['jkid']]['pzid'];
            $list[$i]['fl']=$jiekouzjArr[$iList['jkid']]['fl'];
            $list[$i]['ifopen']=$jiekouzjArr[$iList['jkid']]['ifopen'];
            $list[$i]=stringChange('formatMoneyByArray',$list[$i],array('fl'));
        }

        $jiekoupeizhi = SM('Jiekoupeizhi');
        $row = $jiekoupeizhi->findData('*', 'pzid=' . $request['id']);
        $row=array_merge($row,  unserialize($row['params']));

        $params = array(
            'edit' => $row,
            'list' => $list,
            'act'=>'edit',
            'pageName' => '修改'.$this->moduleName.'账户'
        );
        return [1, $params,'Api/adduser'];
    }

    /**
     * 保存
     */
    public function saveuser($request){
        $pzID = $request['pzid']; //获取数据标识
        $act = $request['act']; //获取模板标识
        //判断数据标识
        if (empty ($pzID) && $act == 'edit') {
            return [0,'数据标识不能为空！'];
        }
        if (empty ($act)) {
            return [0,'模板标识不能为空！'];
        }
        $jiekoupeizhi = SM('Jiekoupeizhi');
        $data = array();
        $data['pzname'] = $request['pzname'];
        $data['style'] = $request['style'];

        $tmparr=array();
        switch($data['style']){
            case 'wechat':
                $tmparr['wechat_appid']=$request['wechat_appid'];
                $tmparr['wechat_mchid']=$request['wechat_mchid'];
                $tmparr['wechat_key']=$request['wechat_key'];
                $tmparr['wechat_appsecret']=$request['wechat_appsecret'];
            break;
            case 'alipay':
                $tmparr['alipay_appid']=$request['alipay_appid'];
                $tmparr['alipay_sign']=$request['alipay_sign'];
                $tmparr['alipay_private']=$request['alipay_private'];
                $tmparr['alipay_public']=$request['alipay_public'];
            break;
        }
        $data['params'] =serialize($tmparr);

        $jkid=$request['jkid'];
        $zjbuffer=array();
        foreach($jkid as $iJkid){
            $zjbuffer[]=array(
                'jkid'=>$iJkid,
                'fl'=>$request['fl_'.$iJkid],
                'ifopen'=>$request['ifopen_'.$iJkid]
            );
        }

        if ($act == 'add') {
            //检查名称重复
            $buffer = $jiekoupeizhi->selectData(
                'pzid',
                'pzname="'.$data['pzname'].'"');
            if($buffer){
                return [0,'名称重复请更换'];
            }
            if(($pzID=$jiekoupeizhi->insertData($data))===false){
                return [0,'添加失败'];
            }else{

                if($zjbuffer){
                    //写入配置中间
                    $addAllBuffer=array();
                    foreach($zjbuffer as $iZjbuffer){
                        $addAllBuffer[]=array(
                            'pzid'=>$pzID,
                            'jkid'=>$iZjbuffer['jkid'],
                            'fl'=>$iZjbuffer['fl'],
                            'ifopen'=>$iZjbuffer['ifopen']
                        );
                    }
                    SM('Jiekouzj')->addAllData($addAllBuffer);
                }

                $this->checkApiChoose(); //接口应用检测

                //写入日志
                $this->adminLog($this->moduleName,'添加接口账户【'.$data['pzname'].'】');
                return [1,'添加成功！',U('Api/user')];
            }
        } elseif ($act == 'edit') {
            $data['pzid'] = $pzID;
            $buffer = $jiekoupeizhi->selectData(
                'pzid,pzname',
                'pzid="'.$data['pzid'].'"');
            if(!$buffer){
                return [0,'接口类型不存在'];
            }
            $buffer = $jiekoupeizhi->selectData(
                'pzid,pzname',
                'pzname="'.$data['pzname'].'" && pzid!="'.$data['pzid'].'"');
            if($buffer){
                return [0,'接口名称重复'];
            }

            if($jiekoupeizhi->updateData(
                $data,
                'pzid='.$data['pzid'])===false){
                return [0,'修改失败'];
            }else{

                $jiekouzj=SM('Jiekouzj');
                $buffer = $jiekouzj->selectData('*','pzid='.$data['pzid']);
                //写入配置中间
                if($zjbuffer){
                    //写入配置中间
                    $addAllBuffer=array();
                    foreach($zjbuffer as $i=>$iZjbuffer){
                        if($buffer[$i]){
                            $jiekouzj->updateData(array(
                                'pzid'=>$pzID,
                                'jkid'=>$iZjbuffer['jkid'],
                                'fl'=>$iZjbuffer['fl'],
                                'ifopen'=>$iZjbuffer['ifopen']
                            ),'zjid='.$buffer[$i]['zjid']);
                        }else{
                            $addAllBuffer[]=array(
                                'pzid'=>$pzID,
                                'jkid'=>$iZjbuffer['jkid'],
                                'fl'=>$iZjbuffer['fl'],
                                'ifopen'=>$iZjbuffer['ifopen']
                            );
                        }
                    }
                    $i++;
                    if($buffer[$i]){
                        $zjidArr=array();
                        for(;$i<count($buffer);$i++){
                            $zjidArr[]=$buffer[$i]['zjid'];
                        }
                         $jiekouzj->deleteData('zjid in ('.implode(',',$zjidArr).')');
                    }else{
                        if($addAllBuffer) $jiekouzj->addAllData($addAllBuffer);
                    }
                }else{
                    $jiekouzj->deleteData('pzid='.$data['pzid']);
                }

                $this->checkApiChoose(); //接口应用检测

                //写入日志
                $this->adminLog($this->moduleName,'修改接口账户pzid为【'.$pzID.'】的数据');
                return [1,'修改成功！', U('Api/user')];
            }
        }
    }

    /**
     * 删除
     */
    public function deleteuser($request){
        $pzID = $request['id']; //获取数据标识
        $idArray=explode(',',$pzID);
        if (!$pzID) {
            return [0,'数据标识不能为空',U('Api/user')];
        }
        if (SM('Jiekoupeizhi')->deleteData(
                'pzid in ('.implode(',',$idArray).')') === false) {
            return [0,'删除失败'];
        } else {

            SM('Jiekouzj')->deleteData('pzid in ('.implode(',',$idArray).')');
            $this->checkApiChoose(); //接口应用检测
            //写入日志
            $this->adminLog($this->moduleName,'删除接口账户pzID为【'.implode(',',$idArray).'】的数据');
            return [1,'删除成功',U('Api/user')];
        }
    }
    /**
     * 切换账户接口开启状态
     */
    public function userchangeopen($request){
        $zjid=explode(',',$request['zjid']);
        $ifopen=$request['ifopen']; //需要切换成的状态
        $jiekouzj=SM('Jiekouzj');
        $zjBuffer=$jiekouzj->selectData('*','zjid in ('.implode(',',$zjid).')');
        if(!$zjBuffer){
            return [1,'切换成功'];
        }

        if($ifopen===''){
            $ifopen=$zjBuffer[0]['ifopen']==1?0:1;
            $idArray=array($zjBuffer[0]['zjid']);
        }else{
            $idArray=array();
            foreach($zjBuffer as $iZjBuffer){
                 if($iZjBuffer['ifopen']!=$ifopen){
                     $idArray[]=$iZjBuffer['zjid'];
                 }
            }
            if(empty($idArray)){
                return [1,'切换成功'];
            }
        }
        $statusname='开启';
        if(empty($ifopen)){
            $statusname='关闭';
            $ifopen=0;
        }

        //更新当前接口
        $result=$jiekouzj->updateData(array('ifopen'=>$ifopen,'ifchoose'=>0),'zjid in ('.implode(',',$idArray).')');
        if($result===false){
            return [0,'切换失败'];
        }else{
            $this->checkApiChoose(); //接口应用检测

            return [1,'切换成功'];
        }
    }
    /**
     * 切换账户接口应用
     */
    public function userchangechoose($request){
        $zjid=$request['zjid'];
        $jiekouzj=SM('Jiekouzj');
        $zjBuffer=$jiekouzj->findData('*','zjid='.$zjid);
        if(!$zjBuffer || $zjBuffer['ifchoode']==1){
            return [1,'切换成功'];
        }

        global $publicData;
        //更新所属接口类型状态为0
        $jiekouzj->updateData(array('ifchoose'=>0),'jkid='.$zjBuffer['jkid'].' and ifchoose=1');
        //更新当前接口为1
        $jiekouzj->updateData(array('ifchoose'=>1),'zjid='.$zjid);
        return [1,'切换成功'];
    }

    /**
     * 判断接口的应用状态
     */
    public function checkApiChoose(){
        global $publicData;

        //获取基础接口
        $jiekou=SM('Jiekou');
        $jiekouzj=SM('Jiekouzj');
        $jiekouBuffer = $jiekou->selectData('*','1=1');
        $jiekouBuffer=stringChange('arrayKey',$jiekouBuffer,'jkid');

        //更改已经关闭的数据的应用状态
        $jiekouzj->updateData(array('ifchoose'=>0),'ifopen=0');

        //去掉已经有应用的接口
        $jiekouzjBuffer=$jiekouzj->selectData('*','ifchoose=1 and ifopen=1');
        foreach($jiekouzjBuffer as $iBuffer){
            unset($jiekouBuffer[$iBuffer['jkid']]);
        }

        //对剩余接口进行轮训
        if($jiekouBuffer){
            foreach($jiekouBuffer as $i=>$iBuffer){
                $jiekouzjBuffer=$jiekouzj->findData('*','jkid='.$i.' and ifopen=1','zjid asc');
                if($jiekouzjBuffer){
                    $jiekouzj->updateData(array('ifchoose'=>1),'zjid='.$jiekouzjBuffer['zjid']);
                }
            }
        }
    }

   /**
     * 获取以jkid为键值的数组
     */
    public function getJkArrayKeyID(){
        $jiekou=SM('Jiekou');
        $jiekouBuffer = $jiekou->selectData(
            '*',
            '1=1',
            'jkid ASC'
           );
        return stringChange('arrayKey',$jiekouBuffer,'jkid');
    }
   /**
     * 获取以pzid为键值的数组
     */
    public function getPzArrayKeyID(){
        $jiekoupz=SM('Jiekoupeizhi');
        $jiekoupzBuffer = $jiekoupz->selectData(
            '*',
            '1=1',
            'pzid ASC'
           );
        return stringChange('arrayKey',$jiekoupzBuffer,'pzid');
    }
   /**
     * 根据zjid获取接口和配置数组
     */
    public function getJkByZj($zjid){
        //获取支付账号
        $jkzj = SM('Jiekouzj')->findData('*', 'zjid=' . $zjid);
        if(!$jkzj) return;

        $jkpz = SM('Jiekoupeizhi')->findData('*', 'pzid=' . $jkzj['pzid']);
        if(!$jkzj) return $jkzj;
        $jkzj['pzname']=$jkpz['pzname'];
        $jkzj['style']=$jkpz['style'];
        $jkzj['params']=$jkpz['params'];

        $jk = SM('Jiekou')->findData('*', 'jkid=' . $jkzj['jkid']);
        if(!$jkzj) return $jkzj;

        $jkzj['jkname']=$jk['jkname'];
        $jkzj['jkstyle']=$jk['jkstyle'];
        return $jkzj;
    }
    //获取可用接口
    public function getOpenApi(){
        //判断是否有可用的接口
            $jkBuffer=SM('Jiekou')->selectData('*','1=1');
            $jkBuffer=stringChange('arrayKey',$jkBuffer,'jkid');
            $jkzjBuffer=SM('Jiekouzj')->selectData('*','ifchoose=1 and ifopen=1');
            $list=array();
            foreach($jkzjBuffer as $i=>$iJkzjBuffer){
                $list[$i]=$iJkzjBuffer;
                $list[$i]['jkname']=$jkBuffer[$iJkzjBuffer['jkid']]['jkname'];
                $list[$i]['jkstyle']=$jkBuffer[$iJkzjBuffer['jkid']]['jkstyle'];
            }
            return $list;
    }

}