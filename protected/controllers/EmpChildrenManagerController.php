<?php
 
class EmpChildrenManager extends TabularInputManager
{
 
    protected $class='EmpChildren';
 
    public function getItems()
    {
        if (is_array($this->_items))
            return ($this->_items);
        else 
            return array(
                'n0'=>new EmpChildren,
            );
    }
 
 
    public function deleteOldItems($model, $itemsPk)
    {
        $criteria=new CDbCriteria;
        $criteria->addNotInCondition('id', $itemsPk);
        $criteria->addCondition("class_id= {$model->primaryKey}");
 
        EmpChildren::model()->deleteAll($criteria); 
    }
 
 
    public static function load($model)
    {
        $return= new EmpChildrenManager;
        foreach ($model->ID as $item)
            $return->_items[$item->primaryKey]=$item;
        return $return;
    }
 
 
    public function setUnsafeAttribute($item, $model)
    {
        $item->class_id=$model->primaryKey;
 
    }
 
 
}