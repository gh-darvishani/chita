<?php




function __($key){

    $fa= [
        'email'=>'ایمیل',
        'Id'=>'شناسه',
        'Username'=>'نام کاربری',
        'action'=>' کنش ها',
        'view'=>'نمایش',
        'edit'=>'ویرایش',
        'delete'=>'حذف',
    ];
     return isset($fa[$key])?$fa[$key]:$key;
}
?>