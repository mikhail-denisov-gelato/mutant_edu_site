<?php
namespace App\Landing\Lib;


class Users
{
    public function select()
    {
     	 $profile = SELECT * FROM users WHERE login = 'Savva';
     	 return $profile;
    } 


}