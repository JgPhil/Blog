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
        AS createdAt, role.name AS role, user.activated AS activated, user.visible as visible,  user.erasedAt as erasedAt FROM user
        INNER JOIN role ON user.role_id = role.id ORDER BY user.id DESC';
        $result = $this->createQuery($sql);
        $users = [];
        foreach ($result as $row) {
            $userId = $row['id'];
            $users[$userId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $users;
    }

    public function getUser($pseudo)
    {
        $sql = 'SELECT user.id AS id, user.email as email, user.createdAt as createdAt FROM user WHERE pseudo = ?';
        $data = $this->createQuery($sql, [$pseudo]);
        $result = $data->fetch();
        $user = $this->buildObject($result);
        $sql = 'SELECT path FROM picture WHERE user_id = ?';
        $res = $this->createQuery($sql, [$result['id']]);
        $picturePath = $res->fetch();
        return [$user, $picturePath];
    }

    public function register(Method $postMethod, $path)
    {
        $this->checkUser($postMethod);
        $mail = new Mail;
        $token = $mail->createToken();
        $sql = 'INSERT INTO user (pseudo, password, email, activated, role_id, createdAt) VALUES (?, ?, ?, 0, 2, NOW())';
        $this->createQuery($sql, [
            filter_var($postMethod->getParameter('pseudo'), FILTER_SANITIZE_STRING),
            password_hash(filter_var($postMethod->getParameter('password'), FILTER_SANITIZE_STRING), PASSWORD_BCRYPT),
            filter_var($postMethod->getParameter('email'), FILTER_SANITIZE_EMAIL)
        ]);
        $sql = 'SELECT LAST_INSERT_ID()';
        $result = $this->createQuery($sql);
        $data = $result->fetch();
        $userId = $data[0];
        $sql = ' INSERT INTO token (user_id, token, createdAt) VALUES (LAST_INSERT_ID(), ?, NOW())';
        $this->createQuery($sql, [$token]);
        $mail->registerMail($postMethod, $token);
        $sql = 'INSERT INTO picture (path, user_id) VALUES (?, ?)';
        $this->createQuery($sql, [$path, $userId]);
    }

    public function contactEmail(Method $postMethod)
    {
        $mail = new Mail;
        $sql = 'INSERT INTO contact (name, email, message, phone, createdAt) VALUES (?, ?, ?, ?, NOW())';
        $this->createQuery($sql, [
            filter_var($postMethod->getParameter('name'), FILTER_SANITIZE_STRING),
            filter_var($postMethod->getParameter('email'), FILTER_SANITIZE_EMAIL),
            filter_var($postMethod->getParameter('message'), FILTER_SANITIZE_STRING),
            filter_var($postMethod->getParameter('phone'), FILTER_SANITIZE_NUMBER_INT)
        ]);
        $mail->contactMail($postMethod);
    }

    public function checkUser(Method $postMethod)
    {
        $sql = 'SELECT COUNT(pseudo) FROM user WHERE pseudo = ?';
        $result = $this->createQuery($sql, [filter_var($postMethod->getParameter('pseudo'), FILTER_SANITIZE_STRING)]);
        $pseudoExists = $result->fetchColumn();
        if ($pseudoExists) {
            return 'Le pseudo existe déjà';
        }
    }

    public function checkUserPicture($userId)
    {
        $sql = 'SELECT COUNT(user_id) FROM picture WHERE user_id = ?';
        $result = $this->createQuery($sql, [$userId]);
        $pictureExists = $result->fetchColumn();
        return $pictureExists;
    }

    public function login(Method $postMethod)
    {
        $sql = 'SELECT user.id , user.role_id, user.password, role.name FROM user 
        INNER JOIN role ON role.id = user.role_id WHERE pseudo = ? AND activated = 1';
        $data = $this->createQuery($sql, [$postMethod->getParameter('pseudo')]);
        $result = $data->fetch();
        if ($result) {
            $isPasswordValid = password_verify(filter_var($postMethod->getParameter('password'), FILTER_SANITIZE_STRING), $result['password']);
            $sql = 'SELECT path FROM picture WHERE user_id = ?';
            $res = $this->createQuery($sql, [$result['id']]);
            $picturePath = $res->fetch();
            return [
                'result' => $result, //array
                'isPasswordValid' => $isPasswordValid, //bool
                'picturePath' => $picturePath
            ];
        }
    }

    public function emailConfirm(Method $getMethod)
    {
        $sql = 'SELECT token, createdAt FROM token WHERE user_id = (SELECT id FROM user WHERE pseudo = ?)';
        $data = $this->createQuery($sql, [$getMethod->getParameter('pseudo')]);
        $result = $data->fetch();
        if (!empty($result['token'])) {
            if (filter_var($getMethod->getParameter('token'), FILTER_SANITIZE_STRING) === $result['token'] && time() < (strtotime($result['createdAt']) + (48 * 60 * 60))) {
                return $result;
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
        $this->createQuery($sql, [password_hash(filter_var($postMethod->getParameter('password'), FILTER_SANITIZE_STRING), PASSWORD_BCRYPT), $pseudo]);
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

    public function hideUser($userId)
    {
        $sql = 'UPDATE comment SET visible = 0 WHERE pseudo IN
        (SELECT pseudo FROM user WHERE id = ?)';
        $this->createQuery($sql, [$userId]);
        $sql = 'UPDATE user SET visible = 0 WHERE id = ?';
        $this->createQuery($sql, [$userId]);
        $this->desactivateAccount($userId);
    }

    public function showUser($userId)
    {
        $sql = 'UPDATE user SET visible = 1 WHERE id = ?';
        $this->createQuery($sql, [$userId]);
        $sql = 'UPDATE comment SET visible = 1 WHERE pseudo IN
        (SELECT pseudo FROM user WHERE id = ?)';
        $this->createQuery($sql, [$userId]);
    }

    public function setAdmin($pseudo)
    {
        $sql = 'UPDATE user SET role_id = 1 WHERE pseudo = ?';
        $this->createQuery($sql, [$pseudo]);
    }

    public function eraseUser()
    {
        $sql = 'UPDATE user SET erasedAt = NOW() WHERE visible = 0 ';
        $this->createQuery($sql);
    }

    public function deleteUser($pseudo)
    {
        $sql = 'DELETE FROM user WHERE $pseudo = ?';
        $this->createQuery($sql);
    }

    public function updateUserPicture($path, $userId)
    {
        $sql = 'UPDATE picture SET path = ? WHERE user_id = ?';
        $this->createQuery($sql, [$path, $userId]);
    }

    public function addUserPicture($path, $userId)
    {
        $sql = 'INSERT INTO picture (path, user_id) VALUES (?, ?)';
        $this->createQuery($sql, [$path, $userId]);
    }
}
