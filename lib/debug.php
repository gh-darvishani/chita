<?php
/**
 * Created by PhpStorm.
 * User: masiha68
 * Date: 2/1/17
 * Time: 1:10 PM
 */
namespace lib;
class debug{



    public function __construct()
    {

    }

    public static function e($msg){

       echo $msg;
        die();
    }
    public static function w($msg){
        echo $msg;
    }
    public static function errorMessage($msg){
        $_SESSION['message'][]=$msg;
    }
    public static function successMessage($msg){
        $_SESSION['message'][]=$msg;
    }
    public static function display(){
        if(isset($_SESSION['message'])) {
            foreach ($_SESSION['message'] as $item) {
                echo $item . "<br>";

            }
            unset($_SESSION['message']);
        }
    }
}