<?php

$route = $this->request->getGet()->getParameter('route');
$postId = $this->request->getGet()->getParameter('postId');
$commentId = $this->request->getGet()->getParameter('commentId');
$userId =$this->request->getGet()->getParameter('userId');

if (isset($route)){
    switch ($route) {
    case $route === 'post' && (!empty($postId)):
        $action = $this->frontController->post($postId);
    break;
    case $route === 'addPost':
        $action = $this->backController->addPost($this->request->getPost());
    break;
    case $route === 'editPost':
        $action = $this->backController->editPost($this->request->getPost(), $postId);
    break;
    case $route === 'deletePost':
        $action = $this->backController->deletePost($postId);
    break;
    case $route === 'addComment':
        $action = $this->frontController->addComment($this->request->getPost(), $postId);
    break;
    case $route === 'deleteComment':
        $action = $this->backController->deleteComment($commentId);
    break;
    case $route === 'register':
        $action = $this->frontController->register($this->request->getPost());
    break;
    case $route === 'login':
        $action = $this->frontController->login($this->request->getPost());
    break;
    case $route === 'profile':
        $action = $this->backController->profile();
    break;
    case $route === 'updatePassword':
        $action = $this->backController->updatePassword($this->request->getPost());
    break;
    case $route === 'logout':
        $action = $this->backController->logout();
    break;
    case $route === 'deleteAccount':
        $action = $this->backController->deleteAccount();
    break;
    case $route === 'administration':
        $action = $this->backController->administration();
    break;
    case $route === 'postComments' && (!empty($postId)):
        $action = $this->backController->postComments($postId);
    break;
    case $route === 'deleteUser':
        $action = $this->backController->deleteUser($userId);
    break;
    case $route === 'validateComment':
        $action = $this->backController->validateComment($commentId);
    break;
    default: $action = $this->errorController->errorNotFound();
    }
}
else {
    $action = $this->frontController->home();
}
