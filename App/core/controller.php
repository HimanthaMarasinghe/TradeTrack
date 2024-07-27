<!-- This file contains all the functions that should be present in every controller. 
 Each controller can require this file and use the following functions. -->

 <?php

 class Controller
 {
    public function view($viewName, $data = []) 
    {

        if(!empty($data))
            extract($data);

        $filename = "../app/views/".$viewName.".view.php";

        if(!file_exists($filename)) {
            $filename = "../app/views/404.view.php";
        }
        require $filename;

    }

    public function component($componentName, $data = []) 
    {

        if(!empty($data))
            extract($data);

        $filename = "../app/components/".$componentName.".component.php";

        if(file_exists($filename)) {
            require $filename;
        }
    }
 }