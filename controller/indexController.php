<?php

/**
 * Created by PhpStorm.
 * User: masiha68
 * Date: 2/1/17
 * Time: 12:27 PM
 */
import::lib('controller');
import::lib('view');
import::model('user');
class indexController extends controller
{


    public function indexAction(){

        $params['title']="sdadsa";
//        $user=new user();
//        $user->username="masiha68";
//        $user->password=md5('3362893');
//        $user->email="why_god88@yahoo.com";
//        $user->time_create=time();
//        if($user->save()){
//            echo "user created";
//        }


        view::setView('home',$params);
    }


    protected function init()
    {
       $this->setLayout('base');
    }
}