<?php
/**
 * Revision 8.25.2014
 *
 */  
Yii::import('application.controllers.HrisOtApplication1Controller');
class HrisOtApplicationController extends HrisOtApplication1Controller{
  
  public function accessRules() {
      return array_merge(array(
          array('allow',
              'actions'=>array('save'),
              'users'=>array('@'),
          ),
      ),  parent::accessRules());
  }
  
  public function actionSave()
  {
      if(Yii::app()->getRequest()->isAjaxRequest){
          $count = 0;
          if(isset($_POST['ot']))
              foreach($_POST['ot'] as $ot){
                if($ot['edit'] == '1'){
                    $m = HrisOtApplication::model()->findByPk($ot['id']);
                    $m->hours = $ot['hours'];
                    $m->minutes = $ot['minutes'];
                    $m->sub_code_id = $ot['sub_code_id'];
                    $m->save(false);
                    $count++;
                    Yii::log('OT ID '.$ot['id'].' edited by '.Yii::app()->user->getState('emp_name').' data['.json_encode($ot).']','info','app');
                }
              }
          echo $count.' record(s) saved.';
      }else{
          throw new CHttpException(400,'This action only accepts ajax request.');
      }          
  }
  /**
   * Renders the OT approval gridview form.
   */  
  public function actionFormyapproval()
  {
        $this->layout = 'column1';
        $model = new HrisOtApplication('getOTForApproval');
        $model->unsetAttributes();
      
        $this->render('approval2', array(
            'model' => $model,
        ));
  }
}
?>