<?php



session_start();
define('base_url',dirname(__DIR__));
define("base_address","http://" . $_SERVER['SERVER_NAME']);


include_once 'config.php';
include_once '../lib/import.php';

$import=import::lib('app');
$app=new app();
$app->run('backend');

?>