<?php

function d2l($what,$where='fb.somewhere'){
    $what=print_r($what,true);
    Yii::log($what, 'info', 'application.'.$where);
}


// change the following paths if necessary
$yiit=dirname(__FILE__).'/../../../yii/yiit.php';
$config=dirname(__FILE__).'/../config/test.php';

require_once($yiit);
require_once( Yii::getPathOfAlias('system.test.CTestCase').'.php' );
require_once(dirname(__FILE__).'/WebTestCase.php');

Yii::createWebApplication($config);
