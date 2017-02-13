<?php

import::lib('debug');
import::lib('validate');
class view
{

    public static $layout;
    public static $globalParams=[];

    public static function setView($fileName,array $params=null){
//        if($params){
//            extract($params);
//        }


        $cn=debug_backtrace();
        $calledBy=substr($cn[1]['class'],0,-10);


        !validate::viewExists($fileName,$calledBy)?debug::e("view : ".$fileName." not found"):true;
        !validate::viewExists("main","template".DS.self::$layout)?debug::e(self::$layout." template not found"):true;
        $params['content']= base_url.DS.extra_url."view".DS.$calledBy.DS.$fileName.".phtml";

        import::template(self::$layout,$params,self::$globalParams);

    }
    public static function setGlobalParams($params){
        self::$globalParams=$params;
    }
    public static function getTemplateView($fileName,array $params=[]){
        extract($params);
        return base_url.DS.extra_url."view".DS."template".DS.$fileName.".phtml";

    }
}