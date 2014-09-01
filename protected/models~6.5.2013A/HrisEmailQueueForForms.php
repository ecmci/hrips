<?php

Yii::import('application.models._base.BaseHrisEmailQueueForForms');

class HrisEmailQueueForForms extends BaseHrisEmailQueueForForms
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}