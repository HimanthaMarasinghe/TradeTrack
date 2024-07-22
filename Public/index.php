<?php

session_start();

require '../App/core/init.php';

$app = new App;
$app->loadController();


// show(splitURL());