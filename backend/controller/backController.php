<?php

 import::lib('view');
import::lib('auth');
import::model('user');
import::controller('main');
class backController extends mainController
{


    public function indexAction(){


        if(isset($_POST) && !empty($_POST)){
            $user=user::find_by_username_and_password($_POST['username'],md5($_POST['password']));

            if($user) {
                auth::setLogin($user);
            }

        }
         view::setView('login');

    }


}