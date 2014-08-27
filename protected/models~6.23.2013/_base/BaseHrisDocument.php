<?php

/**
 * This is the model base class for the table "hris_document".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "HrisDocument".
 *
 * Columns in table "hris_document" available as properties of the model,
 * followed by relations of table "hris_document" available as properties of the model.
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $author_id
 * @property string $title
 * @property string $description
 * @property string $created_timestamp
 * @property string $updated_timestamp
 * @property string $filename_storage
 * @property string $filename_real
 * @property integer $active
 *
 * @property Employee $author
 * @property HrisDocumentCategory $category
 * @property HrisDocumentAccess[] $hrisDocumentAccesses
 * @property HrisDocumentLog[] $hrisDocumentLogs
 */
abstract class BaseHrisDocument extends GxActiveRecord {

	
  
  public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'hris_document';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'HrisDocument|HrisDocuments', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('category_id, author_id, title, description, created_timestamp', 'required'),
			array('category_id, author_id, active', 'numerical', 'integerOnly'=>true),
			array('title, filename_storage, filename_real', 'length', 'max'=>100),
			array('updated_timestamp', 'safe'),
			array('updated_timestamp, active', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, category_id, author_id, title, description, created_timestamp, updated_timestamp, filename_storage, filename_real, active', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'author' => array(self::BELONGS_TO, 'Employee', 'author_id'),
			'category' => array(self::BELONGS_TO, 'HrisDocumentCategory', 'category_id'),
			'hrisDocumentAccesses' => array(self::HAS_MANY, 'HrisDocumentAccess', 'doc_id'),
			'hrisDocumentLogs' => array(self::HAS_MANY, 'HrisDocumentLog', 'doc_id','order'=>'timestamp desc'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'category_id' => null,
			'author_id' => null,
			'title' => Yii::t('app', 'Title'),
			'description' => Yii::t('app', 'Description'),
			'created_timestamp' => Yii::t('app', 'Created Timestamp'),
			'updated_timestamp' => Yii::t('app', 'Updated Timestamp'),
			'filename_storage' => Yii::t('app', 'Filename Storage'),
			'filename_real' => Yii::t('app', 'Filename Real'),
			'active' => Yii::t('app', 'Active'),
			'author' => null,
			'category' => null,
			'hrisDocumentAccesses' => null,
			'hrisDocumentLogs' => null,
		);
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

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}