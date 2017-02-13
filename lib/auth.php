<?php

class auth{



    public   static function setLogin($user){
        //create session login
        session_start();
        $_SESSION['user']['username']=$user->username;
        $_SESSION['user']['id']=$user->id;
        $_SESSION['user']['email']=$user->email;

    }
    public static function checkLogin(){
        return isset($_SESSION['user']);
    }
    public function logout(){
        unset($_SESSION['user']);
    }

}