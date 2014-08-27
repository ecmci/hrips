<?php
/**
 *   Cron job for pulling out OT from Timeclock.
 *   This should be run daily, preferably every 20:00:00 before the shift begins 
 *
 */      
class PullOutOTCommand extends CConsoleCommand {
    public function run($args) {
        // here we are doing what we need to do
        try{
             $records_entered = WebApp::pullOutOT();
             Yii::log("Recorded $records_entered OT record(s) imported from TimeClock.",'info','app');
             echo "Recorded $records_entered OT record(s) imported from TimeClock."; 
        }catch(Exception $ex){
            echo $ex->getMessage();
             Yii::log($ex->getMessage(),'error','app');
        }
        
    }
}
?>