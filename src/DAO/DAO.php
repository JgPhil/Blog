<?php

namespace App\src\DAO;

use PDO;
use Exception;


abstract class DAO
{

    private $connection;

    private function checkConnection()
    {
        
        if($this->connection === null) {
            return $this->getConnection();
        }
        return $this->connection;
    }

    private function getConnection()
    {
        try{
            $this->connection = new PDO(DB_HOST, DB_USER, DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        }
        catch(Exception $errorConnection)
        {
            die ('Erreur de connection :'.$errorConnection->getMessage());
        }

    }

    protected function createQuery($sql, $parameters = null)
    {
        if($parameters)
        {
            $result = $this->checkConnection()->prepare($sql);
            $result->execute($parameters);
            return $result;
        }
        $result = $this->checkConnection()->query($sql);
        return $result;
    }

    protected function buildObject($row) 
    {   
        $class = "App\\src\\model\\".substr((new \ReflectionClass($this))->getShortName(),0,-3);
        $obj = new $class;
        foreach ($row as $key => $value)
        {
            if (!is_numeric($key))
            {
                $method = 'set'.ucfirst($key);
                $obj->$method($row[$key]);
            }
            if ($class === 'Comment')
            {
              $obj->getPostObj($row['id']);  
            }
                  
        }
        return $obj;
    }
}