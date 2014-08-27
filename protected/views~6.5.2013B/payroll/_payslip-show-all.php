<style>
table{
    border-collapse:collapse;
    font-family: Arial, sans-seriff;
    font-size:10pt;
}
td{
    border:0px solid #ddd;
    padding:3px;
    min-width:50px;
}
th{
    border:0px solid #ddd;
    padding:3px;
    min-width:50px;
}
div.container{
    border:2px dotted #ddd;
    width:360px;
    padding:10px;
    
}
table.container{
    width:350px;
    align:center;    
}
.left{
    text-align:left;
}
.center{
    text-align:center;
}
.right{
    text-align:right;
}
.underline{
    border-bottom:1px solid black;
}
.double-rule{
    border-bottom:4px double black;
}
.normal-weight{
    font-weight:normal;
}
.bold{
    font-weight:bold;    
}
.header{
    background-color:#ddd;
}
.upperline{
   border-top:1px solid black; 
}
</style>
<div class="container">
<table class="container">
    <thead>
        <tr>
            <th colspan="4"><img src="<?php echo Yii::app()->baseUrl; ?>/images/logo-ecmci.png"></th>
        </tr>
        <tr>
            <th class="left">Name</th><th class="normal-weight underline"><?php echo $model->Emp_Name;?></th><th class="right">Payroll Period</th><th class="normal-weight underline "><?php echo $model->Payroll_Period;?></th>
        </tr>
        <tr>
            <th class="left">Position</th><th class="normal-weight underline"><?php echo $model->Position;?></th><th class="right">Pay Date</th><th class="normal-weight underline"><?php echo date('M. d, Y',strtotime($model->Payroll_Date));?></th>
        </tr>    
    </thead>
    <tbody>
         <tr>
            <td colspan="2" class="bold center header">EARNINGS</td><td class="bold left header">DAYS</td><td class="bold center header">AMOUNT</td>
        </tr>
        <tr>
            <td colspan="2">Basic Pay</td><td><?php echo $model->Total_Days_Work;?></td><td class="right"><?php echo $model->Regular_Pay;?></td>
        </tr>
		<?php //if($model->Total_Night_Diff != '0.00'): ?>
        <tr>
            <td colspan="2">Night Differential</td><td></td><td class="right"><?php echo $model->Total_Night_Diff;?></td>
        </tr>
		<?php //endif ?>
        <?php //if($model->Regular_OT != '0.00'): ?>
		<tr>
            <td colspan="2">Regular OT</td><td></td><td class="right"><?php echo $model->Regular_OT;?></td>
        </tr>
		<?php //endif ?>
		<?php //if($model->NDOT != '0.00'): ?>
        <tr>
            <td colspan="2">NDOT</td><td></td><td class="right"><?php echo $model->NDOT;?></td>
        </tr>
		<?php //endif ?>
		<?php //if($model->Spec_Holiday != '0.00'): ?>
        <tr>
            <td colspan="2">Special Holiday</td><td></td><td class="right"><?php echo $model->Spec_Holiday;?></td>
        </tr>
		<?php //endif ?>
		<?php //if($model->Spec_OT != '0.00'): ?>
        <tr>
            <td colspan="2">Special Holiday OT</td><td></td><td class="right"><?php echo $model->Spec_OT;?></td>
        </tr>
		<?php //endif ?>
		<?php //if($model->Spec_NDOT != '0.00'): ?>
        <tr>
            <td colspan="2">Special Holiday NDOT</td><td></td><td class="right"><?php echo $model->Spec_NDOT;?></td>
        </tr>
		<?php //endif ?>
		<?php //if($model->Reg_Holiday != '0.00'): ?>
        <tr>
            <td colspan="2">Regular Holiday</td><td></td><td class="right"><?php echo $model->Reg_Holiday;?></td>
        </tr>
		<?php //endif ?>
		<?php //if($model->RegHoliday_OT != '0.00'): ?>
        <tr>
            <td colspan="2">Regular Holiday OT</td><td></td><td class="right"><?php echo $model->RegHoliday_OT; ?></td>
        </tr>
		<?php //endif ?>
		<?php //if($model->RegHoliday_NDOT != '0.00'): ?>
        <tr>
            <td colspan="2">Regular Holiday NDOT</td><td></td><td class="right"><?php echo $model->RegHoliday_NDOT;?></td>
        </tr>
		<?php //endif ?>
		<?php //if($model->PTO_With_Tax != '0.00'): ?>
        <tr>
            <td colspan="2">PTO w/ Tax</td><td></td><td class="right"><?php echo $model->PTO_With_Tax;?></td>
        </tr>
		<?php //endif ?>
		<?php //if($model->PTO_Wo_Tax != '0.00'): ?>
        <tr>
            <td colspan="2">PTO w/o Tax</td><td></td><td class="right"><?php echo $model->PTO_Wo_Tax;?></td>
        </tr>
		<?php //endif ?>
		<?php //if($model->Extra_Allowance != '0.00'): ?>
        <tr>
            <td colspan="2">Allowance</td><td></td><td class="right"><?php echo $model->Extra_Allowance;?></td>
        </tr>
		<?php //endif ?>
		<?php //if($model->Adjustment != '0.00'): ?>
        <tr>
            <td colspan="2">Salary Adjustments</td><td></td><td class="right"><?php echo $model->Adjustment;?></td>
        </tr>
		<?php //endif ?>
        <tr>
            <td colspan="2" class="bold">TOTAL EARNINGS:</td><td></td><td class="right upperline underline"><?php echo $model->Total_Earnings;?></td>
        </tr>
        <tr>
            <td colspan="2" class="bold center header">DEDUCTIONS</td><td class="bold left header"></td><td class="bold center header"></td>
        </tr>
        <tr>
            <td colspan="2" class="">SSS Contribution</td><td></td><td class="right"><?php echo $model->SSS;?></td>
        </tr>
        <tr>
            <td colspan="2" class="">PHIC Contribution</td><td></td><td class="right"><?php echo $model->PHIC;?></td>
        </tr>
        <tr>
            <td colspan="2" class="">HDMF Contribution</td><td></td><td class="right"><?php echo $model->HDMF;?></td>
        </tr>
		<?php //if($model->SSS_Loan != '0.00'): ?>
        <tr>
            <td colspan="2" class="">SSS Loan</td><td></td><td class="right"><?php echo $model->SSS_Loan;?></td>
        </tr>
		<?php //endif ?>
		<?php //if($model->HDMF_Loan != '0.00'): ?>
        <tr>
            <td colspan="2" class="">HDMF Loan</td><td></td><td class="right"><?php echo $model->HDMF_Loan;?></td>
        </tr>
		<?php //endif ?>
		<?php //if($model->Rental_Housing != '0.00'): ?>
        <tr>
            <td colspan="2" class="">Housing</td><td></td><td class="right"><?php echo $model->Rental_Housing;?></td>
        </tr>
		<?php //endif ?>
		<?php //if($model->Insurance != '0.00'): ?>
        <tr>
            <td colspan="2" class="">Insurance</td><td></td><td class="right"><?php echo $model->Insurance;?></td>
        </tr>
		<?php //endif ?>
        <tr>
            <td colspan="2" class="">Witholding Tax</td><td></td><td class="right"><?php echo $model->Withholding_Tax;?></td>
        </tr>
        <tr>
            <td colspan="2" class="bold">TOTAL DEDUCTIONS:</td><td></td><td class="right upperline underline"><?php echo $model->Total_Deduction;?></td>
        </tr>
        <tr>
            <td colspan="2" class=""></td><td></td><td class=""></td>
        </tr>
        <tr>
            <td colspan="3" class="bold left">NET PAY:</td><td class="right double-rule"><?php echo $model->Net_Pay;?></td>
        </tr>   
    </tbody>
</table>
</div>