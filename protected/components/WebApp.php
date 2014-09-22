<?php

/** 	Helper class for theme and web app managment.

  @author:  Christian Salazar  https://github.com/christiansalazar  christiansalazarh@gmail.com  @bluyell
 */
class WebApp {

    public static function actualHours($in, $out) {
        $d = self::diffBetweenDateTimeRange($in, $out);
        //echo $d['hours'].' hours '.$['mins'].' minutes';
        $hours = $d['hours'] < 10 ? '0' . $d['hours'] : $d['hours'];
        $minutes = $d['mins'] < 10 ? '0' . $d['mins'] : $d['mins'];
        echo "$hours:$minutes";
    }

    /**
     * Check the time clock for clock in / out records
     */
    public static function getEmployeeClockRecords($start_datetime, $end_datetime, $emp_id) {
        try {
            $data = Yii::app()->tcdb->createCommand()
                    ->select('TimeIn,TimeOut')
                    ->from('EmployeeHours')
                    ->where("EmployeeId = '$emp_id'")
                    ->andWhere("TimeIn >= '$start_datetime'")
                    ->andWhere("TimeOut <= '$end_datetime'")
                    ->order('TimeIn asc')
                    ->queryAll();
            return $data;
        } catch (Exception $e) {
            return null;
            //throw $e;
        }
    }

    /**
     * Format date from TC records in homepage
     */
    public static function formatPunchDatetime($datetime) {
        //echo 'datetime='.$datetime;exit();
        //return $datetime;
        return date('D, m/d/Y h:i A', strtotime($datetime));
    }

    /**
     * Get documents folder url path
     *
     *
     */
    public static function getDownloadFileUrl($filename_storage = '') {
        return Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/uploads/documents/' . $filename_storage;
    }

    /**
     * 	Cron job for processing the email queue
     * 	This should be run hourly   
     * 	@param 
     * 	@return 
     */
    public static function processEmailQueue() {
        $emails = HrisEmailQueueForForms::model()->findAll(array('condition' => "sent = '0'"));
        if (!empty($emails))
            self::sendEmail($emails);
    }

