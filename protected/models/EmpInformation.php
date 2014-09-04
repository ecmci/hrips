<?php
Yii::import('application.models.EmpInformation0');
class EmpInformation extends EmpInformation0{
  public function populateFromEmployee()
  {
    $e = Employee::model()->find("Emp_ID = ".Yii::app()->user->getState('emp_id'));
    $this->EmpID = $e->Emp_ID;
    $this->FirstName = $e->Fname;
    $this->LastName = $e->Lname;
    $this->MiddleName = $e->Mname;
    $this->BirthDate = $e->Birthday;
    $this->BdayPlace = $e->Birthplace;
    $this->Gender = $e->Gender=='Male' ? '1' : '2';
    $this->CivilStat = $e->Civil_Status=='Married' ? '2' : '1';
    $this->Citizenship = $e->Citizenship;
    $this->Height = $e->Height;
    $this->Weight = $e->Weight;
    $this->BloodType = $e->Blood_Type;
    $this->HDMF = $e->PAG_IBIG;
    $this->PHIC = $e->PHIL_HEALTH;
    $this->SSS = $e->SSS;
    $this->ResidentialAddress = $e->Residential_Add;
    $this->HomeAddress = $e->Permanent_Add;
    $this->EmailAddress = $e->Email_Add;
    $this->ContactNo = $e->Contact_No;
    $this->TIN = $e->TIN;
    $this->Department = $e->Department;
    $this->Position = $e->Position;
    $this->DateHire = $e->Date_Hired;
  }
} 
?>