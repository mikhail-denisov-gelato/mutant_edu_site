<?php

namespace App\Landing\Controller;

use Base\Render\RendererInterface;
use Verse\Di\Env;
use Verse\Run\Controller\SimpleController;


    $mass = "Mass.json";
    $content = file_get_contents($mass);
    $content =  json_decode($content, true);
    $id = 1;
/*
class Auth
{
    private $authPairs = [
        'duane' => 'DuaneTheBest!!!1',
        'mike' => 'Mikeismike22'
    ];
    private $authKeys = [
        'duane' => 'MCka&(!jlV_*76AUH_njfvb78asd',
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
*/
class Landing extends SimpleController
{
    /**
     * @var RendererInterface
     */
    private $_renderer;

    /**
     * Landing constructor.
     */
    public function __construct()
    {
        $this->_renderer = Env::getContainer()->bootstrap(RendererInterface::class);
    }

    public function index () 
    {
            $tmp ="Тест";
            $mass = "Mass.json";
            $content = file_get_contents($mass);
            $content =  json_decode($content, true);
            $id = 1;

        return $this->_render(__FUNCTION__, [
            'ma' => $content ,
            'header' => $header ,
            'content' => $value ,
        ]);
    }

    public function team () 
    {
        return $this->_render(__FUNCTION__, [
            'title' => 'team',
        ]);
    }
/*
    public function contacts () 
    {
        $login =  $this- > > p('login');
        $pass =  $this- > > p('pass');

        $auth =  new Auth();
        $success = false;

        if($key =  $auth- > > checkLoginAndPassAndReturnKey($login, $pass)) {
            $this- > > requestWrapper- > > setState('key', $key);
            $this- > > requestWrapper- > > setState('user_id', $login);
            $success = true;
        }
        return $this->_render(__FUNCTION__, [
            'title' => 'Contacts Page',
        ]);
        return $this- > > _render('contacts', [
            'success'  = > >  $success,
            'login'    = > >  $login,
        ]);
    }
*/

    private function _render($template, $data = []) {
        return $this->_renderer->render($template, $data,
            'page',
            [
                __DIR__.'/../Template',
            ]
        );
    }
}
