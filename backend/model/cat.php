<?php
namespace backend\model;
use lib\baseModel;

 class cat extends baseModel
{
    static $table_name="cat";
    public static function getArray(){
        $array=[];

        foreach (cat::find('all') as $item){

            $array[$item->id]=$item->name;
        }

        return $array;
    }
}
