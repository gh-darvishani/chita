<?php


use lib\app;

session_start();
define('base_url',dirname(__DIR__));
define("base_address","http://" . $_SERVER['SERVER_NAME']);


include_once 'config.php';
include_once '../lib/autoLoad.php';

$app=new app();
$app->run('backend');

?>