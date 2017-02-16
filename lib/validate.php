<?php
namespace  lib;
class validate{


    public static function fileExists($fileDir,$type='controller')
    {
       return file_exists(base_url.DS.extra_url.$type.DS.$fileDir.".php");

    }
    public static function viewExists($fileDir,$controllerId='main')
    {

     return file_exists(base_url.DS.extra_url."view".DS.$controllerId.DS.$fileDir.".phtml");

    }
    public static function methodExists($class,$method)
    {
        return method_exists($class,$method);
    }

}