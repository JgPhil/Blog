<?php

namespace App\src\controller;

use App\config\Method;

class FrontController extends Controller
{
    public function home()
    {
        $posts = $this->postDAO->getPosts();
        return $this->view->render('home', [
            'posts' => $posts
        ]);
    }

    public function post($postId)
    {
        $post = $this->postDAO->getPost($postId);
        $comments = $this->commentDAO->getCommentsFromPost($postId);
        return $this->view->render('pagePost', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function addComment(Method $postMethod, $postId)
    {
        if($postMethod->getParameter('submit')){
            $errors = $this->validation->validate($postMethod, 'Comment');
            if(!$errors){
                $this->commentDAO->addComment($postMethod, $postId);
                $this->session->set('add_comment', 'Votre commentaire a bien été ajouté');
                header('Location: ../public/index.php');
            }
            $post = $this->postDAO->getPost($postId);
            $comments = $this->commentDAO->getCommentsFromPost($postId);
            return $this->view->render('pagePost', [
                'post' => $post,
                'comments' => $comments,
                'postMethod' => $postMethod,
                'errors' => $errors
            ]);
        }
    }
}