<?php
namespace Common\Model;

use Think\Model;

class MembergamecollectionModel extends Model
{
    protected $tableName='member_game_collection';

    protected $fields=array('id','uid','gid','status','create_at','update_at');

    protected $_validate =array(
        array('uid','require','用户ID不存在',0,'',3),
        array('uid','checkUid','用户信息不存在',0,'callback',3),
        array('gid','require','缺少比赛ID',0,'',3),
        array('status','require','缺少收藏状态值',0,'',2),
        array('status',array(0,1),'超出收藏状态值',0,'in',3),
    );

    protected $_auto =array(
        array('create_at','getCurrentDate',1,'callback'),
        array('update_at','getCurrentDate',3,'callback'),
    );

    private static $status=array('collect'=>1,'cancel'=>0);

    protected function getCurrentDate()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * 验证用户信息
     * @param integer $id
     * @return bool
     */
    protected function checkUid($id)
    {
        $member = new MemberModel();
        return $member->getInfo($id) ? true : false;
    }

    /**
     * 判断用户是否有该比赛的收藏记录
     * @param integer $uid 用户ID
     * @param integer $gid 比赛ID
     * @param null|integer $status 收藏状态 0-取消收藏，1-收藏，默认为空
     * @return array|null
     */
    public function isUserCollectedGame($uid, $gid, $status = null)
    {
        $where = array('uid' => $uid, 'gid' => $gid);
        if (isset($status)) $where['status'] = $status;
        $ret = $this->field(array('id', 'status'))->where($where)->find();
        return $ret ? $ret : null;
    }

    /**
     * 改变收藏状态（该方法用于前端调用，如果不想传状态值，可直接调用该反射方法下面的两个单独方法）
     * @param integer $uid 用户ID
     * @param integer $gid 比赛ID
     * @param integer $status 收藏状态 0-取消收藏，1-收藏
     * @return array|mixed
     */
    public function changeCollectionStatus($uid, $gid, $status)
    {
        if (!in_array((int)$status, array(self::$status['collect'], self::$status['cancel']))) return buildReturnData(null, '超出收藏状态值', 0);
        $type = $status ? 'collect' : 'cancel';
        $function = new \ReflectionMethod(get_called_class(), $type . 'Game');
        return $function->invoke($this, $uid, $gid);
    }

