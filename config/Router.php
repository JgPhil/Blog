<?php

namespace App\config;
use App\src\controller\BackController;
use App\src\controller\ErrorController;
use App\src\controller\FrontController;
use Exception;

class Router
{
    private $frontController;
    private $errorController;
    private $backController;
    private $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->frontController = new FrontController();
        $this->backController = new BackController();
        $this->errorController = new ErrorController();
    }

    public function run()
    {   
        require_once ('routes.php');
        try{
            if (isset($_SERVER['REQUEST_URI']))
            {   
                return $action;
            }
        }
        catch (Exception $e)
        {
            $this->errorController->errorServer();
        }
    }
}