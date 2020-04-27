<?php

namespace App\src\controller;

use App\Framework\Method;


class BackController extends BlogController

{
    private function checkLoggedIn()
    {
        if(!$this->session->get('pseudo')) {
            $this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
            header('Location: ../public/index.php?route=login');
        } else {
            return true;
        }
    }

    private function checkAdmin()
    {
        $this->checkLoggedIn();
        if(!($this->session->get('role') === 'admin')) {
            $this->session->set('not_admin', 'Vous n\'avez pas le droit d\'accéder à cette page');
            header('Location: ../public/index.php?route=profile');
        } else {
            return true;
        }
    }
    public function administration()
    {
        if($this->checkAdmin()){
            $posts = $this->postDAO->getPosts();
            $users = $this->userDAO->getUsers();
            $comments = $this->commentDAO->getComments();
            $messages = ADMIN_MESSAGES;

            return $this->view->render('administration', [
                'posts' => $posts,
                'users' => $users,
                'comments' => $comments,
                'messages' => $messages
        ]); 
        }
        
    }

    public function addPost(Method $postMethod)
    {
        if ($this->checkAdmin()){
            if($postMethod->getParameter('submit')) {
            $errors = $this->validation->validate($postMethod, 'Post');
            if(!$errors) {
                $this->postDAO->addPost($postMethod, $this->session->get('id'));
                $this->session->set('add_post', 'Le nouvel article a bien été ajouté');
                header('Location: ../public/index.php?route=administration');
            }
            return $this->view->render('add_post', [
                'postMethod' => $postMethod,
                'errors' => $errors
            ]);
        }
        return $this->view->render('add_post'); 
        }
        
    }
    
    
    public function editPost(Method $postMethod, $postId)
    {
        if ($this->checkAdmin()){
            $post = $this->postDAO->getPost($postId);
            if($postMethod->getParameter('submit')) {
            $errors = $this->validation->validate($postMethod, 'Post');
            if (!$errors){
                $this->postDAO->editPost($postMethod, $postId, $this->session->get('id'));
                $this->session->set('edit_post', 'L\' article a bien été modifié');
                header('Location: ../public/index.php?route=administration');
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
    }

    public function deletePost($postId) 
    {
        if ($this->checkAdmin()){
            $this->postDAO->deletePost($postId);
            $this->session->set('delete_post','L\'article a bien été supprimé');           
            header('Location: ../public/index.php?route=administration');
        }       
    }

    public function deleteComment($commentId)
    {
        if ($this->checkAdmin()){
            $this->commentDAO->deleteComment($commentId);
            $this->session->set('delete_comment', 'Le commentaire a bien été supprimé');
            header('Location: ../public/index.php?route=administration');
        }      
    }

    public function profile()
    {
        if ($this->checkLoggedIn()){
            $pseudo = $this->session->get('pseudo');
            $comments = $this->commentDAO->getCommentsByPseudo($pseudo);
            return $this->view->render('profile', [
                'pseudo' => $pseudo,
                'comments' => $comments
            ]);
        }        
    }

    public function checkProfile($pseudo)
    {
        $comments = $this->commentDAO->getCommentsByPseudo($pseudo);
        return $this->view->render('profilComments', [
            'comments' => $comments
        ]);
    }

    public function updatePassword(Method $postMethod)
    {
        if ($this->checkLoggedIn()){
            if($postMethod->getParameter('submit')) {
            $this->userDAO->updatePassword($postMethod, $this->session->get('pseudo'));
            $this->session->set('update_password', 'Le mot de passe a été mis à jour');
            header('Location: ../public/index.php?route=profile');
        }
        return $this->view->render('update_password');
        }       
    }

    public function logout()
    {
        if ($this->checkLoggedIn()){
            $this->session->stop();
            $this->session->start();
            $this->session->set('logout', 'À bientôt');
            header('Location: ../public/index.php');
        }
    }

    public function desactivateAccount($pseudo)
    {
        $this->userDAO->desactivateAccount($this->session->get('pseudo'));
        $this->session->set('desactivate_account', 'Le compte a bien été désactivé');
        header('Location: ../public/index.php');
    }

    public function desactivateAccountAdmin($pseudo)
    {
        $this->userDAO->desactivateAccount($pseudo);
        $this->session->set('desactivate_account', 'Le compte a bien été désactivé');
        header('Location: ../public/index.php?route=administration');
    }


    public function setAdmin($pseudo)
    {
        $this->userDAO->setAdmin($pseudo);
        $this->session->set('set_admin', 'Le rôle "admin" a bien été appliqué à l\'utilisateur '.$pseudo);
        header('Location: ../public/index.php?route=administration');
    }


    public function deleteUser($userId)
    {
        if($this->checkAdmin()) {
            $this->userDAO->deleteUser($userId);
            $this->session->set('delete_account', 'Le compte a bien été supprimé');
            header('Location: ../public/index.php?route=administration');
        }
    }

    public function postComments($postId)
    {
        $comments = $this->commentDAO->getCommentsFromPost($postId);
        $alert = "<script>alert('Pas de commentaire sur cet article');</script>";
            return $this->view->render('postComments', [
            'comments' => $comments,
            'alert' => $alert 
            ]);
    }

    public function validateComment($commentId)
    {
        $this->commentDAO->validateComment($commentId);
        $this->session->set('validate_comment', 'commentaire validé');
        header('Location: ../public/index.php?route=administration');
    }

    public function inValidateComment($commentId)
    {
        $this->commentDAO->inValidateComment($commentId);
        $this->session->set('invalidate_comment', 'commentaire invalidé');
        header('Location: ../public/index.php?route=administration');
    }

    public function activateAccount($pseudo)
    {
        if ($this->checkAdmin())
        {   $this->userDAO->activateAccount($pseudo);
            $this->session->set('activate_acccount', 'Le compte vient d\'être activé !');
            header('Location: ../public/index.php?route=administration');
        }
    }
}