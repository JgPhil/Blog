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
        $post->setAuthor($row['author']);
        $post->setCreatedAt($row['createdAt']);
        return $post;
    }

    public function getPosts()
    {
        $sql = 'SELECT id, title, content, heading, author, createdAt FROM post ORDER BY id DESC';
        $result = $this->createQuery($sql);
        $posts = []; // array
        foreach ($result as $row){
            $postId = $row['id'];
            $posts[$postId] = $this->buildObject($row); //conversion par la method buildObject
        }
        $result->closeCursor();
        return $posts; //objet
    }

    public function getPost($postId)
    {
        $sql = 'SELECT id, title, content, heading, author, createdAt FROM post WHERE id = ?';
        $result = $this->createQuery($sql, [$postId]);
        $post = $result->fetch(); //array
        $result->closeCursor();
        return $this->buildObject($post); //objet
    }

    public function addPost(Method $postMethod)
    {
    
      
        $sql = 'INSERT INTO post (title, content, heading, author, createdAt) VALUES (?, ?, ?, ?, NOW())';
        $this->createQuery($sql,[ 
        $postMethod->getParameter('title'), 
        $postMethod->getParameter('content'),
        $postMethod->getParameter('heading'), 
        $postMethod->getParameter('author')
        ]);

    }

    public function editPost(Method $postMethod, $postId)
    {
        $sql = 'UPDATE post SET title=:title, heading=:heading, content=:content, author=:author WHERE id=:postId';
        $this->createQuery($sql, [
            'title' => $postMethod->getParameter('title'),
            'heading' => $postMethod->getParameter('heading'),
            'content' => $postMethod->getParameter('content'),
            'author' => $postMethod->getParameter('author'),
            'postId' => $postMethod
        ]);
    }

    public function deletePost($postId)
    {
        $sql = 'DELETE FROM post WHERE id = ?';
        $this->createQuery($sql,[$postId]);
        $sql = 'DELETE FROM comment  WHERE post_id = ?';
        $this->createQuery($sql,[$postId]);

    }
}