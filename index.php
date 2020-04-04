<?php
session_start();
spl_autoload_register(function ($className) {
    require_once 'Models/'.$className.'.php';
});
$homeURL = '/progetti/browsergame/';
require_once 'boot.php';
if(!$_SESSION['token']) {
    $token = CSRF::createToken();
    $_SESSION['token'] = $token;
}

try {
    $router = new Router();
    $controller = $router->dispatch();
    $controller->display();
}catch(Exception $e) {
    echo $e->getMessage();
}
?>


