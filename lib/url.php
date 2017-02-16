<?php

namespace lib;
class url{
            public static function createUrl($router,array $params=null){
                $url_params="";
                if($params){

                    foreach ($params as $key=>$item){
                        $url_params.="/".$key."/".$item;
                    }

                }
                return home_url."/".extra_url.$router.$url_params;
        }

        public static function currentUrl(){
            return $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        }
}