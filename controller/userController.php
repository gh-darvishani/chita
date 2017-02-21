<?php
namespace controller;


 use lib\controller;
use lib\debug;
 use lib\plugin\auth\auth;
 use lib\view;
 use Monolog\Handler\StreamHandler;
 use Monolog\Logger;

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

        $log = new  Logger('name');
        $log->pushHandler(new  StreamHandler('app.log', Logger::WARNING));
        $log->addWarning('Foo');

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