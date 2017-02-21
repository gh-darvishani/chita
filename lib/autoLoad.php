<?php


function __autoload($class)
{


    $parts = explode('\\', $class);
    $file=base_url.DS.str_replace('\\','/',$class) . '.php';
    if(file_exists($file)){
        require  base_url.DS.str_replace('\\','/',$class) . '.php';
    }else {
        include_once base_url.DS.'vendor/autoload.php';
    }
}

