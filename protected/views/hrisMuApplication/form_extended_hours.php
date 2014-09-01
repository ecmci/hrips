<?php $tcdata = $model->getExtendedHours(); 
Yii::app()->clientScript->registerScript('go',"
$('.retrieve-hours').click(function(){
  var from = $('#rtr-from').val();
  var to = $('#rtr-to').val();
  var params = 'rtr-hrs=1&from='+from+'&to='+to;
  var url ='".Yii::app()->createAbsoluteUrl('hrisMuApplication/create')."';
  $('.preloader').show();
  $('.extended-hours').fadeOut();
  $.post(url,params,function(response){
    $('.preloader').fadeOut();
    $('.extended-hours').html(response).fadeIn();  
  });  
  return false;
});
");
?>
<div class="row fluid">
        <div class="row fluid">
          <table>
                 <tr class="well">
                  <th></th>
                  <th colspan="5">Show extended hours from <?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
              			 'model'=>$model,		    
              		    'name'=>'HrisMuApplication[from]',
                      'id'=>'rtr-from',
              		    'value'=>$model->from,
              		    'htmlOptions'=>array('required'=>'required','placeholder'=>'yyyy-mm-dd hh:mm:ss'),		    		    
              		    'options'=>array(
              		        'showAnim'=>'fade',
              		        'dateFormat'=>'yy-mm-dd',
              		        'timeFormat'=>'hh:mm:ss',
                          'showMinute'=> true,            
              		    ),
              		    'language' => '',	
              			  'mode'=>'date',
              		  ));?> to <?php $this->widget('ext.CJuiDateTimePicker.CJuiDateTimePicker',array(
              			 'model'=>$model,		    
              		    'name'=>'HrisMuApplication[to]',
                      'id'=>'rtr-to',
              		    'value'=>$model->to,
              		    'htmlOptions'=>array('required'=>'required','placeholder'=>'yyyy-mm-dd hh:mm:ss'),		    		    
              		    'options'=>array(
              		        'showAnim'=>'fade',
              		        'dateFormat'=>'yy-mm-dd',
              		        'timeFormat'=>'hh:mm:ss',
                          'showMinute'=> true,            
              		    ),
              		    'language' => '',	
              			  'mode'=>'date',
              		  )); echo '&nbsp;'.CHtml::link('Retrieve','#',array('class'=>'btn retrieve-hours')); ?>&nbsp;<span style="display:none;" class="preloader"><img src="<?php echo Yii::app()->baseUrl; ?>/images/preloader.gif" width="30" style="width:30px; height: 30px;" /> Retreiving...Please Wait</span></th>
                </tr>
          </table>
        </div>
        <div class="row">
        <?php include '_form_extended_hours3.php';  ?>
        </div><!-- row -->
    </div><!-- row -->