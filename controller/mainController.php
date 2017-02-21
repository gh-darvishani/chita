<?php
/**
 * Created by PhpStorm.
 * User: masiha68
 * Date: 1/31/17
 * Time: 9:03 PM
 */

namespace controller;


use lib\controller;
use lib\view;

class mainController extends controller
{




    public function indexAction($params){
        $params['title']="sdadsa";
        $params['menu']=[

        ['name'=>'ali',],
        ['name'=>'ali2',],
        ['name'=>'ali3',],

        ];
    view::setView('hello',$params);
    }

    protected function init()
    {
        $this->setLayout('base');
     }
}