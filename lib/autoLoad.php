<?php

function __autoload($class)
{

    echo $class."<br>";
    $parts = explode('\\', $class);
    require  base_url.DS.str_replace('\\','/',$class) . '.php';
}