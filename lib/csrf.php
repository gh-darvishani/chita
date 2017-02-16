<?php

namespace lib;
import::lib('url');

class csrf
{
    public static function create($prefix='chita'){
        $url=url::currentUrl();
        if(isset($_SESSION['csrf'][$url])){
            return $_SESSION['csrf'][$url];
        }
        $value= md5(rand(9,99999).uniqid($prefix));

        $_SESSION['csrf'][$url]=$value;
        return $value;
    }
    public static function isValidate($value){

        $url=url::currentUrl();
        if(!isset($_SESSION['csrf'][$url])){
            return false;
        }

        if($_SESSION['csrf'][$url]==$value)
        {

            unset($_SESSION['csrf'][$url]);
            return true;
        }
        return false;
    }

}