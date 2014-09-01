<?php

return array(
    // This path may be different. You can probably get it from `config/main.php`.
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'HR Forms-CronJobs',
 
    'preload'=>array('log'),
 
    'import'=>array(
        'application.components.*',
        'application.models.*',
        'ext.giix-components.*', // giix components
    ),
    // We'll log cron messages to the separate files
    'components'=>array(
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron.log',
                    'levels'=>'error, warning, info',
                ),
            ),
        ),
 
        // Your DB connection
        'db'=>array(
    			'connectionString' => 'mysql:host=localhost;dbname=evacare',
    			'emulatePrepare' => true,
    			'username' => 'hris',
    			'password' => 'hris5524',
    			'charset' => 'utf8',
    		),
    		
    		'tcdb'=>array(		
    			'class'=>'CDbConnection',
    			//'connectionString' => 'sqlsrv:Server=localhost\TIMECLOCKPLUS,1433;Database=TimeClockPlus',
				'connectionString' => 'sqlsrv:Server=192.168.1.222\TIMECLOCKPLUS,1433;Database=TimeClockPlus',
    			'username' => 'hris',
    			'password' => 'hris5524',
    			'charset' => 'utf8',
    			//'emulatePrepare' => false,
    		),
    ),
);
