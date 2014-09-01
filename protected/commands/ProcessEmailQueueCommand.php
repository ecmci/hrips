<?php
/**
 *   Cron job for processing the email queue
 *   This should be run hourly 
 *
 */      
class ProcessEmailQueueCommand extends CConsoleCommand {
    public function run($args) {
        // here we are doing what we need to do
        try{
            Yii::log("Batch processing email queue...",'info','app');
			WebApp::processEmailQueue();
        }catch(Exception $ex){
            echo $ex->getMessage();
             Yii::log($ex->getMessage(),'error','app');
        }
        
    }
}
?>