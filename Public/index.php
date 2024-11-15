<?php

session_start();

require '../App/core/init.php';

DEBUG ? error_reporting(1) : error_reporting(0);

$app = new App; //how we initiate a class
$app->loadController();


// show(splitURL());