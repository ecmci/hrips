<?php

Yii::import('application.models._base.BaseHrisDocumentLog');

class HrisDocumentLog extends BaseHrisDocumentLog
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
  
  public function beforeSave(){
    $this->timestamp = new CDbExpression('NOW()');
    return parent::beforeSave();
  }
}