<?php
namespace App\Landing\Lib;


class Auth
{
    private $authPairs = [
        'duane' => '123',
        'mike' => 'Mikeismike22'
    ];
    private $authKeys = [
        'duane' => '123',
        'mike' => 'nMCYUW>KVB)0!VAgcaiAFSHCJB'
    ];
    public function checkLoginAndPassAndReturnKey($login, $pass)
    {
        $storedPass = $this->authPairs[$login] ?? null;
        if (!$storedPass) {
            return false;
        }
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
        return true;
    }
}