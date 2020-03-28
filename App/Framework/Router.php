<?php

namespace App\Framework;


class Router
{
    public function route() {
        try 
        {
            $request = new Request($_REQUEST);

            $controller = $this->createController($request);
            $action  = $this->createAction($request);

            $controller->executeAction($action);
        }
        catch (\Exception $e) 
        {
            $this->error($e);
        }
    }

    private function error(\Exception $exception)
    {
        $view = new View("Error");
        $view->generate(array('msgError' => $exception->getMessage()));
    }

    
    private function createController(Request $request) {
    
        $controller = "Home";

        if ($request->existsParameter('controller')) {        
            $controller = $request->getParameter('controller');
            $controller = ucfirst($controller);
        }
        $classController = $controller.'Controller' ;
        $fileController = 'App/Controller/'.$classController.'.php';

        if (file_exists($fileController)) {
            require_once($fileController);
            $controller = new $classController();
            $controller->setRequest($request);
            return $controller;
        } else {
             throw new \Exception("Fichier '$fileController' introuvable");
        }
    }


  
    private function createAction(Request $request)
    {
        $action = "index";
        if ($request->existsParameter('action'))
        {
            $action = $request->getParameter('action');
        }
        
        return $action;
    }


}