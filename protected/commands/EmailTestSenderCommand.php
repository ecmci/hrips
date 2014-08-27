<?php
class EmailTestSenderCommand extends CConsoleCommand {
    private $itsupport = 'steven.l@evacare.com';
    private $itgroup = 'mnl_support@evacare.com';
    private $smtp_servers = array(
      'evacare.com'=>array(
          'host'=>'smtp.1and1.com',
          'port'=>'25',
          'username'=>'steven.l@evacare.com',
          'password'=>'StevenLy@28',
          'from'=>'steven.l@evacare.com',
          'to'=>'steven.l@evacare.com',
          'subject'=>'SMTP Healthcheck | Good | evacare.com',
          'body'=>'If you received this test email, it means smtp.1and1.com sending capability is good. This monitor runs every 1 hour.',
      ),
      'ecmci.com'=>array(
          'host'=>'mail.ecmci.com',
          'port'=>'587',
          'username'=>'itmanila@ecmci.com',
          'password'=>'qrxTdE4f',
          'from'=>'steven.l@ecmci.com',
          'to'=>'steven.l@evacare.com',
          'subject'=>'SMTP Healthcheck | Good | ecmci.com',
          'body'=>'If you received this test email, it means mail.ecmci.com sending capability is good. This monitor runs every 1 hour.',
      ),
      'eigshop.com'=>array(
          'host'=>'smtpout.secureserver.net',
          'port'=>'25',
          'username'=>'steven.l@eigshop.com',
          'password'=>'UwjM4x8S',
          'from'=>'steven.l@eigshop.com',
          'to'=>'steven.l@evacare.com',
          'subject'=>'SMTP Healthcheck | Good | eigshop.com',
          'body'=>'If you received this test email, it means smtpout.secureserver.net sending capability is good. This monitor runs every 1 hour.',
      ),
    );
   
    public function run($args) {
        foreach($this->smtp_servers as $server){
          Yii::log("Checking ".$server['host']."...",'error','app');
          $msg = '';
          try{
            if($this->sendTestEmail($server)){
              $msg = $server['host']." is Up."; 
            }else{
              $msg = $server['host']." is Down!";
              $this->sendSureAlertEmail($server);                
            }
          }catch(Exception $e){
             $msg = "Test Failed: ".$e->getMessage();
          }
          echo $msg."\n";
          Yii::log($msg,'error','app');
          sleep(1);
        }
    }
    
    private function sendTestEmail($server){
      $sent = false;
      try{
        $mailer = $this->getMailerObject($server);
        return $mailer->Send(); 
        //print_r($server);          
      }catch(Exception $e){throw $e;}
      return $sent;
    }
    
    private function getMailerObject($server){
        Yii::import("ext.phpmailer.JPhpMailer");
        $mail = new JPhpMailer;
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->Host = $server['host'];
        $mail->Port = $server['port'];
        $mail->SMTPAuth = true;
        $mail->Username = $server['username'];
        $mail->Password = $server['password'];
        $mail->SetFrom($server['from'], 'Email Health Monitor');
        $mail->AddAddress($server['to']);
        $mail->Subject = $server['subject'];
        $mail->IsHTML(true);
        $mail->MsgHTML($server['body']);
        $mail->Priority = '5';
        return $mail;
    }
    
    private function sendSureAlertEmail($server){
      Yii::import("ext.phpmailer.JPhpMailer");
      $mail = new JPhpMailer;
      $mail->IsSMTP();
      $mail->Mailer = "smtp";
      $mail->Host = 'smtpdsl4.pldtdsl.net';
      $mail->Port = '587';
      $mail->Priority = '1';
      $mail->SetFrom($server['from'], 'Email Health Monitor');       
      $mail->AddAddress($this->itgroup);
      $mail->Subject = "SMTP Healthcheck | ".$server['host']." is Down!";
      $mail->IsHTML(true);
      $mail->MsgHTML("Cannot send test email for host ".$server['host'].". Host might be down."); 
      return $mail->Send(); 
    }
}
?>