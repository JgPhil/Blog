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
        $sql = 'SELECT id, pseudo, content, createdAt FROM comment WHERE post_id = ? ORDER BY createdAt DESC';
        $result = $this->createQuery($sql, [$postId]);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function addComment(Method $postMethod, $postId)
    {
        $sql = 'INSERT INTO comment(pseudo, content, createdAt, post_id) VALUES(?,?,NOW(),?)';
        $this->createQuery($sql, [$postMethod->getParameter('pseudo'), $postMethod->getParameter('content'), $postId]);
    }
}