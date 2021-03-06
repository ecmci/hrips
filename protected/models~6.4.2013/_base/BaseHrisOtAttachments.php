<?php

/**
 * This is the model base class for the table "hris_ot_attachments".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "HrisOtAttachments".
 *
 * Columns in table "hris_ot_attachments" available as properties of the model,
 * followed by relations of table "hris_ot_attachments" available as properties of the model.
 *
 * @property integer $id
 * @property integer $form_model_id
 * @property string $real_filename
 * @property string $storage_filename
 *
 * @property HrisOtApplication $formModel
 */
abstract class BaseHrisOtAttachments extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'hris_ot_attachments';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'HrisOtAttachments|HrisOtAttachments', $n);
	}

	public static function representingColumn() {
		return 'real_filename';
	}

	public function rules() {
		return array(
			array('form_model_id, real_filename, storage_filename', 'required'),
			array('form_model_id', 'numerical', 'integerOnly'=>true),
			array('real_filename, storage_filename', 'length', 'max'=>50),
			array('id, form_model_id, real_filename, storage_filename', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'formModel' => array(self::BELONGS_TO, 'HrisOtApplication', 'form_model_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'form_model_id' => null,
			'real_filename' => Yii::t('app', 'Real Filename'),
			'storage_filename' => Yii::t('app', 'Storage Filename'),
			'formModel' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('form_model_id', $this->form_model_id);
		$criteria->compare('real_filename', $this->real_filename, true);
		$criteria->compare('storage_filename', $this->storage_filename, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}