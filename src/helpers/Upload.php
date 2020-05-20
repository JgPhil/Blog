<?php

namespace App\src\helpers;

/**
 * Class Upload
 */
class Upload
{

    /**
     * @param mixed $target
     * 
     * @return void
     */
    public static function uploadFile($target) //uploadPicture
    {
        $target_dir = $target === "user" ? USER_PICTURE : POST_PICTURE;
        $picture = $_FILES['userfile'];
        $target_file = $target_dir . basename($picture["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

        if (!empty($picture['name'])) {
            if (file_exists($target_file)) {
                chmod($target_file, 0755);
                unlink($target_file);
            }

            if ($picture["size"] > 1000000) {
                $uploadOk = 0;
            }

            if (!in_array($imageFileType, $allowedExt)) {
                $uploadOk = 0;
            } else {
                if ($uploadOk !== 0) {
                    if (move_uploaded_file($picture["tmp_name"], $target_file)) {
                        $name = basename($picture["name"]);
                        return $name;
                    }
                }   
            }
        }
    }
}
