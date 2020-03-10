<?php
namespace App\Model;

use App\Model;


class PostManager 
{
private $db;

    public function dbConnect() {
        if ($this->bdd == null) {
            // Création de la connexion
            $this->bdd = $this->dbConnect();
            var_dump($this->bdd);
        }
    
        return $this->bdd;

}

}