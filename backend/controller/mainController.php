<?php

namespace backend\controller;

use lib\controller;
use lib\view;

class mainController extends controller{



    protected function init()
    {
    }

    public function indexAction(){
        $params['title']="page title";
        view::setView('index',$params);
    }
}