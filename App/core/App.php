<?php

class App 
{

    // Default controller and method
    private $controller = 'Home';
    private $method     = 'index';

    private function splitURL() 
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", rtrim($URL, "/"));
        return $URL;
    }
    
    public function loadController() 
    {
        $URL = $this->splitURL();

        //Select controller
        $filename = "../app/controllers/".ucfirst($URL[0]).".php";
        if(file_exists($filename))
        {
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);
        }
        else
        {
            $filename = "../app/controllers/_404.php";
            $this->controller = '_404';
        }
        require $filename;

        $controller = new $this->controller;

        //Select method
        if (!empty($URL[1]) && method_exists($controller, $URL[1]) && (new ReflectionMethod($controller, $URL[1]))->isPublic())
        {
            $this->method = $URL[1];
            unset($URL[1]);
        }

        // show($URL);

        call_user_func_array([$controller, $this->method], $URL);
    }
}
