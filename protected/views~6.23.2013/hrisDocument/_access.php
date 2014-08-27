<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui'); 
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/jcheckboxtree/jquery.checkboxtree.min.js"); 
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl."/js/jcheckboxtree/jquery.checkboxtree.min.css");

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/access.js");
Yii::app()->clientScript->registerCss('treeLabel',"
ul#tree label{
display:inline;
padding:10px;
}
");
?>

<div class="row-fluid">
    <div class="span6">
      <ul id="tree">
      <?php
       foreach($depts = HrisDept::model()->findAll() as $dept){
          echo "<li><input type='checkbox'><label>$dept->title</label>";
            echo '<ul>';
            foreach($dept->hrisUsers as $user){
              echo "<li><input type='checkbox' name='HrisDocumentAccess[user_id]'><label>".$user->emp->getEmpIdFullName()."</label></li>";  
            }
            echo '</ul>';
          echo '</li>'; 
       }      
      ?>
      </ul>
    </div>    
</div>

