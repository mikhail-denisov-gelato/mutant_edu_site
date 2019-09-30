<?php
namespace App\Landing\Lib;

use Verse\Run\lib\adapter;

class Auth
{
    public function checkLoginAndPassAndReturnKey($login, $pass)
    {
        new adapter();
        $comment ='Введите логин или пароль';
        $user = [$login];
        $pdo = adapter::get_connection();
        $column = $pdo->prepare("SELECT (password) FROM users_profile WHERE (login=?)");
        $column->execute($user);
        $result = $column->fetch(\PDO::FETCH_NAMED);
        $password = $result['password'];

        if (count($password) == 0) {
            return $comment;
        }
        else {
            if ($pass == $password) {
                return true;
            }

        else {
            $comment = 'Неверный логин или пароль';
             }
        }
        return $comment;
    }
    public function checkRole($login)
    {
        new adapter();
        $user = [$login];
        $pdo = adapter::get_connection();
        $column = $pdo->prepare("SELECT (role) FROM users_profile WHERE (login=?)");
        $column->execute($user);
        $result = $column->fetch(\PDO::FETCH_NAMED);
        $role = $result['role'];
        
        return $role;
    }
}