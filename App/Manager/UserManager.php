<?php 

namespace App\Manager;


class UserManager extends Db
{
    private $db;

    public function getAuthor($user_id) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * From user WHERE user_id = :user_id ');
        $req->bindValue(':user_id', $user_id);
        $req->execute();
        $user = $req->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }
}