<?php

namespace App\src\controller;

use App\config\Method;

class BackController extends Controller
{
    public function addPost(Method $postMethod)
    {
        if($postMethod->getParameter('submit')) {
            $errors = $this->validation->validate($postMethod, 'Article');
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
}