<?php

namespace App\Landing\Controller;

use App\Landing\Lib\Auth;
use App\Landing\Lib\Users;
use Base\Render\RendererInterface;
use Verse\Di\Env;
use Verse\Run\Controller\SimpleController;
use Verse\Run\lib\adapter;
/*
$host = 'database';
$port = '5432';
$db   = 'users_db1';
$user = 'postgres';
$pass = 'postgres';
$dsn = "pgsql:host=$host;port=$port;dbname=$db;user=$user;password=$pass";
$pdo = new \PDO($dsn);
$login = ['Savva'];
$password = ['123'];
if($dsn){
echo "Connected to the <strong>$db</strong> database successfully!";
}
$upt =$pdo->prepare("UPDATE users_profile SET (password = ?) WHERE (login = ?)");
$upt->execute([$password, $login]);
$data = [ 'Savva', '123', 'Admin' ];
$sql = "INSERT INTO users_profile (login, password, role) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute($data);

$column = $pdo->prepare("SELECT (password) FROM users_profile WHERE (login=?)");
$column->execute($login);
$result = $column->fetch(\PDO::FETCH_NAMED);
print_r ($result);
$password = $result['password'];
*/
//    $mass = "Mass.json";
//    $content = file_get_contents($mass);
//    $content =  json_decode($content, true);
//    $id = 1;
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

 /*   public function index ()
    {
            $tmp ="Тест";
            $mass = "Mass.json";
            $content = file_get_contents($mass);
            $content =  json_decode($content, true);
            $id = 1;
    }*/

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
        $level = false;

        if ($key = $auth->checkLoginAndPassAndReturnKey($login, $pass)) {
            $this->requestWrapper->setState('key', $key);
            $this->requestWrapper->setState('user_id', $login);
            $this->requestWrapper->setState('level', $level);

        }
        return $this->_render('auth', [
            'level' => $auth->checkAuthKey($login, $key),
            'login' => $login,
        ]);
    }
    public function user()
    {
        db_connection::get_connection();
        $column = $pdo->prepare("SELECT (password) FROM users_profile WHERE (login=?)");
        $column->execute($login);
        $result = $column->fetch(\PDO::FETCH_NAMED);
        $password = $result['password'];
        echo "$password";
        return $this->_render('user', [
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
