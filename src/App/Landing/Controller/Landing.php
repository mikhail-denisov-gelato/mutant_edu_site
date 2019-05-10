<?php

namespace App\Landing\Controller;

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

    public function contacts () 
    {
        return $this->_render(__FUNCTION__, [
            'title' => 'Contacts Page',
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
