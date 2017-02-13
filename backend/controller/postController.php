<?php
/**
 * Created by PhpStorm.
 * User: masiha68
 * Date: 2/2/17
 * Time: 2:42 PM
 */
import::controller('main');
import::lib('view');
import::plugin('grid','grid');
import::model('post');
import::model('cat');
import::lib('debug');
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