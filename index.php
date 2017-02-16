<?php
///
use lib\app;





session_start();

define('base_url',__DIR__);
define("base_address","http://" . $_SERVER['SERVER_NAME']);
define('whereis','frontend');
 include_once 'config.php';
 include_once 'lib/autoLoad.php';
//$import=import::lib('app');
$app=new app();
$app->run();





//
//include_once 'bin/do.php';
// $config=import::config(['main']);
//
//$app=new app($config);


?>