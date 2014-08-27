<div class="extended-hours">
<table class="table table-striped table-condensed">
<tbody>  
  <tr>
      <th style="width:25px;"></th>
      <th style="width:125px;">Clocked In</th>
      <th style="width:125px;">Clocked Out</th>
      <!--<th style="width:125px;">Hours</th>-->
      <!--<th style="width:125px;">Minutes</th>-->
      <th style="width:125px;">Extension</th>
      <th style="width:125px;">Shift In</th>
      <th style="width:125px;">Shift Out</th>
  </tr>
</tbody>
</table>
<div style="max-height:250px; overflow:auto;">
<table class="table table-striped table-condensed">
<tbody>
<?php 
$totalExtHrs = 0;
foreach( $tcdata as $i=>$d){
if($d['extendedHours'] >= HrisMuApplication::$min_extension_hours OR $d['extendedMinutes'] >= HrisMuApplication::$min_extension_minutes){
//if($totalExtHrs == 0){
?>
<tr>  
  <td style="width:25px;"><?php echo (!$d['hasBeenApplied']) ? CHtml::checkbox("row[]",'',array('value'=>$i)) : 'Applied'; ?><?php echo CHtml::hiddenField("hours[$i][recordId]",$d['recordId']); ?></td>
  <td style="width:125px;"><?php echo $d['ClockedInDate']; ?><?php echo CHtml::hiddenField("hours[$i][clockedin_datetime]",$d['ClockedInDate']); ?></td>
  <td style="width:125px;"><?php echo $d['ClockedOutDate']; ?><?php echo CHtml::hiddenField("hours[$i][clockedout_datetime]",$d['ClockedOutDate']); ?></td>
  <!--<td style="width:125px;"><?php //echo $d['extendedHours']; ?><?php echo CHtml::hiddenField("hours[$i][hours_in]",$d['extendedHours']); ?></td>-->
  <!--<td style="width:125px;"><?php //echo $d['extendedMinutes']; ?><?php echo CHtml::hiddenField("hours[$i][minutes]",$d['extendedMinutes']); ?></td>-->
  <td style="width:125px;"><?php echo $d['extended']; ?><?php echo CHtml::hiddenField("hours[$i][extended]",$d['extended']); ?></td>
  <td style="width:125px;"><?php echo $d['SchedInDate']; ?></td>
  <td style="width:125px;"><?php echo $d['SchedOutDate']; ?></td>
  <?php $totalExtHrs += $d['extendedHours']; ?>
</tr>
<?php }
} ?>
</tbody>
</table>
</div>
<table class="table table-striped table-condensed">
<tbody>  
  <tr>
      <th style="width:25px;"></th>
      <th style="width:125px;"></th>
      <th style="width:125px;"></th>
      <th style="width:125px;"></th>
      <th style="width:125px;"></th>
      <th style="width:125px;"></th>
  </tr>
</tbody>
</table>
</div>