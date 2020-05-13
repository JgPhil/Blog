<?php

namespace App\src\DAO;

use App\Framework\Method;
use App\Framework\DAO;

/**
 * Class PictureDAO
 */
class PictureDAO extends DAO
{
    /**
     * @param mixed $postId
     * 
     * @return void
     */
    public function getPostPicture($postId)
    {

        $sql = 'SELECT path FROM picture WHERE post_id = ?';
        $result = $this->createQuery($sql, [$postId]);
        $picturePath = $result->fetch();
        $result->closeCursor();
        return $picturePath;
    }

    /**
     * @param mixed $path
     * @param mixed $postId
     * 
     * @return void
     */
    public function addPostPicture($path, $postId)
    {
        $sql = 'INSERT INTO picture (path, post_id) VALUES (?, ?)';
        $this->createQuery($sql, [$path, $postId]);
    }

    /**
     * @param mixed $path
     * @param mixed $userId
     * 
     * @return void
     */
    public function addUserPicture($path, $userId)
    {
        $sql = 'INSERT INTO picture (path, user_id) VALUES (?, ?)';
        $this->createQuery($sql, [$path, $userId]);
    }

    /**
     * @param mixed $userId
     * 
     * @return void
     */
    public function getUserPicture($userId)
    {
        $sql = 'SELECT path FROM picture WHERE user_id = ?';
        $result = $this->createQuery($sql, [$userId]);
        $picturePath = $result->fetch();
        $result->closeCursor();
        return $picturePath;
    }

    /**
     * @param mixed $userId
     * 
     * @return void
     */
    public function checkUserPicture($userId)
    {
        $sql = 'SELECT COUNT(user_id) FROM picture WHERE user_id = ?';
        $result = $this->createQuery($sql, [$userId]);
        $pictureExists = $result->fetchColumn();
        return $pictureExists;
    }

    /**
     * @param mixed $postId
     * 
     * @return void
     */
    public function checkPostPicture($postId)
    {
        $sql = 'SELECT COUNT(post_id) FROM picture WHERE post_id = ?';
        $result = $this->createQuery($sql, [$postId]);
        $pictureExists = $result->fetchColumn();
        return $pictureExists;
    }

    /**
     * @param mixed $path
     * @param mixed $userId
     * 
     * @return void
     */
    public function updateUserPicture($path, $userId)
    {
        $sql = 'UPDATE picture SET path = ? WHERE user_id = ?';
        $this->createQuery($sql, [$path, $userId]);
    }

    /**
     * @param mixed $postId
     * @param mixed $path
     * 
     * @return void
     */
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
