<?php

import::lib('controller');
import::lib('view');
class mainController extends controller{



    protected function init()
    {
    }

    public function indexAction(){
        $params['title']="page title";
        view::setView('index',$params);
    }
}