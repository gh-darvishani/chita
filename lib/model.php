<?php

import::lib('ActiveRecord');

/* $connections = array(
 2   'development' => 'mysql://username:password@localhost/development',
 3   'production' => 'mysql://username:password@localhost/production',
 4   'test' => 'mysql://username:password@localhost/test'
 5 );
*/
ActiveRecord\Config::initialize(function($cfg)
  {
       $cfg->set_model_directory(base_url.DS."model");
   $cfg->set_connections(array('development' =>
              'mysql://'.dbuser.':'.dbpassword.'@'.dbhost.'/'.dbname.';charset=utf8;'));
  });
 //    'development' => 'mysql://user:pass@localhost/mydb?charset=utf8')
class model extends ActiveRecord\Model{




}