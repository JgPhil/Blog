<?php

namespace App\src\controller;

use App\Framework\Method;
use App\src\helpers\Upload;

class BackController extends BlogController

{
    private function checkLoggedIn()
    {
        if (!$this->session->get('pseudo')) {
            $this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
            header('Location: ../public/index.php?route=login');
        } else {
            return true;
        }
    }

    private function checkAdmin()
    {
        $this->checkLoggedIn();
        if (!($this->session->get('role') === 'admin')) {
            $this->session->set('not_admin', 'Vous n\'avez pas le droit d\'accéder à cette page');
            header('Location: ../public/index.php?route=profile');
        } else {
            return true;
        }
    }
    public function administration()
    {
        if ($this->checkAdmin()) {
            [$posts, $picturePaths] = $this->postDAO->getPosts();
            $users = $this->userDAO->getUsers();
            $comments = $this->commentDAO->getComments();

            return $this->view->render('administration', [
                'posts' => $posts,
                'picturePaths' => $picturePaths,
                'users' => $users,
                'comments' => $comments
            ]);
        }
    }

    public function addPost(Method $postMethod)
    {
        if ($this->checkAdmin()) {
            if ($postMethod->getParameter('submit')) {
                $errors = $this->validation->validate($postMethod, 'Post');
                if (!$errors) {
                    $path = Upload::uploadPicture();
                    $this->postDAO->addPost($postMethod, $this->session->get('id'), $path);
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
        if ($this->checkAdmin()) {
            [$post, $picturePath] = $this->postDAO->getPost($postId);
            if ($postMethod->getParameter('submit')) {
                $errors = $this->validation->validate($postMethod, 'Post');
                if (!$errors) {
                    $path = Upload::uploadPicture(); // basename($_FILES["name"]
                    $this->postDAO->editPost($postMethod, $postId, $this->session->get('id'), $path);
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
            $postMethod->setParameter('picturePath', $picturePath['path']);
            return $this->view->render('edit_post', [              // préremplissage du formulaire
                'postMethod' => $postMethod
            ]);
        }
    }

    public function profile()
    {
        if ($this->checkLoggedIn()) {
            $pseudo = $this->session->get('pseudo');
            $comments = $this->commentDAO->getCommentsByPseudo($pseudo);
            $posts = $this->postDAO->getPostsFromPseudo($pseudo);
            $user = $this->userDAO->getUser($pseudo);
            return $this->view->render('profile', [
                'user' => $user,
                'pseudo' => $pseudo,
                'posts' => $posts,
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
        if ($this->checkLoggedIn()) {
            if ($postMethod->getParameter('submit')) {
                $errors = $this->validation->validate($postMethod, 'User');
                if (!$errors) {
                    $this->userDAO->updatePassword($postMethod, $this->session->get('pseudo'));
                    $this->session->set('update_password', 'Le mot de passe a été mis à jour');
                    header('Location: ../public/index.php');
                }
                return $this->view->render('update_password', [
                    'postMethod' => $postMethod,
                    'errors' => $errors
                ]);
            }
            return $this->view->render('update_password');
        }
    }

    public function logout()
    {
        if ($this->checkLoggedIn()) {
            $this->session->stop();
            $this->session->start();
            $this->session->set('logout', 'À bientôt');
            header('Location: ../public/index.php');
        }
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
        $this->session->set('set_admin', 'Le rôle "admin" a bien été appliqué à l\'utilisateur ' . $pseudo);
        header('Location: ../public/index.php?route=administration');
    }


    public function hideUser($userId)
    {
        if ($this->checkAdmin()) {
            $this->userDAO->hideUser($userId);
            $this->session->set('delete_account', 'Le compte a bien été mis à la corbeille');
            header('Location: ../public/index.php?route=administration');
        }
    }

    public function hidePost($postId)
    {
        if ($this->checkAdmin()) {
            $this->postDAO->hidePost($postId);
            $this->session->set('delete_post', 'L\'article a bien été mis à la corbeille');
            header('Location: ../public/index.php?route=administration');
        }
    }

    public function hideComment($commentId)
    {
        if ($this->checkAdmin()) {
            $this->commentDAO->hideComment($commentId);
            $this->session->set('delete_comment', 'Le commentaire a bien été mis à la corbeille');
            header('Location: ../public/index.php?route=administration');
        }
    }

    public function showUser($userId)
    {
        if ($this->checkAdmin()) {
            $this->userDAO->showUser($userId);
            $this->session->set('show_account', 'Le compte est à nouveau visible');
            header('Location: ../public/index.php?route=administration');
        }
    }

    public function showPost($postId)
    {
        if ($this->checkAdmin()) {
            $this->postDAO->showPost($postId);
            $this->session->set('show_post', 'L\'article est à nouveau visible');
            header('Location: ../public/index.php?route=administration');
        }
    }

    public function showComment($commentId)
    {
        if ($this->checkAdmin()) {
            $this->commentDAO->showComment($commentId);
            $this->session->set('show_comment', 'Le commentaire est à nouveau visible');
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
        if ($this->checkAdmin()) {
            $this->userDAO->activateAccount($pseudo);
            $this->session->set('activate_acccount', 'Le compte vient d\'être activé !');
            header('Location: ../public/index.php?route=administration');
        }
    }


    public function emptyTrash()
    {
        if ($this->checkAdmin()) {
            $this->userDAO->eraseUser();
            $this->postDAO->erasePost();
            $this->commentDAO->eraseComment();
            $this->session->set('empty_trash', 'La corbeille a été vidée');
            header('Location: ../public/index.php?route=administration');
        }
    }
}
