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
                $this->session->set('add_comment', 'Votre commentaire a bien été ajouté');
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
                $this->session->set('register', 'votre inscription a bien été éffectuée');
                header('Location: ../public/index.php');
            }
          
        return $this->view->render('register',[
            'postMethod' => $postMethod,
            'errors' => $errors
        ]);    
        }
        return $this->view->render('register');
    }

    public function login(Method $postMethod)
    {
        if ($postMethod->getParameter('submit')){
            $result = $this->userDAO->login($postMethod);
            if ($result && $result['isPasswordValid']) {
                $this->session->set('login','Content de vous revoir');
                $this->session->set('id',$result['result']['id']);
                $this->session->set('role',$result['result']['name']);
                $this->session->set('pseudo',$postMethod->getParameter('pseudo'));
                header('Location: ../public/index.php');
            }
            else {
                $this->session->set('error_login', 'Vos identifiants sont incorrects');
                return $this->view->render('login',[
                    'postMethod' => $postMethod
                ]);
            }
        }
        return $this->view->render('login');
    }
}