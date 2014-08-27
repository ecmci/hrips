<?php
$model->formatNumbers();
?>
<div class="container">    
     <div class="row">
        <div class="span12">       
            <h1>GCC of <?php echo $model->ClientGroup; ?></h1>
        </div>
     </div>
     <div class="row">
        <div class="span12">       
            <h5 class="pull-right"><?php echo $model->CheckNumber; ?></h5>
        </div>
     </div> 
     <div class="row">
        <div class="span2">       
            <p><strong>Employee ID:</strong></p>
        </div>
        <div class="span4">       
            <p><?php echo $model->EmployeeId; ?></p>
        </div>
        <div class="span2">       
            <p><strong>Name:</strong></p>
        </div>
        <div class="span4">       
            <p><?php echo $model->LastName.', '.$model->FirstName; ?></p>
        </div>
     </div>
     <div class="row">
        <div class="span2">       
            <p><strong>SSN:</strong></p>
        </div>
        <div class="span4">       
            <p>### - ### - <?php echo substr($model->SSN, strlen($model->SSN)-4,strlen($model->SSN)); ?></p>
        </div>
        <div class="span2">       
            <p><strong>Department:</strong></p>
        </div>
        <div class="span4">       
            <p><?php echo $model->Department; ?></p>
        </div>
     </div>
     <div class="row">
        <div class="span2">       
            <p><strong></strong></p>
        </div>
        <div class="span4">       
            <p></p>
        </div>
        <div class="span2">       
            <p><strong>Pay Period:</strong></p>
        </div>
        <div class="span4">       
            <p><?php echo $model->PayPeriod; ?></p>
        </div>
     </div>
     <div class="row" style="border-bottom:1px solid black;">
          <div class="span2">
                <p><strong>Description Hr/Unit</strong></p>
          </div>
          <div class="span1">
                <p><strong>Rate</strong></p>
          </div>
          <div class="span2">
                <p><strong>Current</strong></p>
          </div>
          <div class="span2">
                <p><strong>Year-To-Date</strong></p>
          </div>
          <div class="span2">
                <p><strong>Description</strong></p>
          </div>
          <div class="span1">
                <p><strong>Current</strong></p>
          </div>
           <div class="span2">
                <p><strong>Year-To-Date</strong></p>
          </div>
     </div>
     <div class="row">
          <div class="span2">
                <p>Regular Pay</p>
          </div>
          <div class="span1">
                <p><?php echo $model->StdRateSalary; ?></p>
          </div>
          <div class="span2">
                <p><?php echo number_format($model->StdRateSalary * $model->HoursWorked, 2, '.', ','); ?></p>
          </div>
          <div class="span2">
                <p>?</p>
          </div>
          <div class="span2">
                <p>FICA W/H</p>
          </div>
          <div class="span1">
                <p><?php echo $model->FICAWH; ?></p>
          </div>
           <div class="span2">
                <p>?</p>
          </div>
     </div>
     <div class="row">
          <div class="span2">
                <p></p>
          </div>
          <div class="span1">
                <p></p>
          </div>
          <div class="span2">
                <p></p>
          </div>
          <div class="span2">
                <p></p>
          </div>
          <div class="span2">
                <p>Medicare W/H</p>
          </div>
          <div class="span1">
                <p><?php echo $model->MedicareWH; ?></p>
          </div>
           <div class="span2">
                <p>?</p>
          </div>
     </div>
     <div class="row">
          <div class="span2">
                <p>Overtime</p>
          </div>
          <div class="span1">
                <p>?</p>
          </div>
          <div class="span2">
                <p>?</p>
          </div>
          <div class="span2">
                <p>?</p>
          </div>
          <div class="span2">
                <p>Federal W/H</p>
          </div>
          <div class="span1">
                <p><?php echo $model->FederalWH; ?></p>
          </div>
           <div class="span2">
                <p>?</p>
          </div>
     </div>
     <div class="row">
          <div class="span2">
                <p></p>
          </div>
          <div class="span1">
                <p></p>
          </div>
          <div class="span2">
                <p></p>
          </div>
          <div class="span2">
                <p></p>
          </div>
          <div class="span2">
                <p>State W/H</p>
          </div>
          <div class="span1">
                <p><?php echo $model->StateWH; ?></p>
          </div>
           <div class="span2">
                <p>?</p>
          </div>
     </div>
     <div class="row">
          <div class="span2">
                <p>Doubletime</p>
          </div>
          <div class="span1">
                <p>?</p>
          </div>
          <div class="span2">
                <p>?</p>
          </div>
          <div class="span2">
                <p>?</p>
          </div>
          <div class="span2">
                <p>Local W/H</p>
          </div>
          <div class="span1">
                <p><?php echo $model->LocalWH; ?></p>
          </div>
           <div class="span2">
                <p>?</p>
          </div>
     </div>
     <div class="row" style="border-top:1px solid black;">
          <div class="span2">
                <p><strong>Total Gross</strong></p>
          </div>
          <div class="span1">
                <p><strong></strong></p>
          </div>
          <div class="span2">
                <p><strong><?php echo $model->GP1; ?></strong></p>
          </div>
          <div class="span2">
                <p><strong>?</strong></p>
          </div>
          <div class="span2">
                <p><strong>Deductions</strong></p>
          </div>
          <div class="span1">
                <?php
                 $deductions = $model->FICAWH + $model->MedicareWH + $model->FederalWH + $model->StateWH + $model->LocalWH;
                
                ?>
                <p><strong><?php echo number_format($deductions, 2, '.', ',') ?></strong></p>
          </div>
           <div class="span2">
                <p><strong>?</strong></p>
          </div>
     </div>
     <div class="row">
          <div class="span2">
                <p><strong></strong></p>
          </div>
          <div class="span1">
                <p><strong></strong></p>
          </div>
          <div class="span2">
                <p><strong></strong></p>
          </div>
          <div class="span2"
                <p><strong></strong></p>
          </div>
          <div class="span2">
                <p><strong>Net Pay</strong></p>
          </div>
          <div class="span1">
                <p><strong><?php echo $model->NetPay; ?></strong></p>
          </div>
           <div class="span2">
                <p><strong>?</strong></p>
          </div>
     </div>
</div>