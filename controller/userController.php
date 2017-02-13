<?php

import::lib('controller');
import::lib('view');
import::plugin('auth','auth');
class userController extends controller
{

    private   $user;

    protected function init()
    {
        $this->csrf=false;
        $this->setLayout('blank');
        $this->user= new auth();

    }

     public function loginAction()
    {
        if($this->user->isLogin()){


            debug::successMessage("you are login as ".$this->user->getUsername());
        }
        if(isset($_POST) &&!empty($_POST)){

            $this->user->login($_POST['username'],$_POST['password'],true);
        }
        $params['title']="login page";
        view::setView('login',$params);
    }

    public function signupAction(){
        if(isset($_POST) &&!empty($_POST)){
            $auth=new auth();

           $auth->signup($_POST['username'],$_POST['email'],$_POST['password'],$_POST['repassword']);

        }
        $params['title']='sign up page';
        view::setView('signup',$params);
    }
    public function formAction(){
        $params['title']="asdsa";
        view::setView('form',$params);
    }
}