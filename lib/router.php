<?php
namespace lib;
use lib\debug;
use lib\import;
use lib\validate;
 class router{

    public function __construct($mode)
    {
        $get=isset($_GET['url'])?$_GET['url']:'';
        $other=null;
        if(strlen($get)>0){
            $url=explode("/",$get);

            $controllerId=$url[0];
            array_shift($url);

            if(isset($url[0])&&strlen($url[0])>0){
                $action=$url[0]."Action";
                array_shift($url);
            }
            else{
                $action=defaultAction."Action";

            }

            $other =$url;

        }else{
            $controllerId=defaultController;

            $action=defaultAction."Action";

        }
        $params=null;




        for($i=0 ;$i<count($other);$i+=2){

            $params[$other[$i]]=isset($other[$i+1])?$other[$i+1]:null;
        }




        if(!validate::fileExists($controllerId."Controller"))
        {
            debug::e("Controller: ".$controllerId." not found");
        }

        //require base_url.DS.extra_url.'controller'.DS.$class."Controller.php";
      //   import::controller($controllerId);


        $cnt=str_replace('/','\\',extra_url."controller\\".$controllerId."Controller");
         $controller=new  $cnt();
        !validate::methodExists($controller,$action)?debug::e($action." not found"):true ;

        $controller->$action($params);


    }
}