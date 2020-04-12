<?php

namespace App\src\DAO;

use App\src\model\Comment;
use App\config\Method;

class CommentDAO extends DAO
{
    private function buildObject($row)
    {
        $comment = new Comment();
        $comment->setId($row['id']);
        $comment->setPseudo($row['pseudo']);
        $comment->setContent($row['content']);
        $comment->setCreatedAt($row['createdAt']);
        return $comment;
    }

    public function getCommentsFromPost($postId)
    {
        $sql = 'SELECT comment.id, comment.pseudo, comment.content, comment.createdAt, post.title FROM comment JOIN post 
        ON comment.post_id = post.id WHERE post_id = ? ORDER BY comment.createdAt DESC';
        $result = $this->createQuery($sql, [$postId]);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments ;
    }

    public function getValidCommentsFromPost($postId)
    {
        $sql = 'SELECT comment.id, comment.pseudo, comment.content, comment.createdAt, post.title FROM comment JOIN post 
        ON comment.post_id = post.id WHERE post_id = ? AND validate = 1  ORDER BY comment.createdAt DESC';
        $result = $this->createQuery($sql, [$postId]);
        $comments = [];
        foreach ($result as $row) {
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
        $sql = 'SELECT id, pseudo, content, createdAt, post_id, validate FROM comment WHERE pseudo = ?';
        $result = $this->createQuery($sql, [$pseudo]);
        $comments = [];
        foreach ($result as $row) {
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
}