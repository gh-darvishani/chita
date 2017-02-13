<?php

import::lib('controller');
import::lib('view');

class indexController extends controller
{
    public function init()
    {
        $this->csrf=false;
       $this->layout='code';
    }
    public function indexAction(){

        $params['title']="code generator";
        view::setView('index',$params);
    }
    public function modelAction(){

        $params['title']="mode generator";
        if(isset($_POST)&&!empty($_POST))
        {


            $filename=base_url.DS.$_POST['module'].DS."model".DS;


            $content='<?php

 import::lib(\'model\');
class '.$_POST['model'].' extends model
{
    static $table_name="'.$_POST['table'].'";
}';
            $file =$filename.$_POST['model'].".php";
            $this->file_force_contents($file,$content);
            chmod($filename,0777);
            chmod($file,0777);

        }


        view::setView('model',$params);
    }
    public function controllerAction(){

        $params['title']="controller generator";
        if(isset($_POST)&&!empty($_POST))
        {


            $filename=base_url.DS.$_POST['module'].DS."controller".DS;


            $content='<?php

import::lib(\'controller\');
import::lib(\'view\');
class '.$_POST['controller'].'Controller extends controller{



    protected function init()
    {
    }

    public function indexAction(){
        $params[\'title\']="page title";
        view::setView(\'index\',$params);
    }
}';
            $file =$filename.$_POST['controller']."Controller.php";
            $this->file_force_contents($file,$content);
            chmod($filename,0777);
            chmod($file,0777);
            //create view file
            $filename=base_url.DS.$_POST['module'].DS."view".DS.$_POST['controller'].DS;
            $content="this is for test you can change and append your code";
            $file =$filename."index.phtml";
            $this->file_force_contents($file,$content);
            chmod($filename,0777);
            chmod($file,0777);
        }


        view::setView('controller',$params);
    }
    function file_force_contents($dir, $contents){
        $parts = explode('/', $dir);
        $file = array_pop($parts);
        $dir = '';
        foreach($parts as $part)

            if(!is_dir($dir .= "/$part")) mkdir($dir,0777,true);


        file_put_contents("$dir/$file", $contents);

    }
}