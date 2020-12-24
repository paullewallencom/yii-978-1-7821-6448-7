<?php
if ($_SERVER['SERVER_NAME']=='photogallery.lan') 
	return array(
	    'connectionString' => 'mysql:host=localhost;dbname=photogallery',
	    'emulatePrepare' => true,
	    'username' => 'photo',
	    'password' => 'photo21',
	    'charset' => 'utf8',
	    'enableParamLogging' => false,
	    'enableProfiling' => false,
	    'schemaCachingDuration'=>120
	);
else
    return array(
	    'connectionString' => 'mysql:host=live-server;dbname=photogallery',
	    'emulatePrepare' => true,
	    'username' => 'username',
	    'password' => 'l2354y14[dnklvch987',
	    'charset' => 'utf8',
	    'enableParamLogging' => false,
	    'enableProfiling' => false,
	    'schemaCachingDuration'=>120
	);
?>
