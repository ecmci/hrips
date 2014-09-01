<?php

Yii::import('application.models._base.BaseHrisDocumentAccess');

class HrisDocumentAccess extends BaseHrisDocumentAccess
{
	/**
	 *  Evaluates access according to access rules defined. This checks departmental access first. If none
	 *  is defined, it then checks user access.   
	 *  @param string dept_id , string user_id
	 *  @return boolean Whether access is granted   
	 */        
   public static function canAccess($doc_id='0', $dept_id='0',$user_id='0',$action="t.read='1'"){
      if ( self::model()->exists("doc_id = '$doc_id' and dept_id = '$dept_id' and $action") )
        return true;
      return self::model()->exists("doc_id = '$doc_id' and user_id = '$user_id' and $action"); 
   }
  
  /**
	 * Sets the default access to the author
	 *    
	 */
   public function setDefaultAccess(){
    $this->user_id = Yii::app()->user->getState('emp_id');
    $this->dept_id = '';
    $this->read = '1';
    $this->update = '1';
    $this->delete = '1';
   }
   
   public function beforeSave(){
      $this->user_id = ($this->user_id == '') ? '0' : $this->user_id;
      $this->dept_id = ($this->dept_id == '') ? '0' : $this->dept_id;
      return parent::beforeSave();
   }   
  
  public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}