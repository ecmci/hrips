<div class="extended-hours">
<table class="table table-striped table-condensed">
<tbody>  
  <tr>
      <th style="width:25px;"></th>
      <th style="width:125px;">Clocked In</th>
      <th style="width:125px;">Clocked Out</th>
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
  $i = 0;
  foreach( $tcdata as $d){
  ?>
    <tr <?php if($d['hasBeenApplied']) echo 'class="muted"'; ?>>  
      <td style="width:25px;"><?php echo (!$d['hasBeenApplied']) ? $form->checkbox($model,"rows[$i]") : 'Applied'; ?><?php echo $form->hiddenField($model,"hours[$i][recordId]",array('value'=>$d['recordId'])); ?></td>
      <td style="width:125px;"><?php echo $d['ClockedInDate']; ?><?php echo $form->hiddenField($model,"hours[$i][clockedin_datetime]",array('value'=>$d['ClockedInDate'])); ?></td>
      <td style="width:125px;"><?php echo $d['ClockedOutDate']; ?><?php echo $form->hiddenField($model,"hours[$i][clockedout_datetime]",array('value'=>$d['ClockedOutDate'])); ?></td>
      <td style="width:125px;"><?php echo $d['extended']; ?><?php echo $form->hiddenField($model,"hours[$i][extended]",array('value'=>$d['extended'])); ?></td>
      <td style="width:125px;"><?php echo $d['SchedInDate']; echo $form->hiddenField($model,"hours[$i][sched_in]",array('value'=>$d['SchedInDate'])); ?></td>
      <td style="width:125px;"><?php echo $d['SchedOutDate']; echo $form->hiddenField($model,"hours[$i][sched_out]",array('value'=>$d['SchedOutDate'])); ?></td>
    </tr>
  <?php  $i++;  }//end foreach ?>
  </tbody>
</table>
</div>
</div>
