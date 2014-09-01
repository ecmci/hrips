<?php

Yii::import('application.models._base.BasePayroll');

class Payroll extends BasePayroll
{
	
  public $emp_id = '';
  public $from = '';
  public $to = '';
  
  public function rules() {
		return array(
			array('Emp_ID, Emp_Name, Position, Department, Schedule, Emp_Status, Monthly_Basic, Semi_Monthly_Basic, Tax_Status, Monthly_Night_Diff, Total_Semi_Monthly, Late_Absent, Extra_Allowance, New_Salary_with_ND, Per_Day, Per_Hr, Regular_Pay, Total_Night_Diff, ND_Per_Days, Total_Days_with_ND, Total_ND, Total_Gross_Pay, Total_Basic_Salary, SSS, Emp_Share_SSS, EC, PHIC, Emp_Share_PHIC, HDMF, Emp_Share_HDMF, Total_HDMF, Total_Tax_Income, Withholding_Tax, SSS_Loan, HDMF_Loan, Insurance, Rental_Housing, Total_Deduction, Non_PTO_Hrs, Non_PTO_Amt, Net_Pay, Payroll_Period, Payroll_Date, Payroll_Date_Words, Total_Earnings, Overtime_hrs, Overtime, Regular_OT, NDOT, Spec_Holiday, Spec_OT, Spec_NDOT, Reg_Holiday, RegHoliday_OT, RegHoliday_NDOT, VL, PTO_With_Tax, PTO_Wo_Tax, Basic_Pay, Cash_Out, Starting_Salary, sumEverything, initialYrEnder, YearEnder, Excess_to_13mo, countLang, Adjustment, Salary_Adjustment, Add_to_MB, Add_to_ND, Add_to_OT, Add_to_PTO_With_Tax, Add_to_SSS, Add_to_PHIC, Add_to_HDMF, Add_to_Taxable_Income, Add_to_NonTaxableDeduct, Add_to_Tax_Due, Taxable_Adj, NonTaxableAdj, Act_Status, Rate_with_ND', 'required'),
			array('Emp_ID, Starting_Salary', 'numerical', 'integerOnly'=>true),
			array('Extra_Allowance', 'numerical'),
			array('Emp_Name, Emp_Status, Payroll_Period, Payroll_Date_Words', 'length', 'max'=>60),
			array('Position, Department, Schedule, Tax_Status', 'length', 'max'=>30),
			array('Monthly_Basic, Semi_Monthly_Basic, Monthly_Night_Diff, Total_Semi_Monthly, Days_Work, Late_Absent, New_Salary_with_ND, Total_Days_Work, Per_Day, Per_Hr, Regular_Pay, Total_Night_Diff, ND_Per_Days, Total_Days_with_ND, Total_ND, Total_Gross_Pay, Total_Basic_Salary, SSS, Emp_Share_SSS, EC, PHIC, Emp_Share_PHIC, HDMF, Emp_Share_HDMF, Total_HDMF, Total_Tax_Income, Withholding_Tax, SSS_Loan, HDMF_Loan, Insurance, Rental_Housing, Total_Deduction, Non_PTO_Hrs, Non_PTO_Amt, Net_Pay, Total_Earnings, Overtime_hrs, Overtime, Regular_OT, NDOT, Spec_Holiday, Spec_OT, Spec_NDOT, Reg_Holiday, RegHoliday_OT, RegHoliday_NDOT, VL, PTO_With_Tax, PTO_Wo_Tax, Basic_Pay, Cash_Out, sumEverything, initialYrEnder, YearEnder, Excess_to_13mo, countLang, Adjustment, Salary_Adjustment, Add_to_MB, Add_to_ND, Add_to_OT, Add_to_PTO_With_Tax, Add_to_SSS, Add_to_PHIC, Add_to_HDMF, Add_to_Taxable_Income, Add_to_NonTaxableDeduct, Add_to_Tax_Due, Taxable_Adj, NonTaxableAdj, Rate_with_ND', 'length', 'max'=>20),
			array('Act_Status', 'length', 'max'=>250),
			array('Days_Work, Total_Days_Work', 'default', 'setOnEmpty' => true, 'value' => null),
			array('Emp_ID, from, to','required','on'=>'timesheet'),
			array('Emp_ID, from, to','safe','on'=>'timesheet'),
			array('from, to, Emp_ID, Emp_Name, Position, Department, Schedule, Emp_Status, Monthly_Basic, Semi_Monthly_Basic, Tax_Status, Monthly_Night_Diff, Total_Semi_Monthly, Days_Work, Late_Absent, Extra_Allowance, New_Salary_with_ND, Total_Days_Work, Per_Day, Per_Hr, Regular_Pay, Total_Night_Diff, ND_Per_Days, Total_Days_with_ND, Total_ND, Total_Gross_Pay, Total_Basic_Salary, SSS, Emp_Share_SSS, EC, PHIC, Emp_Share_PHIC, HDMF, Emp_Share_HDMF, Total_HDMF, Total_Tax_Income, Withholding_Tax, SSS_Loan, HDMF_Loan, Insurance, Rental_Housing, Total_Deduction, Non_PTO_Hrs, Non_PTO_Amt, Net_Pay, Payroll_Period, Payroll_Date, Payroll_Date_Words, Total_Earnings, Overtime_hrs, Overtime, Regular_OT, NDOT, Spec_Holiday, Spec_OT, Spec_NDOT, Reg_Holiday, RegHoliday_OT, RegHoliday_NDOT, VL, PTO_With_Tax, PTO_Wo_Tax, Basic_Pay, Cash_Out, Starting_Salary, sumEverything, initialYrEnder, YearEnder, Excess_to_13mo, countLang, Adjustment, Salary_Adjustment, Add_to_MB, Add_to_ND, Add_to_OT, Add_to_PTO_With_Tax, Add_to_SSS, Add_to_PHIC, Add_to_HDMF, Add_to_Taxable_Income, Add_to_NonTaxableDeduct, Add_to_Tax_Due, Taxable_Adj, NonTaxableAdj, Act_Status, Rate_with_ND', 'safe', 'on'=>'search'),
		);
	}
  
