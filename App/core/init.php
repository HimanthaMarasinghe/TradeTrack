<?php

// This file is used to require all the core controlers in the core directory,
//   so this file can be required in the index.php. This way, the index.php file becomes simpler.

spl_autoload_register(function($classname)
{
  // echo $classname;
  require '../app/models/'.$classname.'.php';
});

require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';