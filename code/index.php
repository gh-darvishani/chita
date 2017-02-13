<?php
///
session_start();
define('base_url',dirname(__DIR__));
define("base_address","http://" . $_SERVER['SERVER_NAME']);
include_once 'config.php';

$whitelist = array(
    '127.0.0.1',
    '::1'
);
if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)or mode!='developer'){
    throw new Exception("permission deny",403);
}

include_once '../lib/import.php';

$import=import::lib('app');
$app=new app();
$app->run(mode);





//
//include_once 'bin/do.php';
// $config=import::config(['main']);
//
//$app=new app($config);


?>