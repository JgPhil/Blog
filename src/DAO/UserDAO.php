<?php

namespace App\src\DAO;

use App\Framework\DAO;
use App\Framework\Method;
use App\src\model\User;
use App\Framework\SendMail;

class UserDAO extends DAO
{
    public function getUsers()
    {
        $sql = 'SELECT user.id AS id, user.pseudo AS pseudo,DATE_FORMAT(user.createdAt, "%d/%m/%Y à %H:%i") 
        AS createdAt, role.name AS role, user.activated AS activated FROM user
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
        $mail = new SendMail;
        $token = $mail->createToken();
        $sql = 'INSERT INTO user (pseudo, password, email,  token, activated, role_id, createdAt, tokenTimeOut) VALUES (?, ?, ?, ?, 0, 2, NOW(), NOW())';
        $this->createQuery($sql, [$postMethod->getParameter('pseudo'), password_hash($postMethod->getParameter('password'), PASSWORD_BCRYPT), $postMethod->getParameter('email'), $token]);
        $mail->sendMail($postMethod, $token);    
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
        INNER JOIN role ON role.id = user.role_id WHERE pseudo = ? AND activated = 1';
        $data = $this->createQuery($sql, [$postMethod->getParameter('pseudo')]);
        $result = $data->fetch(); 
        $isPasswordValid = password_verify($postMethod->getParameter('password'), $result['password']);
        return [
            'result' => $result,
            'isPasswordValid' => $isPasswordValid
        ];
    }

    public function emailConfirm(Method $getMethod) //the return from the confirmation email link.
    {                                                  //Query the database to check if the token is similar/not empty. Also check if tokenTimeOut not exceeded;
        $sql = 'SELECT * FROM user WHERE pseudo = ?';
        $data = $this->createQuery($sql, [$getMethod->getParameter('pseudo')]);
        $result = $data->fetch();
        if (!empty($result['token'])){
            return 'Votre compte est déja activé  !';
        }
        if ($getMethod->getParameter('token') !== $result['token'] || time() > (strtotime($result['tokenTimeOut']) + (48*60*60)))
        {
            return 'Ce lien ne fonctionne pas';
        }
        return $result;
    }

    public function tokenReset($pseudo)
    {
        $sql = 'UPDATE user SET token = null WHERE pseudo = ?';
        $this->createQuery($sql, [$pseudo]);
        $sql = 'UPDATE user SET tokenTimeOut = now() WHERE pseudo = ?';
        $this->createQuery($sql, [$pseudo]);
    }

    public function updatePassword(Method $postMethod, $pseudo)
    {
        $sql = 'UPDATE user SET password = ? WHERE pseudo = ?';
        $this->createQuery($sql, [password_hash($postMethod->getParameter('password'), PASSWORD_BCRYPT), $pseudo]);
    }

    public function desactivateAccount($pseudo)
    {   
        $sql = 'UPDATE comment INNER JOIN user ON comment.pseudo= user.pseudo SET validate = 0 WHERE user.pseudo = ?';
        $this->createQuery($sql, [$pseudo]); 
        $sql = 'UPDATE user SET activated = 0 WHERE pseudo = ?';
        $this->createQuery($sql, [$pseudo]);
              
    }

    public function activateAccount($pseudo)
    {
        $sql = 'UPDATE user SET activated = 1 WHERE pseudo = ?';
        $this->createQuery($sql, [$pseudo]);     
    }

    public function deleteUser($userId)
    {
        $sql = 'DELETE FROM comment WHERE pseudo IN
        (SELECT pseudo FROM user WHERE id = ?)';
        $this->createQuery($sql, [$userId]); 
        $sql = 'DELETE FROM user WHERE id = ?';

        $this->createQuery($sql, [$userId]);
    }

    
}

    


