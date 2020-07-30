<?php

  require 'config/config.php';
  require 'helpers/session_helper.php';
  require 'helpers/url_helper.php';


  spl_autoload_register(function($classname){
    require_once 'libs/'.$classname.'.php';
  });