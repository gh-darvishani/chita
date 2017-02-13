<?php

import::lib('view');
import::lib('url');
import::lib('csrf');
import::lang('base',lang);
abstract class controller{

    protected $csrf=true;
    protected $layout='base';
    public function __construct()
    {

        $this->init();
        view::$layout=$this->layout;
        if($this->csrf){
          //  $currentUrl=url::currentUrl();

            if(isset($_POST)&&!empty($_POST)) {


                if (!isset($_POST['csrf'])) {
                    Throw new Exception(("csrf code is not found"), 500);

                }

                if (!csrf::isValidate($_POST['csrf'])) {
                    Throw new Exception(("csrf code is invalid"), 500);

                }



            }
        }

    }
    abstract protected function init() ;


    public function setLayout($name){
        $this->layout=$name;
    }
    public function redirect($url){
        header("location:".home_url."/".extra_url.$url);
    }
    public function getMethod(){

            return $_SERVER['REQUEST_METHOD'];

    }
    public function isPost(){
      return  $this->getMethod()=='POST'?true:false;
    }
    public function isGet(){
      return  $this->getMethod()=='GET'?true:false;
    }
    public function isDelete(){
      return  $this->getMethod()=='DELETE'?true:false;
    }
    public function isPut(){
      return  $this->getMethod()=='PUT'?true:false;
    }
    public function post($value=null){
        if($value){
            return $_POST[$value];
        }
        return $_POST;
    }
    public function get($value=null){
        if($value){
            return $_GET[$value];
        }
        return $_GET;
    }
}