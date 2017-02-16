<?php
namespace lib;




//import::lib('validate');
//import::lib('router');
//import::lib('debug');
//import::lib('url');
//import::lib('csrf');



class app
{


    function __construct()
    {

    }
    public function run($mode='')
    {
        new router($mode);

    }
    public static function url(){
            return new url();
    }
    public static function csrf(){
            return new csrf();
    }

}