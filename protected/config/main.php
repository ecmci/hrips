<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'ECMCI HR Information and Payroll System (HRIPS)',
	'theme'=>'abound',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.giix-components.*', // giix components
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'otextraction',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
			'generatorPaths' => array(
				'ext.giix-core', // giix generators
			),
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','192.168.1.48'),
			//'db'=>'tcdb',
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class' => 'WebUser',
			'authTimeout'=>'28800' //logout user after x seconds of inactivity
		),
    
    // session time limit
    /*
    'session'=>array(
      'class' => 'CDbHttpSession',
      'timeout'=>'28800', //end session after x seconds
    ),
    */
		// uncomment the following to enable URLs in path-format
		'format'=>array(
		  'class'=>'application.components.Formatter',
		),
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=evacare',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'admin1937',
			'charset' => 'utf8',
                        'enableParamLogging' => true,
		),
		
		'tcdb'=>array(		
			'class'=>'CDbConnection',
			//'connectionString' => 'sqlsrv:Server=localhost\TIMECLOCKPLUS,1433;Database=TimeClockPlus',//dev
			//'connectionString' => 'sqlsrv:Server=192.168.1.222\TIMECLOCKPLUS,1433;Database=TimeClockPlus', //prod via windows
			'connectionString' => 'dblib:host=192.168.1.222;dbname=TimeClockPlus', //prod via linux system
			'username' => 'hris',
			'password' => 'hris5524',
			'charset' => 'utf8',
			//'emulatePrepare' => false,
		),
                
                 
    /*
    'sp'=>array(
       'class'=>'CDbConnection',
			 'connectionString' => 'sqlite:c:/Program Files/Spiceworks/db/spiceworks_prod.db',       
		),*/
	
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'info',
					'categories'=>'app',
					'logFile'=>'admin_log.txt',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
					'levels'=>'error, warning, info, notice, trace',
				),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'noreply'=>'noreply@ecmci.com',
		'adminEmail'=>'steven.l@evacare.com',
		'dateFormat'=>'j-M-Y g:i A',
                //'spiceworksDSN'=>'sqlite:c:/Program Files/Spiceworks/db/spiceworks_prod.db;version=2',
	),
);
