<?php

namespace App\src\DAO;

use App\config\Method;
use App\src\model\Post;

class PostDAO extends DAO
{
    private function buildObject($row) //passage en  objet (utilisée dans les methodes getPost() et getPosts())
    {
        $post = new Post();
        $post->setId($row['id']);
        $post->setTitle($row['title']);
        $post->setHeading($row['heading']);
        $post->setContent($row['content']);
        $post->setAuthor($row['pseudo']);
        $post->setCreatedAt($row['date']);
        return $post;
    }

    public function getPosts()
    {
        $sql = 'SELECT post.id, post.title, post.content, post.heading, user.pseudo, 
        DATE_FORMAT(post.createdAt, "%d/%m/%Y à %H:%i") AS date FROM post 
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
        $sql = 'SELECT post.id, post.title, post.content, post.heading, user.pseudo,
        DATE_FORMAT(post.createdAt, "%d/%m/%Y à %H:%i") AS date FROM post
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
}