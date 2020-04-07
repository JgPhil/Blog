<?php

namespace App\src\controller;

use App\config\Method;

class BackController extends Controller
{
    public function addPost(Method $postMethod)
    {
        if($postMethod->getParameter('submit')) {
            $errors = $this->validation->validate($postMethod, 'Post');
            if(!$errors) {
                $this->postDAO->addPost($postMethod);
                $this->session->set('add_post', 'Le nouvel article a bien été ajouté');
                header('Location: ../public/index.php');
            }
            return $this->view->render('add_post', [
                'postMethod' => $postMethod,
                'errors' => $errors
            ]);
        }
        return $this->view->render('add_post');
    }
    
    
    public function editPost(Method $postMethod, $postId)
    {
        $post = $this->postDAO->getPost($postId);
        if($postMethod->getParameter('submit')) {
            $errors = $this->validation->validate($postMethod, 'Post');
            if (!$errors){
                $this->postDAO->editPost($postMethod, $postId);
                $this->session->set('edit_post', 'L\' article a bien été modifié');
                header('Location: ../public/index.php');
            }
            return $this->view->render('edit_post', [
                'postMethod' => $postMethod,
                'errors' => $errors
            ]);
        } 
        $postMethod->setParameter('id', $post->getId());
        $postMethod->setParameter('title', $post->getTitle());
        $postMethod->setParameter('heading', $post->getHeading());
        $postMethod->setParameter('content', $post->getContent());
        $postMethod->setParameter('author', $post->getAuthor());
        return $this->view->render('edit_post' , [              // préremplissage du formulaire
            'postMethod' => $postMethod                                 
        ]);
    }

    public function deletePost($postId) 
    {
        $this->postDAO->deletePost($postId);
        $this->session->set('delete_post','L\'article a bien été supprimé');
        header('Location: ../public/index.php');
    }

    public function deleteComment($commentId)
    {
        $this->commentDAO->deleteComment($commentId);
        $this->session->set('delete_comment', 'Le commentaire a bien été supprimé');
        header('Location: ../public/index.php');
    }

    public function profile()
    {
        return $this->view->render('profile');
    }

    public function updatePassword(Method $postMethod)
    {
        if($postMethod->getParameter('submit')) {
            $this->userDAO->updatePassword($postMethod, $this->session->get('pseudo'));
            $this->session->set('update_password', 'Le mot de passe a été mis à jour');
            header('Location: ../public/index.php?route=profile');
        }
        return $this->view->render('update_password');
    }

    public function logout()
    {
        $this->session->stop();
        $this->session->start();
        $this->session->set('logout', 'A bientôt');
        header('Location: ../public/index.php');
    }
}