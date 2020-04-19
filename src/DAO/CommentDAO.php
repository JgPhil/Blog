<?php

namespace App\src\DAO;

use App\src\model\Comment;
use App\Framework\Method;
use App\Framework\DAO;

class CommentDAO extends DAO
{
    public function getComments()
    {
        $sql = 'SELECT id, pseudo, content, DATE_FORMAT(createdAt, "%d/%m/%Y à %H:%i") AS createdAt, validate, post_id FROM comment ORDER BY createdAt DESC';
        $result = $this->createQuery($sql);
        $comments = [];
        foreach ($result as $row)
        {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function getCommentsFromPost($postId)
    {
        $sql = 'SELECT comment.id AS id, comment.pseudo AS pseudo, comment.content AS content, 
        DATE_FORMAT(comment.createdAt, "%d/%m/%Y à %H:%i") AS createdAt,
          comment.validate AS validate, comment.post_id AS post_id FROM comment JOIN post 
        ON comment.post_id = post.id WHERE post_id = ? ORDER BY comment.createdAt DESC';
        $result = $this->createQuery($sql, [$postId]);
        $comments = [];
        foreach ($result as $row) 
        {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments ;
    }



    public function getValidCommentsFromPost($postId)
    {
        $sql = 'SELECT comment.id AS id, comment.pseudo AS pseudo, comment.content AS content, 
        DATE_FORMAT(comment.createdAt, "%d/%m/%Y à %H:%i") AS createdAt,
        comment.validate AS validate, comment.post_id AS post_id  FROM comment JOIN post 
        ON comment.post_id = post.id WHERE post_id = ? AND validate = 1  ORDER BY comment.createdAt DESC';
        $result = $this->createQuery($sql, [$postId]);
        $comments = [];
        foreach ($result as $row) 
        {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments ;
    }

    public function addComment(Method $postMethod, $postId)
    {
        $sql = 'INSERT INTO comment(pseudo, content, createdAt, post_id) VALUES(?,?,NOW(),?)';
        $this->createQuery($sql, [$postMethod->getParameter('pseudo'), $postMethod->getParameter('content'), $postId]);
    }

    public function deleteComment($commentId)
    {
        $sql = 'DELETE FROM comment WHERE id = ?';
        $this->createQuery($sql, [$commentId]);
    }

    public function getCommentsByPseudo($pseudo)
    {
        $sql = 'SELECT id, pseudo, content, DATE_FORMAT(createdAt, "%d/%m/%Y à %H:%i") AS createdAt, post_id, validate FROM comment WHERE pseudo = ?';
        $result = $this->createQuery($sql, [$pseudo]);
        $comments = [];
        foreach ($result as $row) 
        {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function validateComment($commentId)
    {
        $sql = 'UPDATE comment  SET validate = 1 WHERE id = ?';
        $this->createQuery($sql, [$commentId]);
    }

    public function invalidateComment($commentId)
    {
        $sql = 'UPDATE comment  SET validate = 0 WHERE id = ?';
        $this->createQuery($sql, [$commentId]);
    }

    public function getPostFromComment($commentId)
    {
        $sql = 'SELECT post.id, post.title, post.content, post.heading, post.user_id as author, comment.id, 
        DATE_FORMAT(post.createdAt, "%d/%m/%Y à %H:%i") AS createdAt FROM comment 
        INNER JOIN post on post.id=comment.post_id  WHERE comment.id = ?';
        $result = $this->createQuery($sql, [$commentId]);
        $row = $result->fetch(); //array
        $result->closeCursor();
        $post = new PostDAO;
        return  $post->buildObject($row); 
    }  
}