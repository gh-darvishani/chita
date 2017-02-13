<?php

import::lib('plugin/plugin');
import::plugin('autoload','auth');
import::lib('debug');
import::lib('model');
class auth extends plugin{

     public function init()
    {


        $user = new ptejada\uFlex\User();

        // Add database credentials
        $user->config->database->host = dbhost;
        $user->config->database->user = dbuser;
        $user->config->database->password = dbpassword;
        $user->config->database->name = dbname; //Database name

       $auth= $user->start();

        return $auth;
    }

    public   function signup($username,$email,$password,$password2,$first_name='',$last_name='',$group='',$website=''){

           $value=[
               'Username'=>$username,
               'Email'=>$email,
             //  'first_name'=>$first_name,
             //  'last_name'=>$last_name,
               'Password'=>$password,
               'Password2'=>$password2,
             //  'website'=>$website,
               'GroupID'=>$group,
           ];
        //    $input->filter('Username', 'first_name', 'last_name', 'Email', 'Password', 'Password2', 'website', 'GroupID');

        $reg= $this->init();
       $do= $reg->register($value);
        if($do){
            debug::successMessage('User Registered Successfully. You may login now!');
        }else
        {
            debug::errorMessage(json_encode($reg->log->getErrors()));

        }
//            echo json_encode(
//                array(
//                    'error'   => $user->log->getErrors(),
//                    'confirm' => 'User Registered Successfully. You may login now!',
//                    'form'    => $user->log->getFormErrors(),
//                )
//            );

    }
    public   function login($username,$password,$autologin=false){

        $user=$this->init();
        $user->login($username,$password,$autologin);



        if($user->log->hasError()){
            debug::errorMessage(json_encode($user->log->getErrors()));
        }else{
            debug::successMessage( "You are now login as ".$user->Username);

        }


    }
    //rest password
    function restPassword($email){
        if(count($_POST)){


            $res = $this->init();
            $res->resetPassword(['Email'=>$res]);

            $errorMessage = '';
            $confirmMessage = '';

            if($res){


                $url = 'account/update/password?c=' . $res->Confirmation;
             return   $confirmMessage = "Use the link below to change your password <a href='{$url}'>Change Password</a>";

            }else{
               debug::errorMessage($res->log->getErrors());
            }


        }
    }


    public   function logout()
    {
        $this->init()->logout();
    }
    public   function isLogin()
    {
        //$user->isSigned()
       return $this->init()->isSigned();
    }
    public function getUsername(){
        return $this->init()->Username;
    }
    public function getEmail(){
        return $this->init()->Email;
    }
public function getId(){
        return $this->init()->ID;
    }


public function getLastLogin(){
        return $this->init()->LastLogin;
    }



        }