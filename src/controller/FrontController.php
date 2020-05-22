<?php

namespace App\src\controller;

use App\Framework\Upload;
use App\Framework\Method;

/**
 * Class FrontController
 */
class FrontController extends BlogController
{
    /**
     * @return void
     */
    public function home()
    {
        $posts = $this->postDAO->getPosts();
        return $this->view->render('home', [
            'posts' => $posts
        ]);
    }

    /**
     * @param mixed $postId
     * 
     * @return void
     */
    public function post($postId)
    {
        $post = $this->postDAO->getPost($postId);
        $comments = $this->commentDAO->getCommentsFromPost($postId);
        return $this->view->render('pagePost', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    /**
     * @param Method $postMethod
     * @param mixed $postId
     * 
     * @return void
     */
    public function addComment(Method $postMethod, $postId)
    {
        if ($postMethod->getParameter('submit')) {
            $errors = $this->validation->validate($postMethod, 'Comment');
            if (!$errors) {
                $this->commentDAO->addComment($postMethod, $postId);
                $this->session->set('add_comment', 'Votre commentaire est enregistré. Il sera visible après validation par l\'administrateur, ');
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

    /**
     * @param Method $postMethod
     * 
     * @return void
     */
    public function updateUserPicture(Method $postMethod)
    {
        if ($postMethod->getParameter('submit')) {
            $target = "user";
            $file = new Upload;
            $name = $file->uploadFile($target);
            $userId = $this->session->get('id');
            $checkUserPicture = $this->pictureDAO->checkUserPicture($userId);
            if ($checkUserPicture) {
                $this->pictureDAO->updateUserPicture($name, $userId);
            } else {
                $this->pictureDAO->addUserPicture($name, $userId);
            }
            $this->session->set('update_user_picture', 'Votre image a été changée');
            header('Location: ../public/index.php?route=profile');
        }
        return $this->view->render('update_user_picture', [
            'postMethod' => $postMethod
        ]);
    }

    /**
     * @param Method $postMethod
     * 
     * @return void
     */
    public function register(Method $postMethod)
    {
        if ($postMethod->getParameter('submit')) {
            $errors = $this->validation->validate($postMethod, 'User');
            if ($this->userDAO->checkUser($postMethod)) {
                $errors['pseudo'] = $this->userDAO->checkUser($postMethod);
            }
            if (!$errors) {
                $target = "user";
                $userId = $this->userDAO->register($postMethod);
                if ($this->files->getParameter('userfile')['name']) {
                    $file = new Upload;
                    $name = $file->uploadFile($target);
                    $this->pictureDAO->addUserPicture($name, $userId);
                }
                $this->session->set('register', 'votre inscription a bien été éffectuée, Merci de cliquer sur le lien présent dans le mail de confirmation qui vient de vous être envoyé.');
                return $this->view->render('register2');
            }

            return $this->view->render('register', [
                'postMethod' => $postMethod,
                'errors' => $errors
            ]);
        }
        return $this->view->render('register');
    }



    /**
     * @param mixed $pseudo
     * 
     * @return void
     */
    public function desactivateAccount($pseudo)
    {
        $this->userDAO->desactivateAccount(filter_var($this->session->get('pseudo'), FILTER_SANITIZE_STRING));
        $this->session->set('desactivate_account', 'Votre compte a bien été désactivé');
        header('Location: ../public/index.php');
    }

    /**
     * @param Method $getMethod
     * 
     * @return void
     */
    public function emailConfirm(Method $getMethod)
    {

        if (!empty($this->userDAO->emailConfirm($getMethod))) {
            $this->userDAO->tokenErase(filter_var($getMethod->getParameter('pseudo'), FILTER_SANITIZE_STRING));
            $this->userDAO->activateAccount(filter_var($getMethod->getParameter('pseudo'), FILTER_SANITIZE_STRING));
            $this->session->set('email_confirmation', 'Votre compte est à présent activé. Bienvenue ! <br> Vous pouvez maintenant vous connecter avec vos identifiants et mot de passe.');
            return $this->view->render('register3');
        }
        $this->userDAO->tokenErase(filter_var($getMethod->getParameter('pseudo'), FILTER_SANITIZE_STRING));
        $this->userDAO->deleteUser(filter_var($getMethod->getParameter('pseudo'), FILTER_SANITIZE_STRING));
        $this->session->set('error_account', 'Il y a eu un problème, merci de vous réinscrire ');
        return $this->view->render('error_account');
    }


    /**
     * @param Method $postMethod
     * 
     * @return void
     */
    public function login(Method $postMethod)
    {
        if ($postMethod->getParameter('submit')) {
            $result = $this->userDAO->login($postMethod);
            if ($result && $result['isPasswordValid']) {
                $this->session->set('login', 'Content de vous revoir');
                $this->session->set('id', $result['result']['id']);
                $this->session->set('role', $result['result']['name']);
                $this->session->set('pseudo', $postMethod->getParameter('pseudo'));
                $this->session->set('picturePath', $result['picturePath']);
                header('Location: ../public/index.php');
            } else {
                $this->session->set('error_login', 'Vos identifiants sont incorrects');
                return $this->view->render('login', [
                    'postMethod' => $postMethod
                ]);
            }
        }
        return $this->view->render('login');
    }

    /**
     * @param Method $postMethod
     * 
     * @return void
     */
    public function contact(Method $postMethod)
    {
        if ($postMethod->getParameter('submit')) {
            $errors = $this->validation->validate($postMethod, 'Email');
            if (!$errors) {
                $this->userDAO->contactEmail($postMethod);
                $this->session->set('confirm_email', 'Votre email a bien été envoyé');
                header('Location: ../public/index.php');
            } else {
                $this->session->set('error_email', 'Votre email n\'a pas été envoyé');
                return $this->view->render('contact', [
                    'postMethod' => $postMethod,
                    'errors' => $errors
                ]);
            }
        }
        return $this->view->render('contact');
    }
}
