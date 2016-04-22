<?php

define('ROOT', dirname(__DIR__));
require ROOT . '/app/App.php';
App::load();

if(isset($_GET['p'])){
    $p = $_GET['p'];
} else {
    $p = 'users.login';
}

$page = explode('.', $p);

if($page[0] === 'admin'){
    $controller = '\App\Controller\Admin\\' . ucfirst($page[1]) . 'Controller';
    $action = $page[2];
} else {
    $controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
    $action = $page[1];
}

$controller = new $controller();
if(method_exists($controller, $action)){
    $controller->$action();
} else {
    $c = new \Core\Controller\Controller();
    $c->notFound();
}