    public static function sendPHPMailer($from, $to, $subject, $body) {
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        try {
            $mail = new JPhpMailer;
            $mail->IsSMTP();
            $mail->Mailer = "smtp";
            $mail->Host = 'mail.ecmci.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'noreply@ecmci.com';
            $mail->Password = 'admin5524';
            $mail->SetFrom($from, 'ECMCI-No Reply');
            $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
            $mail->AddAddress($to);
            $mail->Subject = $subject;
            $mail->MsgHTML($body);
            if (!$mail->Send()) {
                throw new Exception($mail->ErrorInfo);
            }
        } catch (phpmailerException $ex) {
            Yii::log($ex->getMessage(), 'info', 'app');
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), 'info', 'app');
        }
    }

    public static function test() {
        try {
            Yii::import('application.extensions.phpmailer.JPhpMailer');
            $mail = new JPhpMailer;
            $mail->IsSMTP();
            $mail->Mailer = "smtp";
            $mail->Host = 'mail.ecmci.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'noreply@ecmci.com';
            $mail->Password = 'admin5524';
            $mail->SetFrom('noreply@ecmci.com', 'ECMCI-No Reply');
            $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
            $mail->AddAddress('steven.l@evacare.com');
            $mail->Subject = 'test dev';
            $mail->MsgHTML('see if i got thru');
            if ($mail->Send()) {
                echo "ok";
            } else {
                echo "fail to send test email!!!";
            }
        } catch (phpmailerException $ex) {
            echo $ex->getMessage();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    protected static function sendEmail($emails) {
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        try {
            $total_sent = 0;
            foreach ($emails as $email) {
                $mail = new JPhpMailer;
                $mail->IsSMTP(true);
                $mail->IsHTML(true);
                $mail->Host = 'mail.ecmci.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'noreply@ecmci.com';
                $mail->Password = 'admin5524';
                $mail->SetFrom('noreply@evacare.com', 'ECMCI-HRIPS');
                $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
                $mail->AddAddress($email->to);
                $mail->Subject = $email->subject;
                $mail->MsgHTML($email->content);
                if ($mail->Send()) {
                    $q = HrisEmailQueueForForms::model()->findByPk($email->id);
                    $q->sent = '1';
                    $q->sent_timestamp = new CDbExpression('NOW()');
                    $q->save(false);
                    Yii::log("Successfully sent notification email to " . $email->to . " for queue ID " . $email->id, 'info', 'app');
                    $total_sent++;
                }
                else
                    throw new Exception($mail->ErrorInfo);
            }
            echo "Successfully Sent in batch : $total_sent";
            Yii::log("Successfully Sent in batch : $total_sent", 'info', 'app');
        } catch (phpmailerException $ex) {
            Yii::log($ex->getMessage(), 'error', 'app');
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), 'error', 'app');
        }
    }

    /**
     * 	Cron job for pulling out OT from Timeclock.
     * 	This should be run daily, preferably every 16:00:00 after the last shift ends     
     * 	@param 
     * 	@return 
     */
    public static function pullOutOT() {
        //$start = date('Y-m-d',time());
        $start = date('Y-m-d 16:30:00', strtotime('-1 days', time()));
        try {
            $tcsvr = Yii::app()->tcdb;
            $records = $tcsvr->createCommand()
                    ->select('EmployeeId,TimeIn,TimeOut')
                    ->from('EmployeeHours')
                    ->where("JobCode ='2001'")  //please refer to job_code table
                    //->andWhere("TimeIn >= '$start'")
                    ->andWhere("TimeIn >= '2014-01-01 00:00:00'")
                    ->andWhere("TimeIn <= '2014-06-30 23:55:00'")
                    ->andWhere("EmployeeId = '1078'")
                    ->order("EmployeeId asc, TimeIn asc")
                    ->queryAll();
            $i = 0;
            Yii::log("Extracting OT Records as of $start ...", 'info', 'app');
            foreach ($records as $record) {
                $employee = HrisUsers::model()->findByPk($record['EmployeeId']);
                $ot = new HrisOtApplication;
                $ot->dept_id = $employee->dept_id;
                $ot->emp_id = $record['EmployeeId'];
                $ot->next_lvl_id = HrisAccessLvl::$EMPLOYEE;
                $ot->job_code_id = '2001';
                $ot->sub_code_id = '2001-13'; //defaults to regular OT
                $ot->in_datetime = date('Y-m-d H:i:s',strtotime($record['TimeIn']));
                $ot->out_datetime = date('Y-m-d H:i:s',strtotime($record['TimeOut']));
                $ot->reason = '';
                $ot->save(false);
                $i++;
                Yii::log("Extracted OT of " . $record['EmployeeId'], 'info', 'app');
            }
            return "$i of " . sizeof($records);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function pullOutOTWeb() {
        $start = '2013-04-09 22:00:00';
        $end = '2013-04-10 23:55:00';
        try {
            $tcsvr = Yii::app()->tcdb;
            $records = $tcsvr->createCommand()
                    ->select('EmployeeId,TimeIn,TimeOut')
                    ->from('EmployeeHours')
                    ->where("JobCode ='2001'")  //please refer to job_code table
                    ->andWhere("TimeIn >= '$start'")
                    ->andWhere("TimeOut <= '$end'")
                    ->andWhere("EmployeeId NOT IN('1109','1108')")
                    ->order("EmployeeId asc, TimeIn asc")
                    ->queryAll();
            $i = 0;
            Yii::log("Extracting OT Records as of $start ...", 'info', 'app');
            foreach ($records as $record) {
                $employee = HrisUsers::model()->findByPk($record['EmployeeId']);
                $ot = new HrisOtApplication;
                $ot->dept_id = $employee->dept_id;
                $ot->emp_id = $record['EmployeeId'];

                $ot->next_lvl_id = HrisAccessLvl::$HR;
                $ot->sup_id = '1069';
                $ot->sup_approve = '1';
                $ot->sup_approve_datetime = new CDbExpression('NOW()');

                $ot->job_code_id = '2001';
                $ot->sub_code_id = '2001-13'; //defaults to regular OT
                $ot->in_datetime = $record['TimeIn'];
                $ot->out_datetime = $record['TimeOut'];
                $ot->reason = '';

                try {
                    $ot->save(false);
                } catch (Exception $exc) {
                    throw new Exception('Exception at EmpId = ' . $record['EmployeeId'] . $exc->getMessage());
                }
                $i++;
                Yii::log("Extracted OT of " . $record['EmployeeId'], 'info', 'app');
            }
            return "$i of " . sizeof($records);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Gets the recent punches for the employee
     *
     *
     */
    public static function getRecentPunches() {
        try {
            $count = Yii::app()->tcdb->createCommand('select count(*) from EmployeeHours')->queryScalar();
            $sql = "SELECT TOP 40 CONVERT(varchar, eh.[TimeIn], 100) as [ClockedIn],CONVERT(varchar, eh.[TimeOut], 100) as [ClockedOut], mjl.[Description] as [JobCode], DATEDIFF(hh,eh.[TimeIn], eh.[TimeOut]) as [Hours], eh.BreakFlag as BreakAfter
                FROM EmployeeHours eh
                JOIN MasterJobCodeList mjl on mjl.[JobCode] = eh.[JobCode]
                WHERE [EmployeeId] = '" . Yii::app()->user->getState('emp_id') . "'
                ORDER BY eh.[TimeIn] DESC";
            return new CSqlDataProvider($sql, array(
                        //'totalItemCount'=>$count,
                        'pagination' => false,
                        'db' => Yii::app()->tcdb,
                    ));
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), 'error', 'app');
            return null;
        }
    }

    /**
     * 	Gets the current shift schedule for the day
     * 	@param  string emp_id
     * 	@return string shift
     */
    public static function getMyDaysShiftSchedule($emp_id) {
        try {
            $con = Yii::app()->tcdb;
            $today = date('Y-m-d', time());
            $res = $con->createCommand()
                    ->select("TimeIn,TimeOut")
                    ->from("EmployeeSchedules")
                    ->where("EmployeeId='$emp_id'")
                    ->andWhere("TimeIn >= '$today'")
                    ->andWhere("TimeIn < '$today 23:59:00'")
                    ->queryRow();
            $shift = date(Yii::app()->params['dateFormat'], strtotime($res['TimeIn']));
            $shift .= ' to ' . date(Yii::app()->params['dateFormat'], strtotime($res['TimeOut']));
            return ($res == NULL) ? 'Not Scheduled' : $shift;
        } catch (Exception $ex) {
            Yii::log($ex->getMessage(), 'error', 'app');
            return '';
        }
    }

    /**
     * 	Queues an email notification for cron jobs to crunch later
     * 	@param string/CActiveRecord $model_id or model, string $model_name, string $to_user_id, string $email_group_id ,$string $subject, string $content
     * 	@return boolean success
     */
    public static function queueEmail($model = null, $model_name = '', $to_user_id, $subject, $content, $email_group_id = '', $group_content = '') {
        if ($model === null)
            return false;

        //always email the user
        $form = $model;
        $user = HrisUsers::model()->findByPk($to_user_id);

        $queue = new HrisEmailQueueForForms;
        $queue->to = $user->emp->Email_Add;
        $queue->subject = $subject;
        $queue->content = $content;
        $queue->sent = '0';
        $queue->save(false);

        //email next approving group  if it is not denied or ultimately approved
        if (($form->next_lvl_id != HrisAccessLvl::$ULTIMATELY_DENIED or $form->next_lvl_id != HrisAccessLvl::$ULTIMATELY_APPROVED) and $email_group_id != '') {
            $condition = ( $email_group_id == HrisAccessLvl::$EMPLOYEE ) ? array('condition' => "emp_id = '" . $form->reliever_id . "'") : array('condition' => "access_lvl_id = '" . $form->next_lvl_id . "'");
            $condition = ( $email_group_id == HrisAccessLvl::$SUPERVISOR ) ? array('condition' => "((access_lvl_id = '" . $form->next_lvl_id . "') and (dept_id = '" . $user->dept_id . "'))") : $condition;
            $approvers = HrisUsers::model()->findAll($condition);
            foreach ($approvers as $approver) {
                $queue = new HrisEmailQueueForForms;
                $queue->to = $approver->emp->Email_Add;
                $queue->subject = $subject;
                $queue->content = $group_content;
                $queue->save(false);
            }
        }
        return true;
    }

    /**
     * 	Gets the scheduled shifts between the start and end dates requested
     * 	@param string $start, string $end, $emp_id
     * 	@return array Scheduled_Days
     */
    public static function getEmployeeSchedule($start, $end, $emp_id) {
        $tcsvr = Yii::app()->tcdb;
        $res = $tcsvr->createCommand()
                ->select("TimeIn,TimeOut")
                ->from("EmployeeSchedules")
                ->where("EmployeeId='$emp_id'")
                ->andWhere("TimeIn >= '$start'")
                ->andWhere("TimeOut <= '$end'")
                ->order("TimeIn asc")
                ->queryAll();
        return ($res != NULL) ? $res : array();
    }

    /**
     * 	Gets the normalized scheduled shifts between the start and end dates requested
     * 	@param string $start, string $end, $emp_id
     * 	@return array Normalized_Scheduled_Shifts, empty array
     */
    public static function getScheduledShiftsWithin($start_datetime, $end_datetime, $emp_id) {
        try {
            $tcsvr = Yii::app()->tcdb;
            $res = $tcsvr->createCommand()
                    ->select("TimeIn,TimeOut")
                    ->from("EmployeeSchedules")
                    ->where("EmployeeId='$emp_id'")
                    ->andWhere("TimeIn >= '$start_datetime'")
                    ->andWhere("TimeOut <= '$end_datetime'")
                    ->order("TimeIn asc")
                    ->queryAll();
            return $res;
        } catch (Exception $ex) {  //throw $ex;
            Yii::log($ex->getMessage(), 'info', 'app');
            return array();
        }
    }

    public function getShiftBetween($start_datetime, $end_datetime, $emp_id) {
        try {
            $tcsvr = Yii::app()->tcdb;
            $res = $tcsvr->createCommand()
                    ->select("TimeIn,TimeOut")
                    ->from("EmployeeSchedules")
                    ->where("EmployeeId='$emp_id'")
                    ->andWhere("TimeIn >= '$start_datetime'")
                    //->andWhere("TimeOut <= '$end_datetime'")
                    ->andWhere("TimeIn <= '$end_datetime'")
                    ->order("TimeIn asc")
                    ->queryAll();
            return $res;
        } catch (Exception $ex) {  //throw $ex;
            Yii::log($ex->getMessage(), 'info', 'app');
            return array();
        }
    }

    /**
     * 	Gets the scheduled TimeIn and TimeOut given a starting Datetime
     * 	@param string Start_Datetime, string Emp_Id
     * 	@return array Normalized_Shift_In_Out, -1 for not found
     */
    public function getInOutDatetimes($aDatetime, $emp_id) {
        //cast everything to date to push start datetime to midnight
        $datetime_forward = date('Y-m-d', strtotime("+7 days", strtotime($aDatetime)));
        $datetime_backward = date('Y-m-d', strtotime("-7 days", strtotime($aDatetime)));

        $normalized_scheduled_shifts = WebApp::getEmployeeSchedule($datetime_backward, $datetime_forward, $emp_id);
        $user_ts = strtotime($aDatetime);
        $at = -1;
        foreach ($normalized_scheduled_shifts as $i => $shift) {
            $start_ts = strtotime($shift['TimeIn']);
            $end_ts = strtotime($shift['TimeOut']);
            if ((($user_ts >= $start_ts)) && (($user_ts <= $end_ts))) {
                $at = $i;
                break;
            }
        }
        //add breaks
        if ($at > -1) {
            $normalized_scheduled_shifts[$at]['BreakStart'] = date('Y-m-d H:i:s', strtotime('+4 hours', strtotime($normalized_scheduled_shifts[$at]['TimeIn'])));
            $normalized_scheduled_shifts[$at]['BreakEnd'] = date('Y-m-d H:i:s', strtotime('+1 hours', strtotime($normalized_scheduled_shifts[$at]['BreakStart'])));
        }

        return ($at > -1) ? $normalized_scheduled_shifts[$at] : array();
    }

    /**
     *  Gets the total number of hours withn a datetime period. This is to assume that the scheduler has been 
     *  configured such that there is only one timein and timeout in a day.   
     *  @params string $start_datetime, string $end_datetime, string $emp_id
     *  @return total_hours
     */
    public static function calculateWorkHours($start_datetime, $end_datetime, $shifts_within_period) {
        $start = strtotime($start_datetime);
        $end = strtotime($end_datetime);
        if (sizeof($shifts_within_period) == 1) {
            return (($end - $start) / 3600);
        }
        $hours = sizeof($shifts_within_period) * 8;
        $adjust = abs($shifts_within_period[0]['TimeIn'] - $start);
        if ($start >= $shifts_within_period[0]['BreakEnd']) {
            $adjust -= 3600;
        }
        if ($end <= $shifts_within_period[sizeof($shifts_within_period) - 1]['BreakStart']) {
            $adjust -= 3600;
        }
        $adjust += abs($shifts_within_period[sizeof($shifts_within_period) - 1]['TimeOut'] - $end);
        $hours -= floor($adjust / (60 * 60));
        return $hours;
    }

    public static function parseSeconds($seconds) {
        $result['years'] = floor($seconds / (365 * 60 * 60 * 24));
        $result['months'] = floor(($seconds - $result['years'] * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $result['days'] = floor(($seconds - $result['years'] * 365 * 60 * 60 * 24 - $result['months'] * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $result['hours'] = floor($seconds / 3600);
        $result['mins'] = floor(($seconds - $result['years'] * 365 * 60 * 60 * 24 - $result['months'] * 30 * 60 * 60 * 24 - $result['days'] * 60 * 60 * 24 - $result['hours'] * 60 * 60) / 60);
        return $result;
    }

    public static function diffBetweenDateTimeRange($date1, $date2) {
        $diff = abs(strtotime($date1) - strtotime($date2));
        $result['years'] = floor($diff / (365 * 60 * 60 * 24));
        $result['months'] = floor(($diff - $result['years'] * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $result['days'] = floor(($diff - $result['years'] * 365 * 60 * 60 * 24 - $result['months'] * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $result['hours'] = floor($diff / 3600);
        $result['mins'] = floor(($diff - $result['years'] * 365 * 60 * 60 * 24 - $result['months'] * 30 * 60 * 60 * 24 - $result['days'] * 60 * 60 * 24 - $result['hours'] * 60 * 60) / 60);
        return $result;
    }

    public static function getTimeDifferenceInHrs($date1, $date2) {
        $diff = self::diffBetweenDateTimeRange($date1, $date2);
        return $diff['hours'];
    }

    public static function formatDate($datetime) {
        if ($datetime === NULL)
            return '';
        return date(Yii::app()->params['dateFormat'], strtotime($datetime));
    }

    public static function accountPanel() {
        $menues = self::topMenuItems();
        $ht = "<ul id='top-menu-items'>";
        $last = "";
        $n = 0;
        foreach ($menues as $m) {
            if ($n == (count($menues) - 1))
                $last = "class='last'";
            $item = "<a href='" . $m['url'] . "'><span>" . $m['label'] . "</span></a>";
            $ht .= "<li " . $last . ">" . $item . "</li>";
            $n++;
        }
        $ht .= "</ul>";
        return $ht;
        /*

          a more simplified way to do the same:

          if (Yii::app()->user->isGuest)
          {
          return CHtml::link("Account Login", array('site/login'));
          }
          else
          {
          $name = Yii::app()->user->name;
          return "<ul><li>Welcome <span class='loginname'>{$name}</span></li><li>" . CHtml::link("Exit", array('site/logout')) . "</li></ul>";
          }
         */
    }

    /**
     *  returns the base path for theme resources
     */
    public static function getThemeUrl() {
        // Use Yii::app()->theme->baseUrl instead of building string by hand
        // Use getThemeUrl() for building references to css stuff
        // @author: Donald Heering (donald.heering@gmail.com)
        return Yii::app()->theme->baseUrl;
    }

    public static function getThemePath() {
        // Use Yii::app()->theme->basePath instead of building string by hand
        // Use getThemePath() for themeSources that will be published as assets
        // @author: Donald Heering (donald.heering@gmail.com)
        return Yii::app()->theme->basePath;
    }

    /** creates a script path relative to theme folder
      @example:
      <?php echo WebApp::useScript('print.css',"media='print'"); ?>
      will output:
      <link rel='stylesheet' type='text/css' href='themes/system-office-1/css/print.css' media='print' />
     */
    public static function useScript($filename, $extra = "") {
        $path = self::getThemeUrl() . "/css/" . $filename;

        // determine file extension
        $extension = strrev(substr(strrev(trim($filename)), 0, 3));

        if ($extension == 'css') // stands for CSs
            return "<link rel='stylesheet' type='text/css' href='{$path}' {$extra} />\n";
        if ($extension == '.js')
            return "<script src='{$path}' {$extra} ></script>\n";

        return "\n<!-- error in file reference for: {$filename} , extension: {$extension}-->\n";
    }

    public static function getLogo() {
        return CHtml::image(self::getLogoFileName());
    }

    public static function getLogoFileName() {
        return self::getThemeUrl() . "/css/logo-eva2.gif";
    }

    public static function getSlogan() {
        return " ";
    }

    public static function getMbMenu($controllerInstance) {
        $controllerInstance->widget('application.extensions.mbmenu.MbMenu'
                , array(
            'themeSources' => self::getThemePath() . "/extras/mbmenu-sources/",
            'iconpack' => self::getThemeUrl() . "/generic-icon-pack-16x16.png",
            'items' => self::getMenuItems()
                )
        );
    }

    /** return the menu items for the main menu.

      at this point you can filter wich items should be shown to final user, depending on it user level.
     */
    public static function getMenuItems() {
        $loa = HrisLoaApplication::getPendingLoaApprovals();
        $ot = HrisOtApplication::getPendingOTApprovals();
        $mu = HrisMuApplication::getPendingMUApprovals();
        $badge_ot = ($ot > 0) ? "<span class='badge badge-important pull-right'>$ot</span>" : '';
        $badge_loa = ($loa > 0) ? "<span class='badge badge-important pull-right'>$loa</span>" : '';
        $badge_mu = ($mu > 0) ? "<span class='badge badge-important pull-right'>$mu</span>" : '';

        return array(
            array('label' => 'Overview', 'url' => array('site/index'), 'visible' => !Yii::app()->user->isGuest),
            array('label' => "Overtime $badge_ot<span class='caret'></span>", 'url' => array('#'), 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"), 'visible' => !Yii::app()->user->isGuest,
                'items' => array(
                    array('label' => 'Apply', 'url' => array('/otextraction/otApplication/admin'), 'visible' => !Yii::app()->user->isGuest),
                    array('label' => "Approve$badge_ot", 'url' => array('/hrisOtApplication/formyapproval'), 'visible' => Yii::app()->user->getState('access_lvl_id') != HrisAccessLvl::$EMPLOYEE),
                    array('label' => "My Applications", 'url' => array('/hrisOtApplication/admin')),
                ),
            ),
            array('label' => "Leaves <span class='caret'></span>$badge_loa", 'url' => array('#'), 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"), 'visible' => !Yii::app()->user->isGuest,
                'items' => array(
                    array('label' => 'Apply', 'url' => array('/hrisLoaApplication/create')),
                    array('label' => "Approve $badge_loa", 'url' => array('/hrisLoaApplication/formyapproval')),
                    array('label' => 'My Applications', 'url' => array('/hrisLoaApplication/admin')),
                ),
            ),
            array('label' => "Make Up <span class='caret'></span>$badge_mu", 'url' => array('#'), 'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"), 'visible' => !Yii::app()->user->isGuest,
                'items' => array(
                    array('label' => 'Apply', 'url' => array('/hrisMuApplication/create')),
                    array('label' => "Approve $badge_mu", 'url' => array('/hrisMuApplication/formyapproval')),
                    array('label' => 'My Applications', 'url' => array('/hrisMuApplication/admin')),
                ),
            ),
            array('label' => 'Payslip', 'url' => array('/payroll'), 'visible' => !Yii::app()->user->isGuest),
            //array('label'=>'PDS','url'=>array('/empInformation'),'visible'=>(Yii::app()->user->getState('access_lvl_id')==HrisAccessLvl::$HR or Yii::app()->user->getState('access_lvl_id')==HrisAccessLvl::$ADMINISTRATOR)),
            array('label' => 'PDS', 'url' => array('/empInformation'), 'visible' => !Yii::app()->user->isGuest),
            array('label' => 'Timesheet', 'url' => array('/payroll/timesheet'), 'visible' => !Yii::app()->user->isGuest),
            /*
              array('label'=>'Documents<span class="caret"></span>','url'=>array('#'),'visible'=>!Yii::app()->user->isGuest,
              'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
              'items'=>array(
              array('label'=>'New','url'=>array('hrisDocument/create')),
              array('label'=>'List','url'=>array('hrisDocument/admin')),
              array('label'=>'Manage Categories','url'=>array('hrisDocumentCategory/admin'),'visible'=>Yii::app()->user->getState('access_lvl_id')!=HrisAccessLvl::$EMPLOYEE),
              ),
              ),

              array('label'=>'Announcement','url'=>array('admin/hrisAnnouncement/admin'),'visible'=>Yii::app()->user->getState('access_lvl_id')==HrisAccessLvl::$HR or Yii::app()->user->getState('access_lvl_id')==HrisAccessLvl::$ADMINISTRATOR,
              'items'=>array(
              array('label'=>'New','url'=>array('admin/hrisAnnouncement/create')),
              ),
              ),
             */
            array('label' => 'Research<span class="caret"></span>', 'url' => array('#'), 'visible' => (!Yii::app()->user->isGuest and Yii::app()->user->getState('access_lvl_id') != HrisAccessLvl::$EMPLOYEE),
                'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                'items' => array(
                    array('label' => 'Leave of Absence', 'url' => array('/admin/hrisLoaApplicationReport/')),
                    array('label' => 'Overtime', 'url' => array('/admin/hrisOtApplicationReport/')),
                    array('label' => 'Make Up', 'url' => array('/admin/hrisMuApplicationReport/')),
                ),
            ),
            array('label' => 'Manage <span class="caret"></span>',
                'url' => array('#'),
                'itemOptions' => array('class' => 'dropdown', 'tabindex' => "-1"), 'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => "dropdown"),
                'items' => array(
                    array('label' => 'Users', 'url' => array('/admin/hrisUsers')),
                    array('label' => 'Email Queue', 'url' => array('/admin/hrisEmailQueueForForms/admin')),
                ),
                'visible' => Yii::app()->user->getState('access_lvl_id') === '4',
            ),
            array('label' => 'Change Password', 'visible' => !Yii::app()->user->isGuest, 'url' => array('admin/hrisUsers/resetpassword/id/' . Yii::app()->user->getState('emp_id'))),
            array('label' => 'Hello, ' . Yii::app()->user->name . '<small>(Logout)</small>', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
        );
    }

    public static function getBannerFilename($themeRelativeBannerFileName) {
        return self::getThemeUrl() . "/css/" . $themeRelativeBannerFileName;
    }

    public static function displayBanner($fullBannerPath) {
        return
                "<script>
	$('#main-banner').css('background-image',\"url(\'" . $fullBannerPath . "\')\");
	$('#main-banner').show();
</script>";
    }

    public static function topMenuItems() {
        /*
          if(Yii::app()->user->isGuest){
          return array(
          array('label'=>'Acceder','url'=>'index.php?r=site/login'),
          array('label'=>'Registrarse','url'=>'#'),
          array('label'=>'Contactanos','url'=>'#'),
          array('label'=>'Inicio','url'=>'index.php?r=site/index'),
          );
          }
          else{
          return array(
          array('label'=>'Salir','url'=>'index.php?r=site/logout'),
          array('label'=>'Contactanos','url'=>'#'),
          array('label'=>'Inicio','url'=>'index.php?r=site/index'),
          );
          }
         */
        return array();
    }

    public static function footer() {
        ?>
        <div id='footer' >
            <div id='footer-inner'>
                <div class='footer-left'>
        <?php
        $ar = self::getMenuItems();
        foreach ($ar as $menu) {
            echo "<div class='foot-menu-entry'><ul class='footer-menu-ul'>";
            echo "<li class='li-head'><a href='" . $menu['url'] . "'>" . $menu['label'] . "</a></li>";
            if (isset($menu['items'])) {
                echo "<ul class='sublista'>";
                foreach ($menu['items'] as $submenu) {
                    echo "<li><a href='" . $submenu['url'] . "'>" . $submenu['label'] . "</a></li>";
                }
                echo "</ul>";
            }
            echo "</ul></div>";
        }
        ?>
                </div>
            </div>
        </div>
        <div id='sub-footer' >
            <div id='footer-inner'>
                <div class='footer-left'>
                    <img src='themes/yii-theme/css/yii-la--bottom.png' />
                </div>
                <div class='footer-right'>
                    La comunidad de <b>Yii Framework en Espa�ol</b> construye y mantiene este sitio con el esfuerzo
                    de todos los hispanohablantes, bajo el soporte de: <a href='http://www.yiiframework.com'>Yii Framework</a>.
                </div>
            </div>
        </div>
        <?php
    }

}
?>
