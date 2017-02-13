<?php
import::lib('validate');
import::lib('debug');
class import{
            public static function lib($class){
                include_once base_url.'/lib/'.$class.".php";

        }
   public static function lang($class,$lang){
               $value= include_once base_url.DS.'lib'.DS."lang".DS.$lang.DS.$class.".php";

        }


        public static function model($class){

            include_once base_url.DS.extra_url.'model'.DS.$class.".php";

        }
        public static function plugin($class,$plugin){


            if(file_exists(base_url.DS."plugin".DS.$plugin.DS.$class.".php"))
            {
                include_once base_url.DS."plugin".DS.$plugin.DS.$class.".php";
                return;
            }
             if(file_exists(base_url.DS.'lib'.DS."plugin".DS.$plugin.DS.$class.".php"))
            {
              include_once base_url.DS.'lib'.DS."plugin".DS.$plugin.DS.$class.".php";
                return;
            }
            debug::e($class. "plugin not found ");



        }
        public static function skin($file,$type){

        return home_url.DS.extra_url.'skin'.DS.$type.DS.$file;

    }



        public static function controller($class){
                 require base_url.DS.extra_url.'controller'.DS.$class."Controller.php";
        }
        //public static function view($class){
        //         require base_url.'/controller/'.$class.".php";
        //}
        public static function template($layout,array $params,array $globalParams=null){
                    extract($params);
                    extract($globalParams);
                 require base_url.DS.extra_url."view".DS."template".DS.$layout.DS."main.phtml";
        }
        public static function fileWithUrl($file){
            return home_url.$file;
        }

}