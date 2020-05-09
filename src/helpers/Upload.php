<?php

namespace App\src\helpers;

class Upload
{

    public static function uploadFile($target) //uploadPicture
    {
        $target_dir = $target === "user" ? USER_PICTURE : BLOG_PICTURE;

        $picture = $_FILES['userfile'];
        // $target_dir = BLOG_PICTURE;
        $target_file = $target_dir . basename($picture["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
        // Check if image file is a actual image or fake image
        if (isset($picture)) {
            $check = getimagesize($picture["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "Ce n'est pas une image";
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            chmod($target_file, 0755);
            unlink($target_file);
        }

        // Check file size
        if ($picture["size"] > 500000) {
            echo "Le fichier est trop gros";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, $allowedExt)) {
            echo "Seules les images JPG, JPEG, PNG ou GIF sont acceptées.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return "Désolé, le fichier n'a pas été téléchargé";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($picture["tmp_name"], $target_file)) {
                $path = basename($picture["name"]);
                return $path;
            } else {
                return "Désolé, le fichier n'a pas été téléchargé";
            }
        }
    }
    /*
    public static function uploadPictureUser()
    {
        $picture = $_FILES['userfile'];
        $target_dir = USER_PICTURE;
        $target_file = $target_dir . basename($picture["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
        // Check if image file is a actual image or fake image
        if (isset($picture)) {
            $check = getimagesize($picture["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "Ce n'est pas une image";
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) { 
            chmod($target_file, 0755);
            unlink($target_file);
        }

        if ($picture["size"] > 500000) {
            echo "Le fichier est trop gros";
            $uploadOk = 0;
        }

        if (!in_array($imageFileType, $allowedExt)) {
            echo "Seules les images JPG, JPEG, PNG ou GIF sont acceptées.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return "Désolé, le fichier n'a pas été téléchargé";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($picture["tmp_name"], $target_file)) {
                $path = basename($picture["name"]);
                return $path;
            } else {
                return "Désolé, le fichier n'a pas été téléchargé";
            }
        }
    }
    */
}
