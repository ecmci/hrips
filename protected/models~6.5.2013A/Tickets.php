<?php

Yii::import('application.models._base.BaseTickets');

class Tickets extends BaseTickets
{
	 public $from, $to;
   
   
   public function getProblemCategoryList(){
      return CHtml::listData(TicketsCategory::model()->findAll(array(
        'order'=>'name asc'
      )),'id','name');
   }
  
  
  public static function model($className=__CLASS__) {
		return parent::model($className);
	}
  
  public function rules() {
		return array(
			array('category_id, reported_by_id, status', 'required'),
			array('category_id, reported_by_id, created_by_id', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>512),
			array('notes, created_timestamp, closed_timestamp, from, to', 'safe'),
			array('notes, created_timestamp, closed_timestamp', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, category_id, reported_by_id, created_by_id, status, notes, created_timestamp, closed_timestamp', 'safe', 'on'=>'search'),
		);
	}
  
  public function getIncidentsPieData(){
    // 1. get overall count
    $c = new CDbCriteria;
    $c->select = "count(id) as id";    
    $c->condition = "date(created_timestamp) >= '$start' AND date(created_timestamp) <= '$end'";
  }
  
  public function getHexaColorCode(){
    return substr(md5(rand()), 0, 8);
  }
  
  public function beforeSave(){
    
    $this->created_by_id = ($this->isNewRecord) ? Yii::app()->user->getState('emp_id') : $this->created_by_id;
    $this->created_timestamp = ($this->isNewRecord) ? new CDbExpression('NOW()') :  $this->created_timestamp;
    $this->closed_timestamp = ($this->status == 'Closed') ? new CDbExpression('NOW()') :  null;
    //echo '<pre>'; print_r($this->attributes); echo '</pre>';    exit();
    return parent::beforeSave();
  }
  
  public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'Case Number'),
			'category_id' => Yii::t('app', 'Problem Category'),
			'reported_by_id' => Yii::t('app', 'Reported By'),
			'created_by_id' => Yii::t('app', 'Handled By'),
			'status' => Yii::t('app', 'Status'),
			'notes' => Yii::t('app', 'Notes'),
			'created_timestamp' => Yii::t('app', 'Created'),
			'closed_timestamp' => Yii::t('app', 'Closed'),
			'createdBy' =>  Yii::t('app', 'Handled By'),
			'category' => Yii::t('app', 'Problem Category'),
			'reportedBy' => Yii::t('app', 'Reported By'),
      'from' => Yii::t('app', 'From'),
      'to' => Yii::t('app', 'To'),
		);
	}
  
  public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('category_id', $this->category_id);
		$criteria->compare('reported_by_id', $this->reported_by_id);
		$criteria->compare('created_by_id', $this->created_by_id);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('notes', $this->notes, true);

    if(!empty($this->from) and !empty($this->to) ){
      $criteria->addCondition("DATE(created_timestamp) >= '$this->from' AND DATE(created_timestamp) <= '$this->to'");
    }elseif(!empty($this->from)){
      $criteria->compare('created_timestamp', strtotime($this->from));
    }elseif(!empty($this->to)) {
      $criteria->compare('created_timestamp', strtotime($this->to));
    }
    
    $criteria->order = "status desc, created_timestamp asc";
    

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
  
  public static function label($n = 1) {
		return Yii::t('app', 'Incident|Incidents', $n);
	}
}