<?php

Yii::import('application.models._base.BaseHrisDocument');

class HrisDocument extends BaseHrisDocument
{
	
  public $replace_file;  
  
  public static function model($className=__CLASS__) {
		return parent::model($className);
	}
  
  public function beforeSave(){
    if($this->isNewRecord){
      $this->created_timestamp = new CDbExpression('NOW()');
    }
    $this->updated_timestamp = new CDbExpression('NOW()');
    return parent::beforeSave();
  }
  
  public static function label($n = 1) {
		return Yii::t('app', 'Document|Documents', $n);
	}
  
  public function search() {
		$criteria = new CDbCriteria;
    
		$criteria->compare('id', $this->id);
		$criteria->compare('category_id', $this->category_id);
		$criteria->compare('author_id', $this->author_id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('created_timestamp', $this->created_timestamp, true);
		$criteria->compare('updated_timestamp', $this->updated_timestamp, true);
		$criteria->compare('filename_storage', $this->filename_storage, true);
		$criteria->compare('filename_real', $this->filename_real, true);
		$criteria->compare('active', $this->active);
    
    $dept_id = Yii::app()->user->getState('dept_id');
    $user_id = Yii::app()->user->getState('emp_id');
    
    //filter only those that the user is authorized to access
    $criteria->addCondition ("id IN (SELECT DISTINCT(doc_id) FROM hris_document_access hda WHERE (hda.dept_id = '$dept_id' AND hda.read = '1')OR(hda.user_id = '$user_id' AND hda.read = '1'))");    
    $criteria->order = "title ASC";

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
  
  public function rules() {
		return array(
      array('category_id, author_id, title, description', 'required', 'on'=>'update'),
			array('category_id, author_id, title, description, filename_real', 'required', 'on'=>'create'),
      //array('title', 'required', 'on'=>'update'),
      //array('description', 'required', 'on'=>'create'),
			array('category_id, author_id, active', 'numerical', 'integerOnly'=>true),
			array('title, filename_storage, filename_real', 'length', 'max'=>100),
      //array('filename_real', 'file', 'types'=>'pdf,doc,txt,docx,xls,xlsx,jpg,jpeg,png'),
			array('updated_timestamp, replace_file, filename_real', 'safe'),
			array('updated_timestamp, active', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, category_id, author_id, title, description, created_timestamp, updated_timestamp, filename_storage, filename_real, active', 'safe', 'on'=>'search'),
		);
	}
  
  public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'category_id' => Yii::t('app', 'Category'),
			'author_id' => Yii::t('app', 'Author'),
			'title' => Yii::t('app', 'Title'),
			'description' => Yii::t('app', 'Description'),
			'created_timestamp' => Yii::t('app', 'Created'),
			'updated_timestamp' => Yii::t('app', 'Updated'),
			'filename_storage' => Yii::t('app', 'Filename (Storage)'),
			'filename_real' => Yii::t('app', 'File'),
			'active' => Yii::t('app', 'Active'),
			'author' => Yii::t('app', 'Author'),
			'category' => Yii::t('app', 'Category'),
			'hrisDocumentAccesses' => Yii::t('app', 'Access'),
			'hrisDocumentLogs' => Yii::t('app', 'Audit Logs'),
		);
	}
  

}