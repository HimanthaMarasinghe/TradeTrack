<?php

class ImageUploader {

    private $baseDir = "./images/";

    /**
     * Upload an image to the server
     * @param mixed $fileVar name of the file input
     * @param mixed $newName new name of the image
     * @param mixed $saveLocation path of the directory, the picture should get saved in. Relative to the 'Public/images' folder.
     * @return mixed extension of the image if success. else false.
     */
    public function upload($fileVar, $newName, $saveLocation) {
        if (isset($_FILES[$fileVar]) && $_FILES[$fileVar]["error"] == 0) {
            $file = $_FILES[$fileVar];
            $extension = pathinfo($file["name"], PATHINFO_EXTENSION);
            $targetPath = $this->baseDir . $saveLocation . "/" . $newName . "." . $extension;
            if (move_uploaded_file($file["tmp_name"], $targetPath)) return $extension;
        }
        writeToFile($_FILES[$fileVar]["error"]);
        return false;
    }
    public function removeImage($fileAddress) {
        if (file_exists($this->baseDir . $fileAddress)) {
            unlink($fileAddress);
            return true;
        }
        return false;
    }
}