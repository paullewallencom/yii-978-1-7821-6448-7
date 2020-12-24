<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

// change the following paths if necessary
$yii=dirname(__FILE__).'/../../Yii/yii.php';
$config=dirname(__FILE__).'/../protected/config/test.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
require_once( Yii::getPathOfAlias('system.test.CTestCase').'.php' ); // Force the PhpUnit autoload via CTestCase file
require_once(dirname(__FILE__).'/WebTestCase.php');

Yii::createWebApplication($config)->run();
