<?php

Yii::import('application.models._base.BaseEmployeeHrs');

class EmployeeHrs extends BaseEmployeeHrs
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function beforeSave(){
		if($this->isNewRecord){
			$this->UTC_added = new CDbExpression('NOW()');
		}
		return parent::beforeSave();
	}
}