  public static function model($className=__CLASS__) {
		return parent::model($className);
	}
  
  /**
   *  Checks whether user can access
   *  @return boolean access
   */        
  public function canAccess(){
     return ($this->Emp_ID === Yii::app()->user->emp_id); 
  }
  
  public function afterFind(){
    
    $this->Regular_Pay = Yii::app()->format->formatNumber($this->Regular_Pay);
    $this->Total_Night_Diff = Yii::app()->format->formatNumber($this->Total_Night_Diff);
    $this->Overtime = Yii::app()->format->formatNumber($this->Overtime);
    $this->NDOT = Yii::app()->format->formatNumber($this->NDOT);
    $this->Spec_Holiday = Yii::app()->format->formatNumber($this->Spec_Holiday);
    $this->Spec_OT = Yii::app()->format->formatNumber($this->Spec_OT);
    $this->Spec_NDOT = Yii::app()->format->formatNumber($this->Spec_NDOT);
    $this->Reg_Holiday = Yii::app()->format->formatNumber($this->Reg_Holiday);
    $this->RegHoliday_OT = Yii::app()->format->formatNumber($this->RegHoliday_OT);
    $this->RegHoliday_NDOT = Yii::app()->format->formatNumber($this->RegHoliday_NDOT);
    $this->PTO_With_Tax = Yii::app()->format->formatNumber($this->PTO_With_Tax);
    $this->PTO_Wo_Tax = Yii::app()->format->formatNumber($this->PTO_Wo_Tax);
    $this->Extra_Allowance = Yii::app()->format->formatNumber($this->Extra_Allowance);
    /*Don't format cols "Adjustment" and "Salary_Adj" this will result in an error bcos these two cols are added in the payslip - owen*/
	//$this->Adjustment = Yii::app()->format->formatNumber($this->Adjustment);
	$this->Total_Earnings = Yii::app()->format->formatNumber($this->Total_Earnings);
    $this->SSS = Yii::app()->format->formatNumber($this->SSS);
    $this->PHIC = Yii::app()->format->formatNumber($this->PHIC);
    $this->HDMF = Yii::app()->format->formatNumber($this->HDMF);
    $this->SSS_Loan = Yii::app()->format->formatNumber($this->SSS_Loan);
    $this->HDMF_Loan = Yii::app()->format->formatNumber($this->HDMF_Loan);
    $this->Rental_Housing = Yii::app()->format->formatNumber($this->Rental_Housing);
    $this->Withholding_Tax = Yii::app()->format->formatNumber($this->Withholding_Tax);
    $this->Total_Deduction = Yii::app()->format->formatNumber($this->Total_Deduction);
    $this->Net_Pay = Yii::app()->format->formatNumber($this->Net_Pay);
    
    return parent::afterFind();
  }
  
  public static function label($n = 1) {
		return Yii::t('app', 'Payslip|Payslips', $n);
	}
  
  public function search() {
		$criteria = new CDbCriteria;
    //$criteria->select = "DATE_FORMAT(Payroll_Date,'%M %e, %Y') as Payroll_Date, Payroll_Period, id, UNIX_TIMESTAMP(Payroll_Date) as date";
    $criteria->compare('Emp_ID', Yii::app()->user->emp_id);
    $criteria->order='Payroll_Date desc';
    
    return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}