<?php

// This file contains all the functions that should be present in every controller. 
// Each controller can require this file and use the following functions.

 class Controller
 {
    public function view($viewName, $data = []) 
    {

        if(!empty($data)){
            $data = $this->escapeData($data);
            extract($data);            
        }

        $filename = "../app/views/".$viewName.".view.php";

        if(!file_exists($filename)) {
            $filename = "../app/views/404.view.php";
        }
        require $filename;

    }

    public function component($componentName, $data = [], $configerations = []) 
    {

        if(!empty($data))
            extract($data);

        if(!empty($configerations))
            extract($configerations);

        $filename = "../app/components/".$componentName.".component.php";

        if(file_exists($filename)) {
            require $filename;
        }
    }

    private function escapeData($data) 
    {
        // Recursively escape strings in the data array
        foreach ($data as $key => &$value) {
            if (is_string($value)) {
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            } elseif (is_array($value)) {
                $value = $this->escapeData($value); // Recursively escape arrays
            }
            // Leave other types (e.g., objects, integers) unchanged
        }
        return $data;
    }

    public function saveImage($fileImage, $uploadDir, $newImageName)
    {
        // $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        // $maxSize = 2 * 1024 * 1024;
    
        // if (!in_array($fileImage['type'], $allowedTypes)) {
        //     echo "Only JPG, PNG, and GIF files are allowed.";
        //     exit;
        // }
    
        // if ($fileImage['size'] > $maxSize) {
        //     echo "File size exceeds the limit of 2MB.";
        //     exit;
        // }
    
        $imageFileType = strtolower(pathinfo($fileImage['name'], PATHINFO_EXTENSION));
        $targetFilePath = $uploadDir . $newImageName . '.' . $imageFileType;
    
        if (move_uploaded_file($fileImage['tmp_name'], $targetFilePath)) {
            // echo "Image uploaded successfully to $targetFilePath";
            return $imageFileType;
        } else {
            // echo "Failed to upload image.";
            return false;
        }
    }

    public function deleteImage($imagePath)
    {
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    public function sendNotification($phone, $type, $tite, $body, $link = null, $image = null)
    {
        $socket = stream_socket_client("tcp://localhost:9000", $errno, $errstr, 2);
        if (!$socket) return;

        $data = ['type' => $type, 'title' => $tite, 'body' => $body, 'link' => $link, 'image' => $image];

        $notification = json_encode(["type" => "notification", "id" => $phone, "data" => json_encode($data)]);
        if (!fwrite($socket, $notification)) return;
        
        fread($socket, 1024);
        fclose($socket);
    }
 }