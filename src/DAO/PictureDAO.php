<?php

namespace App\src\DAO;

use App\Framework\Method;
use App\Framework\DAO;

class PictureDAO extends DAO
{
    public function getPostPicture($postId)
    {

        $sql = 'SELECT path FROM picture WHERE post_id = ?';
        $result = $this->createQuery($sql, [$postId]);
        $picturePath = $result->fetch();
        $result->closeCursor();
        return $picturePath;
    }

    public function addPostPicture($path, $postId)
    {
        $sql = 'INSERT INTO picture (path, post_id) VALUES (?, ?)';
        $this->createQuery($sql, [$path, $postId]);
    }

    public function addUserPicture($path, $userId)
    {
        $sql = 'INSERT INTO picture (path, user_id) VALUES (?, ?)';
        $this->createQuery($sql, [$path, $userId]);
    }

    public function getUserPicture($userId)
    {
        $sql = 'SELECT path FROM picture WHERE user_id = ?';
        $result = $this->createQuery($sql, [$userId]);
        $picturePath = $result->fetch();
        $result->closeCursor();
        return $picturePath;
    }

    public function checkUserPicture($userId)
    {
        $sql = 'SELECT COUNT(user_id) FROM picture WHERE user_id = ?';
        $result = $this->createQuery($sql, [$userId]);
        $pictureExists = $result->fetchColumn();
        return $pictureExists;
    }

    public function checkPostPicture($postId)
    {
        $sql = 'SELECT COUNT(post_id) FROM picture WHERE post_id = ?';
        $result = $this->createQuery($sql, [$postId]);
        $pictureExists = $result->fetchColumn();
        return $pictureExists;
    }

    public function updateUserPicture($path, $userId)
    {
        $sql = 'UPDATE picture SET path = ? WHERE user_id = ?';
        $this->createQuery($sql, [$path, $userId]);
    }

    public function updatePostPicture($postId, $path)
    {
        $checkPostPicture = $this->checkPostPicture($postId);
        if ($checkPostPicture) {
            $sql = 'UPDATE picture SET path = ? WHERE post_id = ?';
            $this->createQuery($sql, [$path, $postId]);
        } else {
            $this->addPostPicture($path, $postId);
        }
    }
}
