<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'runtimePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR."runtime",
        'name'=>'Photo Gallery',
 
	'defaultController' => 'Album',
  
	// preloading 'log' component
	'preload'=>array('log'),
        'theme'=>'photoGal',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*'
	),
        'aliases' => array(
            'xupload' => 'ext.xupload'
        ),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'photo21',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		        'class' => 'WebUser', 
		),
		// uncomment the following to enable URLs in path-format
		'image'=>array(
                    'class'=>'application.extensions.image.CImageComponent',
                     // GD or ImageMagick
                    'driver'=>'GD',
                    // ImageMagick setup path
                    //'params'=>array('directory'=>'e:\ProgramFiles\ImageMagick-6.6.3-Q16'),
                ),		
		'urlManager'=>array(
                    'urlFormat' => 'path',
                    'showScriptName' => false,
                    'rules' => array(               
                        '<controller:\w+>/<id:\d+>' => '<controller>/view',
                        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    ),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
                 * */
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=photogallery',
			'emulatePrepare' => true,
			'username' => 'photo',
			'password' => 'photo21',
			'charset' => 'utf8',
                	'enableParamLogging' => true,
                        'enableProfiling' => true,
             
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
				    'class'=>'CFileLogRoute',
				    'levels'=>'error, warning, trace',
				    'categories'=>'!application.site.*',
				),
				/**array(
				    'class'=>'CWebLogRoute',
				    'levels'=>'error, warning, info, trace',
				    //'categories'=>'system.db.*'
				    //'showInFireBug'=>true
			        ),**/
				array(
				    'class'=>'CFileLogRoute',
				    'levels'=>'info',
				    'logFile'=>'application_site.log',
				    'categories'=>'application.site.*',
				),
				array(
				    'class'=>'CEmailLogRoute',
				    'levels'=>'info',
				    'categories'=>'application.site.*',
				    'emails'=>'chris@example.com'
				),
				/**array(
				    'class'=>'CProfileLogRoute',
				    'report'=>'summary' //'callstack',
				),**/
				array(
				    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute', 
				    'ipFilters'=>array('127.0.0.1','192.168.1.101'),
				),
				array(
				    'class' => 'ext.phpconsole.PhpConsoleYiiExtension',
				    'handleErrors' => true,
				    'handleExceptions' => false,
				    'basePathToStrip' => dirname($_SERVER['DOCUMENT_ROOT'])
				)
			    ),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
                'uploads'=>'/uploads',  
		'thumbSize'=>200,
           ),
);