    /**
     * 收藏比赛
     * @param integer $uid 用户ID
     * @param integer $gid 比赛ID
     * @return array
     * 1.没有判断 $uid, $gid 真实性
     * 2.错误日志送到自己的邮箱
     * 3.忘记在member表记录用户收藏总数
     * 4.代码没有扩展性，如果，我要加入，收藏日志功能,收藏送积分功能，不好加， 方法:代码之前判断各种报错，最后一条记录才是成功。
     */
    public function collectGame($uid, $gid)
    {
        $datas = array('uid' => $uid, 'gid' => $gid, 'status' => self::$status['collect']);
        if (!$createDatas = $this->token(false)->create($datas)) {
            debug('收藏比赛：'.$this->getError().' Datas:'.json_encode($datas));
            return buildReturnData(null, $this->getError(), 0);
        }
        //查询该用户是否有该比赛的收藏记录
        $collection = $this->isUserCollectedGame($uid, $gid);
        if (!$collection) {
            if (!$this->add()){
                debug('收藏比赛：添加收藏记录失败！ sql：'.$this->getLastSql());
                return buildReturnData(null, '收藏失败！', 0);
            }
            return buildReturnData(null, '收藏成功！', 1);
        }
        if ($collection['status'] == self::$status['collect']) {
            debug("收藏比赛：用户ID为{$uid}已收藏过比赛({$gid})！ sql：".$this->getLastSql()." --> status={$collection['status']}");
            return buildReturnData(null, '您已收藏过该比赛！', 0);
        }
        //更新收藏记录
        $createDatas['id'] = $collection['id'];
        if (!$this->save($createDatas)){
            debug('收藏比赛：收藏失败！ sql:'.$this->getLastSql());
            return buildReturnData(null, '收藏失败！', 0);
        }
        return buildReturnData(null, '收藏成功！', 1);
    }
    // 参考,
    // 注意:事务回滚可以不用写，程序终止自动事务回滚
    public function mackCk($uid, $gid)
    {
        $datas = array('uid' => $uid, 'gid' => $gid, 'status' => self::$status['collect']);
        if (!$createDatas = $this->token(false)->create($datas)) {
            debug('收藏比赛：'.$this->getError().' Datas:'.json_encode($datas));
            return buildReturnData(null, $this->getError(), 0);
        }
        // 判断用户信息真实性
        $Member = new MemberModel();
        $mInfo = $Member->getInfo($uid);
        if (!$mInfo) {
            return buildReturnData('', '用户信息不存在', 0);
        }
        // 判断比赛真实性
        $Game = new GameModel();
        $gInfo = $Game->getInfo($gid);
        if (!$gInfo) {
            return buildReturnData('', '比赛信息不存在', 0);
        }
        // 判断是否是主办方收藏
        if ($gInfo['uid'] == $uid) {
            return buildReturnData('', '主办方自己不能收藏', 0);
        }
        // 查询该用户是否有该比赛的收藏记录
        $collection = $this->isUserCollectedGame($uid, $gid);
        if ($collection) {
            if ($collection['status'] == self::$status['collect']) {
                debug("收藏比赛：用户ID为{$uid}已收藏过比赛({$gid})！ sql：".$this->getLastSql()." --> status={$collection['status']}");
                return buildReturnData(null, '您已收藏过该比赛！', 0);
            }
        }
        // 事物
        $this->startTrans();
        // member添加收藏总记录数
        $b = $Member->where(array('uid'=>$uid))->setInc('collectionnum',1);
        if (!$b) {
            $msg = "收藏总记录失败";
            debug($msg.$Member->getLastSql());
        }
        // 扩展中的功能

        // 收藏比赛
        if (!$collection) {
            $cid = $this->add();
            if (!$cid){
                $msg = "收藏失败！";
                debug($msg.$this->getLastSql());
                return buildReturnData(null, $msg, 0);
            }
        } else {
            //更新收藏记录
            $createDatas['id'] = $collection['id'];
            if (!$this->save($createDatas)){
                debug('收藏比赛：收藏失败！ sql:'.$this->getLastSql());
                return buildReturnData(null, '收藏失败！', 0);
            }
        }
        // 成功
        $this->comment();
        return buildReturnData(null, '收藏成功！', 1);
    }

    /**
     * 取消收藏比赛
     * @param integer $uid 用户ID
     * @param integer $gid 比赛ID
     * @return array
     */
    public function cancelGame($uid, $gid)
    {
        $datas = array('uid' => $uid, 'gid' => $gid, 'status' => self::$status['cancel']);
        if (!$createDatas = $this->token(false)->create($datas)) {
            debug('取消收藏比赛：'.$this->getError().' Datas:'.json_encode($datas));
            return buildReturnData(null, $this->getError(), 0);
        }
        //查询该用户是否有该比赛的收藏记录
        $collection = $this->isUserCollectedGame($uid, $gid);
        if (!$collection) {
            debug('取消收藏比赛：您还未收藏过该比赛！ sql:：'.$this->getLastSql());
            return buildReturnData(null, '您还未收藏过该比赛！', 0);
        }
        if ($collection['status'] == self::$status['cancel']) {
            debug("取消收藏比赛：用户ID为{$uid}已取消收藏过比赛({$gid})！ sql：".$this->getLastSql()." --> status={$collection['status']}");
            return buildReturnData(null, '你已取消收藏过该比赛！', 0);
        }
        //更新收藏记录
        $createDatas['id'] = $collection['id'];
        if ($this->save($createDatas) === false){
            debug('取消收藏比赛：取消收藏失败！ sql:'.$this->getLastSql());
            return buildReturnData(null, '取消收藏失败！', 0);
        }
        return buildReturnData(null, '取消收藏成功！', 1);
    }
}