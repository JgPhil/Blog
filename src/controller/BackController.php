<?php

namespace App\src\controller;

use App\config\Parameter;

class BackController extends Controller
{
    public function addArticle(Parameter $post)
    {
        if($post->getParameter('submit')) {
            $errors = $this->validation->validate($post, 'Article');
            if(!$errors) {
                $this->articleDAO->addArticle($post);
                $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
                header('Location: ../public/index.php');
            }
            return $this->view->render('add_article', [
                'post' => $post,
                'errors' => $errors
            ]);
        }
        return $this->view->render('add_article');
    }
    
    
    public function editArticle(Parameter $post, $articleId)
    {
        $article = $this->articleDAO->getArticle($articleId);
        if($post->getParameter('submit')) {
            $errors = $this->validation->validate($post, 'Article');
            if (!$errors){
                $this->articleDAO->editArticle($post, $articleId);
                $this->session->set('edit_article', 'L\' article a bien été modifié');
                header('Location: ../public/index.php');
            }
            return $this->view->render('edit_article', [
                'post' => $post,
                'errors' => $errors
            ]);
        } 
        $post->setParameter('id', $article->getId());
        $post->setParameter('title', $article->getTitle());
        $post->setParameter('heading', $article->getHeading());
        $post->setParameter('content', $article->getContent());
        $post->setParameter('author', $article->getAuthor());
        return $this->view->render('edit_article' , [              // préremplissage du formulaire
            'post' => $post                                 
        ]);
    }
}