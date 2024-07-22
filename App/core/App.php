<?php

class App 
{

    // Default controller and method
    private $controller = 'Home';
    private $method     = 'index';

    private function splitURL() 
    {
        $URL = isset($_GET['url']) ? $_GET['url'] : 'home';
        $URL = explode("/", $URL);
        return $URL;
    }
    
    public function loadController() 
    {
        $URL = $this->splitURL();
        $filename = "../app/controllers/".ucfirst($URL[0]).".php";
        if(file_exists($filename))
        {
            $this->controller = ucfirst($URL[0]);
        }
        else
        {
            $filename = "../app/controllers/_404.php";
            $this->controller = '_404';
        }
        require $filename;

        $controller = new $this->controller;
        call_user_func_array([$controller, $this->method], []);
    }
}
