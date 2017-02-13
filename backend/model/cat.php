<?php

 import::lib('model');
class cat extends model
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