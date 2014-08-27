<?php

Yii::import('application.models._base.BaseHrisAnnouncement');

class HrisAnnouncement extends BaseHrisAnnouncement
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
  
  public static function representingColumn() {
		return 'id';
	}
  
  public static function label($n = 1) {
		return Yii::t('app', 'Announcement|Announcements', $n);
	}
  
  public function beforeValidate(){
      $this->timestamp = new CDbExpression('NOW()');
      return parent::beforeSave();
  }
  
  public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('emp_id', $this->emp_id);
		$criteria->compare('message', $this->message, true);
		$criteria->compare('timestamp', $this->timestamp, true);
    
    $criteria->order = 'timestamp desc';
    $criteria->limit = 5;

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
  
}