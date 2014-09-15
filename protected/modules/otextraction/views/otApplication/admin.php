<?php
/* @var $this OtApplicationController */
/* @var $model OtApplication */

$this->breadcrumbs=array(
	'Ot Applications'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List OtApplication', 'url'=>array('index')),
	array('label'=>'Create OtApplication', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ot-application-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="portlet">
	<div class="portlet-decoration" style="background-color: #F5F5F5;">
		<h1>Manage Overtime Applications</h1>
	</div>

	<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
	<div class="portlet-content">
	<div class="search-form">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
	</div><!-- search-form -->


<script type="text/javascript">
$(document).ready(function(){
	$('#OTForm').on('submit',submit);
});
function apply(TimeIn,TimeOut,RecordId){
	$('#clockinid').val(TimeIn);
	$('#clockoutid').val(TimeOut);
	//$('#<?php //echo CHtml::activeId($model,'ifexistid'); ?>').val(RecordId);
	$('#ifexid').val(RecordId);
	$('#myModal').modal('show');
}
function submit(){
	$.ajax({
		type:'POST',
		//url: 'http://192.168.1.231/hrips/index.php/otextraction/otApplication/admin', 
		url: <?php echo "'" . Yii::app()->createUrl("otextraction/otApplication/admin'"); ?>,
		data: $('#OTForm').serialize(),
		success: function(data){
		if(data==1){
		//alert('Success!');
		$('#myModal').modal('hide');
		$('#ot-application-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			return false;
		}else{
			//alert('Hindi successful!');
		}
}
});
return false;
}

</script>

 <?php $this->widget('zii.widgets.grid.CGridView', array(
	'htmlOptions'=>array('class'=>'table table-condensed table-striped'),
	'id'=>'ot-application-grid',
	'dataProvider'=>$model->searchTimeClock(),
	'columns'=>array(
		array('header'=>'','value'=>''),
		array('header'=>'','value'=>''),
		array('header'=>'Time In','value'=>'date("F d, Y   h:i A",strtotime($data["TimeIn"]))'),
		array('header'=>'Time Out','value'=>'date("F d, Y   h:i A",strtotime($data["TimeOut"]))'),
		array('header'=>'Action','value'=>array($model,'renderApplyButton'),'type'=>'raw')
	),
)); ?></div>
</div>
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Overtime Application</h3>
  </div>
  <div class="modal-body">
 <form action="" method="POST" id="OTForm">
	<table class="table">
	<tr>
	<td><i class="icon-time icon-2"></i>&nbsp;Clock in</td>
	<td><i class="icon-time icon-2"></i>&nbsp;Clock out</td>
	</tr>
	<tr>
	<td><input type="date" id="clockinid" name="OtApplication[in_datetime]" readonly /></td>
	<td><input type="date" id="clockoutid" name="OtApplication[out_datetime]" readonly /></td>
	</tr>
	Reason<textarea rows="4" cols="75" id="reason" name="OtApplication[reason]" required></textarea>
	</table>
  </div>
  <div class="modal-footer">
	<input id="ifexid" name="OtApplication[ifexistid]" hidden />
    <a class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
    <button class="btn btn-success">Save changes</button>
  </div>
</form>
</div>
