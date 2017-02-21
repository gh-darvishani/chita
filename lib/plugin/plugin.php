<?php

namespace lib\plugin;

abstract class plugin
{
    public $plugin_name;
    protected $controller_id;
    public function __construct()
    {
        $this->init();
        $this->plugin_name;
    }
    public abstract function init();
    protected function importFile($plugin_name,$file_name){


        return home_url."/lib/plugin/".$plugin_name."/".$file_name;
    }
}