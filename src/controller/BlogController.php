<?php

namespace App\src\controller;

use App\src\DAO\PostDAO;
use App\src\DAO\UserDAO;
use App\src\DAO\pictureDAO;
use App\src\DAO\CommentDAO;
use App\Framework\Controller;
use App\Framework\Validation;
use App\Framework\Upload;
use App\Framework\Method;

/**
 * Class BlogController
 */
abstract class BlogController extends Controller
{
    protected $postDAO;
    protected $commentDAO;
    protected $userDAO;
    protected $pictureDAO;
    protected $validation;


    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->postDAO = new PostDAO;
        $this->commentDAO = new CommentDAO;
        $this->userDAO = new UserDAO;
        $this->validation = new Validation;
        $this->pictureDAO = new PictureDAO;
    }

    /**
     * @return void
     */
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

    /**
     * @param Method $postMethod
     * 
     * @return void
     */
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


    /**
     * @return void
     */
    public function logout()
    {
        if ($this->checkLoggedIn()) {
            $this->session->stop();
            $this->session->start();
            $this->session->set('logout', 'À bientôt');
            header('Location: ../public/index.php');
        }
    }

    /**
     * @return void
     */
    public function checkLoggedIn()
    {
        if (!$this->session->get('pseudo')) {
            $this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
            header('Location: ../public/index.php?route=login');
        } else {
            return true;
        }
    }
}
