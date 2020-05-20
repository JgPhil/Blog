<?php

namespace App\src\controller;

use App\Framework\Method;
use App\src\helpers\Upload;

/**
 * Class BackController
 */
class BackController extends BlogController

{

    private $dao;
    /**
     * @return void
     */
    private function checkLoggedIn()
    {
        if (!$this->session->get('pseudo')) {
            $this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
            header('Location: ../public/index.php?route=login');
        } else {
            return true;
        }
    }

    /**
     * @return void
     */
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

    /**
     * @return void
     */
    public function administration()
    {
        if ($this->checkAdmin()) {
            $posts = $this->postDAO->getPosts();
            $users = $this->userDAO->getUsers();
            $comments = $this->commentDAO->getComments();

            return $this->view->render('administration', [
                'posts' => $posts,
                'users' => $users,
                'comments' => $comments
            ]);
        }
    }

    /**
     * @param Method $postMethod
     * 
     * @return void
     */
    public function addPost(Method $postMethod)
    {
        $target = "blog";
        $name = null;
        if ($this->checkAdmin()) {
            if ($postMethod->getParameter('submit')) {
                $errors = $this->validation->validate($postMethod, 'Post');
                if (!$errors) {
                    $postId = $this->postDAO->addPost($postMethod, $this->session->get('id'));
                    if (!empty($this->files->getParameter('userfile')['name'])) {
                        $name = Upload::uploadFile($target);
                        $this->pictureDAO->addPostPicture($name, $postId);
                    }
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


    /**
     * @param Method $postMethod
     * @param mixed $postId
     * 
     * @return void
     */
    public function editPost(Method $postMethod, $postId)
    {
        $target = "blog";
        $name = null;
        if ($this->checkAdmin()) {
            $post = $this->postDAO->getPost($postId);
            if ($postMethod->getParameter('submit')) {
                $errors = $this->validation->validate($postMethod, 'Post');
                if (!$errors) {
                    if (!empty($this->files->getParameter('userfile')['name'])) {
                        $name = Upload::uploadFile($target);
                        $this->pictureDAO->updatePostPicture($postId, $name);
                    }
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
            $postMethod->setParameter('picturePath', $post->getPicture());
            return $this->view->render('edit_post', [              // préremplissage du formulaire
                'postMethod' => $postMethod
            ]);
        }
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
     * @param mixed $pseudo
     * 
     * @return void
     */
    public function checkProfile($pseudo)
    {
        $comments = $this->commentDAO->getCommentsByPseudo($pseudo);
        return $this->view->render('profilComments', [
            'comments' => $comments
        ]);
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
     * @param mixed $pseudo
     * 
     * @return void
     */
    public function desactivateAccountAdmin($pseudo)
    {
        $this->userDAO->desactivateAccount($pseudo);
        $this->session->set('desactivate_account', 'Le compte a bien été désactivé');
        header('Location: ../public/index.php?route=administration');
    }


    /**
     * @param mixed $pseudo
     * 
     * @return void
     */
    public function setAdmin($pseudo)
    {
        $this->userDAO->setAdmin($pseudo);
        $this->session->set('set_admin', 'Le rôle "admin" a bien été appliqué à l\'utilisateur ' . $pseudo);
        header('Location: ../public/index.php?route=administration');
    }


    public function trash($id)
    {
        if ($this->checkAdmin()) {
            $name = substr($this->getMethod->getParameter('route'), 4);
            eval('$this->' . lcfirst($name) . 'DAO->hide' . $name . '( ' . $id . ');');
            $this->session->set('delete_' . $name, 'Envoyé vers la corbeille');
            header('Location: ../public/index.php?route=administration');
        }
    }

    public function show($id)
    {
        if ($this->checkAdmin()) {
            $name = substr($this->getMethod->getParameter('route'), 4);
            eval('$this->' . lcfirst($name) . 'DAO->show' . $name . '( ' . $id . ');');
            $this->session->set('show_account', 'L\'élément  est à nouveau visible');
            header('Location: ../public/index.php?route=administration');
        }
    }

    
    /**
     * @param mixed $postId
     * 
     * @return void
     */
    public function postComments($postId)
    {
        if ($this->checkAdmin()) {
            $comments = $this->commentDAO->getCommentsFromPost($postId);

            if ($comments) {
                return $this->view->render('postComments', [
                    'comments' => $comments
                ]);
            }

            echo '<script>
            alert("Pas de commentaire sur cet article");
            window.location.href="../public/index.php?route=administration"</script>';
        }
    }

    /**
     * @param mixed $commentId
     * 
     * @return void
     */
    public function validateComment($commentId)
    {
        $this->commentDAO->validateComment($commentId);
        $this->session->set('validate_comment', 'commentaire validé');
        header('Location: ../public/index.php?route=administration');
    }

    /**
     * @param mixed $commentId
     * 
     * @return void
     */
    public function inValidateComment($commentId)
    {
        $this->commentDAO->inValidateComment($commentId);
        $this->session->set('invalidate_comment', 'commentaire invalidé');
        header('Location: ../public/index.php?route=administration');
    }

    /**
     * @param mixed $pseudo
     * 
     * @return void
     */
    public function activateAccount($pseudo)
    {
        if ($this->checkAdmin()) {
            $this->userDAO->activateAccount($pseudo);
            $this->session->set('activate_acccount', 'Le compte vient d\'être activé !');
            header('Location: ../public/index.php?route=administration');
        }
    }


    /**
     * @return void
     */
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
