<?php

namespace App\src\DAO;

use App\Framework\DAO;
use App\Framework\Method;
use App\src\model\User;
use App\Framework\Mail;

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
        $mail = new Mail;
        $token = $mail->createToken();
        $sql = 'INSERT INTO user (pseudo, password, email, activated, role_id, createdAt) VALUES (?, ?, ?, 0, 2, NOW())';
        $this->createQuery($sql, [$postMethod->getParameter('pseudo'), password_hash($postMethod->getParameter('password'), PASSWORD_BCRYPT), $postMethod->getParameter('email')]);
        $sql = ' INSERT INTO token (user_id, token, createdAt) VALUES (LAST_INSERT_ID(), ?, NOW())' ;
        $this->createQuery($sql, [$token]);
        $mail->registerMail($postMethod, $token);    
    }

    public function contactEmail(Method $postMethod)
    {
        $mail = new Mail;
        $sql = 'INSERT INTO contact (name, email, message, phone, createdAt) VALUES (?, ?, ?, ?, NOW())';
        $this->createQuery($sql, [$postMethod->getParameter('name'), $postMethod->getParameter('email'),$postMethod->getParameter('message'), $postMethod->getParameter('phone')]);
        $mail->contactMail($postMethod);
    }

/*
    public function resendMail(Method $getMethod)
    {
        $mail = new SendMail;
        $token = $mail->createToken();
        $sql = 'INSERT INTO token (user_id, token, createdAt) VALUES ((SELECT id FROM user WHERE pseudo = ?), ?, NOW())' ;
        $this->createQuery($sql, [$getMethod->getParameter('pseudo'), $token]);
        $mail->sendMail($getMethod, $token);  
    }
*/
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
        if($result)
        {
            $isPasswordValid = password_verify($postMethod->getParameter('password'), $result['password']);
        return [
            'result' => $result,
            'isPasswordValid' => $isPasswordValid
        ];
    }   
        
    }

    public function emailConfirm(Method $getMethod)
    {
            $sql = 'SELECT * FROM token INNER JOIN user ON token.user_id = user.id WHERE user.pseudo = ?';
            $data = $this->createQuery($sql, [$getMethod->getParameter('pseudo')]);
            $result = $data->fetch();
            if (isset($result['token']))
            {
                if($getMethod->getParameter('token') === $result['token'] && time() < (strtotime($result['createdAt']) + (48*60*60)))
                {
                    return $result ;
                }
                
            }
    }

    public function tokenErase($pseudo)
    {
        $sql = 'DELETE FROM token WHERE user_id = (SELECT id FROM user WHERE pseudo = ?)';
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

    public function HideUser($userId)
    {
        $sql = 'UPDATE comment SET visible = 0 WHERE pseudo IN
        (SELECT pseudo FROM user WHERE id = ?)';
        $this->createQuery($sql, [$userId]); 
        $sql = 'UPDATE user SET visible = 0 WHERE id = ?';
        $this->createQuery($sql, [$userId]);
    }

    public function deleteUser($pseudo)
    {
        $sql = 'DELETE FROM user WHERE pseudo = ?';
        $this->createQuery($sql, [$pseudo]);
    }

    public function setAdmin($pseudo)
    {
        $sql = 'UPDATE user SET role_id = 1 WHERE pseudo = ?';
        $this->createQuery($sql, [ $pseudo]);
    }

    
}

    


