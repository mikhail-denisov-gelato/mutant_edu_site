<?php

namespace App\Landing\Controller;

use App\Landing\Lib\Auth;
use Base\Render\RendererInterface;
use Verse\Di\Env;
use Verse\Run\Controller\SimpleController;


    $mass = "Mass.json";
    $content = file_get_contents($mass);
    $content =  json_decode($content, true);
    $id = 1;


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
    }

    public function team () 
    {
        return $this->_render(__FUNCTION__, [
            'title' => 'team',
        ]);
    }

    public function auth()
    {
        $login = $this->p('login');
        $pass = $this->p('pass');
        
        $auth = new Auth();
        $success = false;

        if ($key = $auth->checkLoginAndPassAndReturnKey($login, $pass)) {
            $this->requestWrapper->setState('key', $key);
            $this->requestWrapper->setState('user_id', $login);
            $success = true;
        }
        return $this->_render('auth', [
            'success' => $success,
            'login'   => $login,
        ]);
    }


    private function _render($template, $data = []) {
        return $this->_renderer->render($template, $data,
            'page',
            [
                __DIR__.'/../Template',
            ]
        );
    }
}
