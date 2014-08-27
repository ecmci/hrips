<?php
$data = $model->test();

 ?>
<table class="table">
<?php 
/*
foreach($data->data as $d) { ?>
  <tr>
      <td><?php echo $d->id; ?></td>
      <td><?php echo $d->clockedin_datetime; ?></td>
      <td><?php echo $d->clockedout_datetime; ?></td>
      <td><?php echo $d->hours; ?></td>
      <td><?php echo $model->test_encode_hours($d->hours); ?></td>
      <td><?php echo $d->hours_approved; ?></td>
  </tr>  
<?php }  */ ?>  
</table>

<?php 
echo '<pre>';
foreach($data->data as $d) { 
  $mu = HrisMuApplication::model()->findByPk($d->id);
  $mu->hours = $d->hours;
  $mu->save(false);
}
echo '</pre>';

?>