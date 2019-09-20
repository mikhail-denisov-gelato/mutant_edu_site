<?php
namespace App\Landing\Lib;

class Auth
{
    private $authPairs = [
        'duane' => ['321','admin'],
        'mike' =>  ['123','user']
    ];
    private $authKeys = [
        'duane' => '321',
        'mike' => '123'
    ];
    public function checkLoginAndPassAndReturnKey($login, $pass)
    {
        $storedPass = $this->authPairs[$login][0] ?? null;
        if (!$storedPass) {
                return false;
        }
        $storedPass = $this->authPairs[$login][0] ?? null;
        if ($storedPass !== $pass) {
                return false;
        }
        $key = $this->authKeys[$login];
        if (!$key) {
                return false;
        }
        return $key;
    }
    public function checkAuthKey($login, $key)
    {
        $storedPass = $this->authKeys[$login] ?? null;
        if (!$storedPass) {
                return false;
        }
        if ($storedPass !== $key) {
                return false;
        }
        $level = 1;
        $storedPass = $this->authPairs[$login][1] ?? null;
        if ($storedPass == admin)
            $level = 2;
        return $level;
    }
}