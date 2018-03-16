<?php
// +----------------------------------------------------------------------
// | easy pay [ pay to easy ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 All rights reserved.
// +----------------------------------------------------------------------
// | Author: fengxing <QQ:51125330>
// +----------------------------------------------------------------------
/**
 * 订单模型
 * @author fengxing
 */
namespace Common\Model;
class DingdanModel extends BaseModel {

    /**
     * 获取代理对应商户的当日交易额
     * @param int $userid 用户id
     * @param int $starttime 开始时间
     * @param int $endtime 结束时间
     * @return array
     * @author fengxing
     */
    public function getAgentMoney($starttime,$endtime){
        $result=$this->dbConn->field('u.agent as userid,SUM(totalmoney) as money')
                ->table($this->formatTable('Dingdan').' d')
                ->join(' left join '.$this->formatTable('User').' u on u.userid=d.userid')
                ->where('d.status=1 and d.paytime between '.$starttime.' and '.$endtime.' and u.agent>0')
                ->group('u.agent')
                ->order('u.agent asc')
                ->select();

        return $result;
    }
    /**
     * 获取指定代理对应商户的当日交易额
     * @param int $userid 用户id
     * @param int $starttime 开始时间
     * @param int $endtime 结束时间
     * @return array
     * @author fengxing
     */
    public function getAgentMoneyByAgent($userid,$starttime,$endtime){
        $result=$this->dbConn->table($this->formatTable('Dingdan').' d')
                ->join(' left join '.$this->formatTable('User').' u on u.userid=d.userid')
                ->where('d.status=1 and d.addtime between '.$starttime.' and '.$endtime.' and u.agent='.$userid)
                ->sum('d.totalmoney');

        return $result;
    }
    /**
     * 获取指定代理对应商户的订单列表
     * @param int $agent 用户id
     * @param array $where 条件
     * @param string $page 分页条件
     * @return array
     * @author fengxing
     */
    public function getAgentList($agent,$where,$page){
        $result=$this->dbConn->field('d.*')
                ->table($this->formatTable('Dingdan').' d')
                ->join(' left join '.$this->formatTable('User').' u on u.userid=d.userid')
                ->where($where.' and u.agent='.$agent)
                ->page($page)
                ->order('ddid desc')
                ->select();

        return $result;
    }
    /**
     * 获取指定代理对应商户的订单总数
     * @param int $agent 用户id
     * @param array $where 条件
     * @return array
     * @author fengxing
     */
    public function getAgentCount($agent,$where){
        $result=$this->dbConn
                ->table($this->formatTable('Dingdan').' d')
                ->join(' left join '.$this->formatTable('User').' u on u.userid=d.userid')
                ->where($where.' and u.agent='.$agent)
                ->count('d.id');

        return $result;
    }
    /**
     * 获取指定代理对应订单总额
     * @param int $agent 用户id
     * @param array $where 条件
     * @return array
     * @author fengxing
     */
    public function getAgentSum($agent,$start=0,$end=0){
        $where='d.status=1 and u.agent='.$agent;
        if($start) $where.=' and d.addtime between '.$start.' and '.$end;
        $result=$this->dbConn
                ->table($this->formatTable('Dingdan').' d')
                ->join(' left join '.$this->formatTable('User').' u on u.userid=d.userid')
                ->where($where)
                ->sum('d.totalmoney');

        return $result;
    }
}