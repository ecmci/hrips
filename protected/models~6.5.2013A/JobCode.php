<?php

Yii::import('application.models._base.BaseJobCode');

class JobCode extends BaseJobCode
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}