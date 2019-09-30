<?php

namespace App\Landing\Lib;

use Verse\Run\lib\adapter;


class Registration
{
     
    public function NewUserRegistration($login, $password, $role){
        $pdo = adapter::get_connection();
        $comment ='Введите логин или пароль';
        if(mb_strlen($login) < 3 || mb_strlen($login) >16) {
            $comment ='Недопустимая длина логина (от 3 до 16 символов)';
        }
        if(mb_strlen($password) < 3 || mb_strlen($password) >16) {
            $comment ='Недопустимая длина пароля (от 3 до 16 символов)';
        }
        $name = [$login];
        $column = $pdo->prepare("SELECT (password) FROM users_profile WHERE (login=?)");
        $column->execute($name);
        $result = $column->fetch(\PDO::FETCH_NAMED);
        $pass = $result['password'];

        if($pass == 0){
            $user =[$login, $password, $role];
            $sql = "INSERT INTO users_profile (login, password, role) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($user);
        }
        else {
            $comment ='Данный логин уже занят';
        }
        return $comment;
    }

}
