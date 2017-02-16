<?php
namespace backend\controller;
/**
 * Created by PhpStorm.
 * User: masiha68
 * Date: 2/2/17
 * Time: 2:42 PM
 */

use backend\controller\mainController;
use backend\model\cat;
use backend\model\post;
use lib\auth;
use lib\debug;
use lib\plugin\grid\grid;
use lib\view;
use lib\import;
// import::lib('view');
//import::plugin('grid','grid');
//import::plugin('auth','auth');
//import::model('post');
//import::model('cat');
//import::lib('debug');

class postController extends mainController
{

    public function init()
    {
        $this->setLayout('post');

    }

    public function indexAction(){

        $params['title']='manage post';

        $column=[
            'title'=>['header'=>'Title',

                        ],
            'time'=>['header'=>'Time Create',

                        ],
            'id'=>['header'=>'Id',

                        ],


        ];
        $style="width:100%;";

        $grid=new grid();
        $grid->setModel('post')->setPageSiz(20)->setColumn($column)->setStyle($style);

        $params['grid']=$grid;
        view::setView('index',$params);
    }

    public function createAction(){
        $params['title']="create post";
        $params['cat']=cat::getArray();
        $user=new auth();
        if($this->isPost()){
            $model=new post();
            $model->title=$this->post('title');
            $model->body=$this->post('body');
            $model->cat_id=$this->post('cat');
            $model->user_id=1;//$user->getId();

            $model->time=time();
            if($model->save()){
                debug::successMessage('post created');
            $this->redirect('post/index');
            }
            var_dump($model->errors);


        }

        view::setView('create',$params);
    }


    public function deleteAction($params){
        $this->loadModel($params['id'])->delete();
        $this->redirect('post/index');
    }
    private function loadModel($id){
        try{
            $model= post::find($id);

        }catch (Exception $e){
            print_r($e);
            debug::errorMessage('model not found');
            $this->redirect("post/index");
        }
        return $model;


    }


}