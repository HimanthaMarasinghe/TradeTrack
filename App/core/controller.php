<!-- This file contains all the functions that should be present in every controller. 
 Each controller can require this file and use the following functions. -->

 <?php

 class Controller
 {
    public function view($name) 
    {
        $filename = "../app/views/".$name.".view.php";

        if(!file_exists($filename)) {
            $filename = "../app/views/404.view.php";
        }
        require $filename;

    }
 }