<?php

/**
 * This is the model base class for the table "hris_mu_attachments".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "HrisMuAttachments".
 *
 * Columns in table "hris_mu_attachments" available as properties of the model,
 * followed by relations of table "hris_mu_attachments" available as properties of the model.
 *
 * @property integer $id
 * @property integer $mu_id
 * @property string $real_filename
 * @property string $storage_filename
 *
 * @property HrisMuApplication $mu
 */
abstract class BaseHrisMuAttachments extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'hris_mu_attachments';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'HrisMuAttachments|HrisMuAttachments', $n);
	}

	public static function representingColumn() {
		return 'real_filename';
	}

	public function rules() {
		return array(
			array('mu_id, real_filename, storage_filename', 'required'),
			array('mu_id', 'numerical', 'integerOnly'=>true),
			array('real_filename, storage_filename', 'length', 'max'=>50),
			array('id, mu_id, real_filename, storage_filename', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'mu' => array(self::BELONGS_TO, 'HrisMuApplication', 'mu_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'mu_id' => null,
			'real_filename' => Yii::t('app', 'Real Filename'),
			'storage_filename' => Yii::t('app', 'Storage Filename'),
			'mu' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('mu_id', $this->mu_id);
		$criteria->compare('real_filename', $this->real_filename, true);
		$criteria->compare('storage_filename', $this->storage_filename, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}