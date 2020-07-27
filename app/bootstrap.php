<?php

  require 'config/config.php';

  spl_autoload_register(function($classname){
    require_once 'libs/'.$classname.'.php';
  });