<?php

import::lib('plugin/plugin');
import::lib('url');
import::lang('grid',lang);
class grid extends plugin{


    private $pageSize;
    private $model;
    private $column;
    private $style;

    public function init()
    {


         $this->plugin_name="grid";
        $cn=debug_backtrace();
        $calledBy=substr($cn[2]['class'],0,-10);
        $this->controller_id=$calledBy;
    }
    public function setModel($model){
        import::model($model);

        $this->model=$model;
        return $this;
    }
    public function setColumn(array $column){
        $this->column=$column;
        return $this;
    }
    public function setPageSiz($size=20){
        $this->pageSize=$size;
        return $this;
    }
    public function setStyle($style=''){
        $this->style=$style;
        return $this;
    }
    public function show(){
        echo $this->createTable();
    }
    public function page(){
        $total=count($this->model);
        $page=ceil($total/$this->pageSize);
        $table="<tfoot><tr>";
        for($i=0;$i<$page;$i++){
            $page_url=url::createUrl($this->controller_id.'/index/?page='.$i);
            $table.="<td>
        <a href='".$page_url."'><span>".$i."</span></a>
</td>";
        }
        $table.="</tr></tfoot>";
        return $table;
    }
    private function createTable(){

        $page=0;
        if(isset($_GET['page'])){
            $page=(int)$_GET['page']+1;
        }
        $sort=null;
        if(isset($_GET['sort'])){
            $sort=$_GET['sort'];

        }
        $model=$this->model;


        $this->model=$model::find('all',['limit'=>$this->pageSize,'offset'=>$this->pageSize*$page,'order'=>isset($sort)?$sort:'id desc']);


        $cssLink=$this->importFile('grid','css/style.css');


        $table=' <link rel="stylesheet" href="'.$cssLink.'">';
        $table.='<table class="table table-hover" style="'.$this->style.'"><thead><tr>';
        foreach ($this->column as $key=>$value){
            if($sort!=null &&$sort==$key){
                $sort_url=url::createUrl($this->controller_id.'/index/?sort=-'.$key);
            }else {
                $sort_url = url::createUrl($this->controller_id . '/index/?sort=' . $key);
            }
            $table.='<td><a href="'.$sort_url.'">'.__($value['header']).'</a></td> ';
        }
        $table.="<td>".__('action')."</td>";
        $table.="</tr><thead>";

        foreach ($this->model as $item){
            $table.="<tbody><tr>";
            foreach ($this->column as $key=>$value){
                $css=isset($value['css'])?$value['css']:null;
                $table.="<td style=".$css.">".$item->$key."</td>";
            }
            $delete_url=url::createUrl($this->controller_id.'/delete',['id'=>$item->id]);
            $edit_url=url::createUrl($this->controller_id.'/edit',['id'=>$item->id]);
            $view_url=url::createUrl($this->controller_id.'/view',['id'=>$item->id]);
            $table.="<td>
            <a title='".__("delete")."' href='".$delete_url."'><i class='glyphicon glyphicon-remove'></i></a>
            <a  title='".__("edit")."' href='".$edit_url."'><i class='glyphicon glyphicon-edit'></i></a>
            <a  title='".__("view")."' href='".$view_url."'><i class='glyphicon glyphicon-eye-open'></i></a>
</td>";
            $table.="</tbody></tr>";

        }
        $table.=$this->page();
        $table.="</table>";
        return $table;
    }
}