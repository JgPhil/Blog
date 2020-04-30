<?php

namespace App\Framework;

use App\src\controller\BackController;
use App\src\controller\ErrorController;
use App\src\controller\FrontController;
use Exception;

class NewRouter
{
    private $frontController;
    private $errorController;
    private $backController;
    private $request;

    private $controller;
    private $action;
    private $method;
    protected $routes = [];
    protected $param;

    const NO_ROUTE = 1;





    public function __construct()
    {
        $this->request = new Request;
        $this->frontController = new FrontController;
        $this->backController = new BackController;
        $this->errorController = new ErrorController;
    }


    public function find()
    {
        $xml = new \DOMDocument;
        $xml->load('../config/routes.xml');
        $routes = $xml->getElementsByTagName('route');
        $route = $this->request->getGet()->getParameter('route');

        try {
            if (isset($_SERVER['REQUEST_URI'])) {

                if (null === $route) {
                    return $action = $this->frontController->home();
                } else {
                    foreach ($routes as $xmlRoute) {

                        $param = $xmlRoute->getAttribute('param');
                        $controller = substr($xmlRoute->getAttribute('application'), 0, -3) . 'Controller';
                        $method = $xmlRoute->getAttribute('method') . '(' . $param . ')';
                        $actionM = '$this->' . $controller . '->' . $method;
                        if ($xmlRoute->getAttribute('url') === $route) {
                            $action = $actionM;
                        }
                    }
                }
                if (empty($action)) {
                    return $this->errorController->errorNotFound();
                } else {
                    return $action; //return a string with the the action method;
                }
            }
        } catch (Exception $e) {
            $this->errorController->errorServer();
        }
    }
}
