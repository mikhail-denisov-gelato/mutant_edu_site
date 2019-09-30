<?php

namespace App\Landing\Controller;

use App\Landing\Lib\Auth;
use App\Landing\Lib\Users;
use App\Landing\Lib\Registration;
use Base\Render\RendererInterface;
use Verse\Di\Env;
use Verse\Run\Controller\SimpleController;
use Verse\Run\lib\adapter;


new adapter();
$pdo = adapter::get_connection();
$query = ("CREATE TABLE users_profile(login varchar(16) PRIMARY KEY, password varchar(16), role varchar(16));
");
$create =$pdo->exec($query);
if($create){
    echo "Create table";
}
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

        if($comment = $auth->checkLoginAndPassAndReturnKey($login, $pass)){
            $role = $auth->checkRole($login);
        }
        else{
            $comment = 'Неверный логин или пароль';
        };

        return $this->_render('auth', [
            'role' => $role,
            'login' => $login,
            'comment' => $comment,
        ]);
    }
    public function registration()
    {
        new adapter();
        $login = $this->p('login');
        $password = $this->p('password');
        $role ='user';
        $registration = new Registration();
        $comment = $registration->NewUserRegistration($login,$password,$role);
        print_r($comment);
        return $this->_render('registration', [
            'comment' => $comment,
        ]);
    }
    public function user()
    {
        
        $login = ['Savva'];
        new adapter();
        $pdo = adapter::get_connection();
        $column = $pdo->prepare("SELECT (password) FROM users_profile WHERE (login=?)");
        $column->execute($login);
        $result = $column->fetch(\PDO::FETCH_NAMED);
        $pass = $result['password'];
        print_r($pass);
        return $this->_render('user', [
            'login' => $pass,
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
