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

function writeToFile($content, $title = null, $filename = "log.txt") {
    $file = fopen($filename, "a"); // Open file in append mode
    $content = json_encode($content); // Convert content to JSON
    if ($file) {
        $timestamp = date("Y-m-d H:i:s"); // Get current timestamp
        fwrite($file, $timestamp . " : "); // Write timestamp to file
        if ($title) {
            fwrite($file, $title . " : "); // Write title to file
        }
        fwrite($file, $content . PHP_EOL); // Write content with a new line
        fclose($file);
        return true; // Success
    }
    return false; // Failed to open file
}