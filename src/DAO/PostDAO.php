<?php

namespace App\src\DAO;

use App\Framework\Method;
use App\src\model\Post;
use App\Framework\DAO;

class PostDAO extends DAO
{
    public function getPosts()
    {
        $sql = 'SELECT post.id, post.title, post.content, post.heading, user.pseudo as author, 
        DATE_FORMAT(post.createdAt, "%d/%m/%Y à %H:%i") AS createdAt FROM post 
        INNER JOIN user ON post.user_id=user.id ORDER BY post.id DESC';
        $result = $this->createQuery($sql);
        $posts = []; // array
        foreach ($result as $row){
            $postId = $row['id'];
            $posts[$postId] = $this->buildObject($row); //conversion par la method buildObject
        }
        $result->closeCursor();
        return $posts; //object
    }

    public function getPost($postId)
    {
        $sql = 'SELECT post.id, post.title, post.content, post.heading, user.pseudo as author,
        DATE_FORMAT(post.createdAt, "%d/%m/%Y à %H:%i") AS createdAt FROM post
        INNER JOIN user ON post.user_id=user.id WHERE post.id = ?';
        $result = $this->createQuery($sql, [$postId]);
        $post = $result->fetch(); //array
        $result->closeCursor();
        return $this->buildObject($post); //object
    }

    public function addPost(Method $postMethod, $userId)
    { 
        $sql = 'INSERT INTO post (title, content, heading, user_id, createdAt) VALUES (?, ?, ?, ?, NOW())';
        $this->createQuery($sql,[ 
        $postMethod->getParameter('title'), 
        $postMethod->getParameter('content'),
        $postMethod->getParameter('heading'), 
        $userId
        ]);

    }

    public function editPost(Method $postMethod, $postId, $userId)
    {
        $sql = 'UPDATE post SET title=:title, heading=:heading, content=:content, user_id=:user_id WHERE id=:postId';
        $this->createQuery($sql, [
            'title' => $postMethod->getParameter('title'),
            'heading' => $postMethod->getParameter('heading'),
            'content' => $postMethod->getParameter('content'),
            'user_id' => $userId,
            'postId' => $postId
        ]);
    }

    public function deletePost($postId)
    {
        $sql = 'DELETE FROM comment  WHERE post_id = ?';
        $this->createQuery($sql,[$postId]);
        $sql = 'DELETE FROM post WHERE id = ?';
        $this->createQuery($sql,[$postId]);
    }

    public function getUserFromPost($postId)
    {
        $sql = 
        'SELECT user.id, user.pseudo, role.name AS role, 
        DATE_FORMAT(user.createdAt, "%d/%m/%Y à %H:%i")AS createdAt
        FROM post 
        INNER JOIN user on user.id=post.user_id
        INNER JOIN role on role.id=user.role_id
        WHERE post.id = ?';
        $result = $this->createQuery($sql, [$postId]);
        $row = $result->fetch(); //array
        $result->closeCursor();
        $user = new UserDAO;
        return  $user->buildObject($row); 
    }  
}