<?php
namespace App\Landing\Lib;


class Users
{
    public function select()
    {
    	db_connection::get_connection();
    	$column = $pdo->prepare("SELECT (password) FROM users_profile WHERE (login=?)");
    	$column->execute($login);
        $result = $column->fetch(\PDO::FETCH_NAMED);
        $password = $result['password'];
        echo "$password";
    } 


}