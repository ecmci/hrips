<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Back to') . ' ' . $model->label(2), 'url'=>array('admin')),	
	//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	//array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	//array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><a href="<?php echo WebApp::getDownloadFileUrl($model->filename_storage); ?>" target="_blank"><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></a></h1>
<h3></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
array(
			'name' => 'category',
			'type' => 'raw',
			'value' => $model->category !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->category)), array('hrisDocumentCategory/view', 'id' => GxActiveRecord::extractPkValue($model->category, true))) : null,
			),
// array(
// 			'name' => 'author',
// 			'type' => 'raw',
// 			'value' => $model->author !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->author)), array('employee/view', 'id' => GxActiveRecord::extractPkValue($model->author, true))) : null,
// 			),
array(
			'name' => 'author',
			'type' => 'raw',
			'value' => $model->author !== null ? $model->author->getFullName() : null,
			),
'title',
'description',
'created_timestamp',
'updated_timestamp',
//'filename_storage',

array(
			'name' => 'filename_real',
			'type' => 'raw',
			'value' => CHtml::link($model->filename_real,WebApp::getDownloadFileUrl($model->filename_storage),array('target'=>'_blank')),
			),
'active:boolean',
	),
)); ?>

<?php
//$model->hrisDocumentAccesses as $relatedModel
//$model->hrisDocumentLogs as $relatedModel
?>
<div class="tabbable"> <!-- Only required for left/right tabs -->
  
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Access Rules</a></li>
    <li><a href="#tab2" data-toggle="tab">Audit Logs</a></li>
  </ul>
  
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
      <table class="table table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Department</th>
                <th>Read</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
           <?php
            $check = "<i class='icon-check'></i>";
            foreach($model->hrisDocumentAccesses as $relatedModel){
              echo '<tr>';
                echo "<td>".(($relatedModel->user_id != '0') ? $relatedModel->user->getEmpIdFullName() : '')."</td>";
                echo "<td>".(($relatedModel->dept_id != '0') ? $relatedModel->dept->title : '')."</td>";
                echo "<td>".(($relatedModel->read=='1') ? $check : '')."</td>";
                echo "<td>".(($relatedModel->update=='1') ? $check : '')."</td>";
                echo "<td>".(($relatedModel->delete=='1') ? $check : '')."</td>";
              echo '<tr>'; 
            }           
           ?>
        </tbody>
      </table>
    </div>
    <div class="tab-pane" id="tab2">
      <table class="table table-striped">
        <thead>
            <tr>
                <th>Timestamp</th>
                <th>User</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          <?php
            foreach($model->hrisDocumentLogs as $relatedModel){
              echo '<tr>';
                echo "<td>".$relatedModel->timestamp."</td>";
                echo "<td>".$relatedModel->user->getEmpIdFullName()."</td>";
                echo "<td>".$relatedModel->action."</td>";
              echo '<tr>'; 
            }
          
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>