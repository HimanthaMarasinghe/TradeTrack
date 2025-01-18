<?php

class Debug extends Controller
{
    public function index()
    {
        $methods = array_diff(get_class_methods($this), get_class_methods('Controller'));
        unset($methods[array_search('index', $methods)]);
        $output = "Folowing links are available:<br>";
        foreach ($methods as $method) {
            if ($method != '__construct') {
                $output .= "<a href='" . LINKROOT . "/debug/$method'>$method</a><br>";
            }
        }
        echo $output;
    }

    public function showSession()
    {
        echo "<a href='" . LINKROOT . "/debug'>Back</a><br>";
        show($_SESSION);
    }
}