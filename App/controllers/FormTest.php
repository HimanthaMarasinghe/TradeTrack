<?php

class FormTest extends Controller
{
    public function index()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            foreach ($_POST as $name => $value) {
                echo htmlspecialchars($name) . " : " . htmlspecialchars($value) . "<br><br>";
            }
        }
        else
        {
            echo "Use POST method";
        }
    }
}