<?php

Yii::import('application.models.EmpInformation0');

class EmpInformation extends EmpInformation0 {
    /**
     * Populates some fields from employee table. Employee updateable fields must be synced between these two tables.
     */
    public function populateFromEmployee($emp_id) {
        $e = Employee::model()->find("Emp_ID = " .$emp_id);
        $this->EmpID = $e->Emp_ID;
        $this->FirstName = $e->Fname;
        $this->LastName = $e->Lname;
        $this->MiddleName = $e->Mname;
        $this->BirthDate = $e->Birthday;
        $this->BdayPlace = $e->Birthplace;
        $this->Gender = $e->Gender == 'Male' ? '1' : '2';
        $this->CivilStat = $e->Civil_Status == 'Married' ? '2' : '1';
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

    /**
     * Do after save actions
     * @return type
     */
    protected function afterSave() {
        // Save the updateable fields to employee table as well so they are synced
        if (!$this->isNewRecord) {// if update
            $e = Employee::model()->find("Emp_ID = " . $this->EmpID);
            $e->Fname = ucwords(strtolower($this->FirstName));
            $e->Lname = ucwords(strtolower($this->LastName));
            $e->Mname = ucwords(strtolower($this->MiddleName));
            $e->Civil_Status = $this->CivilStat;
            $e->Height = $this->Height;
            $e->Weight = $this->Weight;
            $e->Residential_Add = $this->ResidentialAddress;
            $e->Permanent_Add = $this->HomeAddress;
            $e->Contact_No = $this->ContactNo;
            $e->Email_Add = $this->EmailAddress;
        }
        return parent::afterSave();
    }

    /**
     * Workaround in Yii so this class overrides the parent 
     * @param type $className
     * @return type
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}

?>