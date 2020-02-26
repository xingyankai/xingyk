<?php
namespace xingyk\helper;

/**
 * 处理用户操作模块 （已读，已分享，已收藏）
 * @Notes: 适用于数据量少的关联操作关系: 如后台管理人员是否已读,后台管理人员一般可读的消息要少,可以使用该模块
 * @property $userId 用户ID
 * @property-read $operatedIds 用户已经操作过的记录IDs
 * @property $relaOperateModel 用户操作关联表
 * @property $relaUserField 关联表中的用户ID字段名
 * @property $operateField 关联表中的是否已操作字段名
 * @dependency 依赖于thinkphp框架
 *
 * Class RelationReadOperateCommon
 * @package app\investorapi\model
 */
class RelationOperateCommon
{
    protected $userId = 0; // 用户ID
    protected $operatedIds = []; // 已操作的记录IDs
    protected $relaOperateModel = null; // 操作Model表
    protected $relaUserField = ''; // 用户关联字段
    protected $operateField = ''; // 是否已操作的字段（例：是否已读 is_read）

    public function __construct($operateModelTableName, $relaUserField, $userId, $operateField)
    {
        if (!defined('THINK_VERSION') || version_compare(THINK_VERSION, '5.0.0', '<')) {
            throw new \Exception('依赖于Thinkphp5.0以上框架');
        }
        $this->userId = $userId;
        $this->relaUserField = $relaUserField;
        $this->operateField = $operateField;
        $this->operatedIds = $this->getOperatedModuleIdsByUserId($this->userId);
        $this->relaOperateModel = \think\Db::name($operateModelTableName);
    }

    /**
     * Notes: 更新记录是否已操作
     * User: xingyk
     * Date: 2020/2/26
     * @param $operateModuleId
     * @return bool
     */
    public function updateRelaModelIds($operateModuleId)
    {
        if ( !in_array($operateModuleId, $this->operatedIds)) {
            $this->operatedIds[] = $operateModuleId;
            $operateIds = implode(',', $this->operatedIds);
            $row = $this->relaOperateModel->where([$this->relaUserField => $this->userId])->find();
            if ($row) {
                $result = $this->relaOperateModel->where([$this->relaUserField => $this->userId])->setField($this->operateField, $operateIds);
            }else {
                $result = $this->relaOperateModel->insert([$this->operateField => $operateIds, $this->relaUserField=>$this->userId]);
            }
            return $result;
        }
        return true;
    }

    /**
     * Notes: 获取用户已读IDs
     * User: xingyk
     * Date: 2020/2/26
     * @param $userId
     * @return array
     */
    protected function getOperatedModuleIdsByUserId($userId)
    {
        $operateIds = $this->relaOperateModel->where([$this->relaUserField => $userId])->value($this->operateField);
        if (empty($operateIds)) {
            return [];
        }
        $operateIds = explode(',', $operateIds);
        return $operateIds;
    }

    /**
     * Notes: 返回列表中每条记录是否已读
     * User: xingyk
     * Date: 2020/2/26
     * @param $relaModelList
     * @param $operateKey string 表明是否已操作的字段名
     */
    public function writeModelListIsRead(&$relaModelList, $operateKey)
    {
        foreach ($relaModelList as $key => $value) {
            if ( in_array($value['id'], $this->operatedIds) ) {
                $relaModelList[$key][$operateKey] = 1;
            }else {
                $relaModelList[$key][$operateKey] = 0;
            }
        }
    }
}