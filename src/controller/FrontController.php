<?php

namespace App\src\controller;

use App\Framework\Method;

class FrontController extends BlogController
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
        $comments = $this->commentDAO->getValidCommentsFromPost($postId);
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
                $this->session->set('add_comment', 'Votre commentaire est enregistré. Il sera visible après validation par l\'administrateur, ');
            }
            $post = $this->postDAO->getPost($postId);
            $comments = $this->commentDAO->getValidCommentsFromPost($postId);
            return $this->view->render('pagePost', [
                'post' => $post,
                'comments' => $comments,
                'postMethod' => $postMethod,
                'errors' => $errors
            ]);
        }
    }
    

    public function register(Method $postMethod)
    {
        if($postMethod->getParameter('submit')){
            $errors = $this->validation->validate($postMethod, 'User');
            if($this->userDAO->checkUser($postMethod)){
                $errors['pseudo'] = $this->userDAO->checkUser($postMethod);
            }
            if (!$errors){
                $this->userDAO->register($postMethod);
                $this->session->set('register', 'votre inscription a bien été éffectuée, Merci de cliquer sur le lien présent dans le mail de confirmation qui vient de vous être envoyé.' );
                return $this->view->render('register2');
            }
          
        return $this->view->render('register',[
            'postMethod' => $postMethod,
            'errors' => $errors
        ]);    
        }
        return $this->view->render('register');
    }

    public function desactivateAccount($pseudo)
    {
        $this->userDAO->desactivateAccount($this->session->get('pseudo'));
        $this->session->set('desactivate_account', 'Votre compte a bien été désactivé');
        header('Location: ../public/index.php');
    }

    public function emailConfirm(Method $getMethod)
    {
          
        if (!empty($this->userDAO->emailConfirm($getMethod)))
        {   
            $this->userDAO->tokenErase($getMethod->getParameter('pseudo'));
            $this->userDAO->activateAccount($getMethod->getParameter('pseudo'));
            $this->session->set('email_confirmation', 'Votre compte est à présent activé. Bienvenue ! <br> Vous pouvez maintenant vous connecter avec vos identifiants et mot de passe.');
            return $this->view->render('register3');
        }
        $this->userDAO->tokenErase($getMethod->getParameter('pseudo'));
        $this->userDAO->deleteUser($getMethod->getParameter('pseudo'));
        $this->session->set('error_account', 'Il y a eu un problème, merci de vous réinscrire ');
        return $this->view->render('error_account');                   
    }

/*    public function resendMail(Method $getMethod)
    {
        $this->userDAO->resendMail($getMethod);
    }
*/
    public function login(Method $postMethod)
    {
        if ($postMethod->getParameter('submit'))
        {
            $result = $this->userDAO->login($postMethod);
            if ($result && $result['isPasswordValid']) 
            {
                $this->session->set('login','Content de vous revoir');
                $this->session->set('id',$result['result']['id']);
                $this->session->set('role',$result['result']['name']);
                $this->session->set('pseudo',$postMethod->getParameter('pseudo'));
                header('Location: ../public/index.php');
                
            }
            else 
            {
                $this->session->set('error_login', 'Vos identifiants sont incorrects');
                return $this->view->render('login',[
                    'postMethod' => $postMethod
                ]);
            }
        }
        return $this->view->render('login');
    }

    public function contactEmail(Method $postMethod)
    {
        if ($postMethod->getParameter('submit'))
        {
            $errors = $this->validation->validate($postMethod, 'Email');
            if(!$errors)
            {
                $this->userDAO->contactEmail($postMethod);
                $this->session->set('confirm_email', 'Votre email a bien été envoyé');
                header('Location: ../public/index.php');
            }
            else 
            {
                $this->session->set('error_email', 'Votre email n\'a pas été envoyé');
                return $this->view->render('contact',[
                    'postMethod' => $postMethod,
                    'errors' => $errors
                ]);
            }
        }
    }

    public function contact()
    {
        return $this->view->render('contact');
    }
}