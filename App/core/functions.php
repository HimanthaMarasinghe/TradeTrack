<?php 


function show($stuff) 
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function esc($str)
{
    return htmlspecialchars($str);
}

function redirect($path)
{
    header("Location: ".LINKROOT."/". $path);
    die;
}

function jsonPostDecode()
{
    return json_decode(file_get_contents('php://input'), true);
}