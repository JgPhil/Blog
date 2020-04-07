<?php

namespace App\src\DAO;

use App\config\Method;

class UserDAO extends DAO
{
    public function register(Method $postMethod)
    {
        $this->checkUser($postMethod);
        $sql = 'INSERT INTO user (pseudo, password, createdAt) VALUES (?, ?, NOW())';
        $this->createQuery($sql, [$postMethod->getParameter('pseudo'), password_hash($postMethod->getParameter('password'), PASSWORD_BCRYPT)]);
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
        $sql = 'SELECT id, password FROM user WHERE pseudo = ?';
        $data = $this->createQuery($sql, [$postMethod->getParameter('pseudo')]);
        $result = $data->fetch();
        $isPasswordValid = password_verify($postMethod->getParameter('password'), $result['password']);
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
}