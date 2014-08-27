<?php

Yii::import('application.models._base.BaseHrisEmailTemplate');

class HrisEmailTemplate extends BaseHrisEmailTemplate
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
  
  public function beforeSave(){
    if($this->isNewRecord)
      $this->created = new CDbExpression('NOW()');
    $this->updated = new CDbExpression('NOW()');
    return parent::beforeSave();
  }
  
}