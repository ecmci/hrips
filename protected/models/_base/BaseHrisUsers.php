<?php

/**
 * This is the model base class for the table "hris_users".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "HrisUsers".
 *
 * Columns in table "hris_users" available as properties of the model,
 * followed by relations of table "hris_users" available as properties of the model.
 *
 * @property integer $emp_id
 * @property string $password_md5
 * @property integer $access_lvl_id
 * @property integer $dept_id
 *
 * @property HrisDept $dept
 * @property Employee $emp
 * @property HrisAccessLvl $accessLvl
 */
abstract class BaseHrisUsers extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'hris_users';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'HrisUsers|HrisUsers', $n);
	}

	public static function representingColumn() {
		return 'password_md5';		
	}

	public function rules() {
		return array(
			array('emp_id, password_md5, access_lvl_id, dept_id', 'required'),
			array('emp_id, access_lvl_id, dept_id', 'numerical', 'integerOnly'=>true),
			array('password_md5', 'length', 'max'=>50),
			array('reset_pass', 'safe'),
			array('emp_id, password_md5, access_lvl_id, dept_id, reset_pass', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'dept' => array(self::BELONGS_TO, 'HrisDept', 'dept_id'),
			'emp' => array(self::BELONGS_TO, 'Employee', 'emp_id'),
			'accessLvl' => array(self::BELONGS_TO, 'HrisAccessLvl', 'access_lvl_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'emp_id' => null,
			'password_md5' => Yii::t('app', 'Password Md5'),
			'access_lvl_id' => null,
			'dept_id' => null,
			'dept' => null,
			'emp' => null,
			'accessLvl' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('emp_id', $this->emp_id);
		$criteria->compare('password_md5', $this->password_md5, true);
		$criteria->compare('access_lvl_id', $this->access_lvl_id);
		$criteria->compare('dept_id', $this->dept_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}