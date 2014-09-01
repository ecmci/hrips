<?php

Yii::import('application.models._base.BaseHrisDocumentCategory');

class HrisDocumentCategory extends BaseHrisDocumentCategory
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
  
  public static function label($n = 1) {
		return Yii::t('app', 'Document Category|Document Categories', $n);
	}
}