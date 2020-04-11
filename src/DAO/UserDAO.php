<?php

namespace App\src\DAO;

use App\config\Method;
use App\src\model\User;

class UserDAO extends DAO
{
    private function buildObject($row)
    {
        $user = new User;
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        $user->setCreatedAt($row['createdAt']);
        $user->setRole($row['name']);
        return $user;
    }

    public function getUsers()
    {
        $sql = 'SELECT user.id, user.pseudo, user.createdAt, role.name FROM user
                INNER JOIN role ON user.role_id = role.id ORDER BY user.id DESC';
        $result = $this->createQuery($sql);
        $users = [];
        foreach ($result as $row){
            $userId = $row['id'];
            $users[$userId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $users;
    }

    public function register(Method $postMethod)
    {
        $this->checkUser($postMethod);
        $sql = 'INSERT INTO user (pseudo, password, createdAt, role_id) VALUES (?, ?, NOW(), ?)';
        $this->createQuery($sql, [$postMethod->getParameter('pseudo'), password_hash($postMethod->getParameter('password'), PASSWORD_BCRYPT), 2]);
    }

    public function checkUser(Method $postMethod)
    {
        $sql = 'SELECT COUNT(pseudo) FROM user WHERE pseudo = ?';
        $result = $this->createQuery($sql, [$postMethod->getParameter('pseudo')]);
        $pseudoExists = $result->fetchColumn();
        if($pseudoExists) {
            return '<p>Le pseudo existe déjà</p>';
        }
    }

    public function login(Method $postMethod)
    {
        $sql = 'SELECT user.id, user.role_id, user.password, role.name FROM user 
        INNER JOIN role ON role.id = user.role_id WHERE pseudo = ?';
        $data = $this->createQuery($sql, [$postMethod->getParameter('pseudo')]);
        $result = $data->fetch();
        $isPasswordValid = password_verify($postMethod->getParameter('password'), $result['password']);
        var_dump($isPasswordValid);
        return [
            'result' => $result,
            'isPasswordValid' => $isPasswordValid
        ];
    }

    public function updatePassword(Method $postMethod, $pseudo)
    {
    $sql = 'UPDATE user SET password = ? WHERE pseudo = ?';
    $this->createQuery($sql, [password_hash($postMethod->getParameter('password'), PASSWORD_BCRYPT), $pseudo]);
    }

    public function deleteAccount($pseudo)
    {
        $sql = 'DELETE FROM user WHERE pseudo = ?';
        $this->createQuery($sql, [$pseudo]);
    }
    public function deleteUser($userId)
    {
        $sql = 'DELETE FROM user WHERE id = ?';
        $this->createQuery($sql, [$userId]);
    }
}

    


