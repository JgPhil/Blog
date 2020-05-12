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
    protected $routes = [];
    protected $param;

    public function __construct()
    {
        $this->request = new Request;
        $this->frontController = new FrontController;
        $this->backController = new BackController;
        $this->errorController = new ErrorController;
    }


    public function run()
    {
        $xml = new \DOMDocument;
        $xml->load('../config/routes.xml');
        $routes = $xml->getElementsByTagName('route');
        $route = $this->request->getGet()->getParameter('route');
        $action = null;
        $arrayRoute = [];

        try {
            if (isset($_SERVER['REQUEST_URI'])) {

                if (null === $route) {
                    return $action = $this->frontController->home();
                } else {
                    foreach ($routes as $xmlRoute) {                        
                        $param = $xmlRoute->getAttribute('param');
                        $controller = substr($xmlRoute->getAttribute('application'), 0, -3) . 'Controller';
                        $method = $xmlRoute->getAttribute('method') . '(' . $param . ')';
                        $actionM = '$this->' . $controller . '->' . $method.';';
                        array_push($arrayRoute, $actionM);
                        if ($xmlRoute->getAttribute('url') === $route) {                          
                            $action = eval($actionM);
                        }
                    }
                }
                if (!in_array($action, $arrayRoute)) {
                    return $this->errorController->errorNotFound();
                } else {
                    return $action; 
                }
            }
        } catch (Exception $e) {
            $this->errorController->errorServer();
        }
    }
}


/*
                        
                        $controllers = array('frontController', 'backController', 'errorController');
                        $key = array_search($routeController, $controllers);
                        $matchedController = $controllers[$key];
                        $matchedControllerClass = "App\src\controller\\".ucfirst($matchedController);
                        $this->matchedController = new $matchedControllerClass;
                        
                        
                        */