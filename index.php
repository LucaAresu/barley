<?php
session_start();
spl_autoload_register(function ($className) {
    require_once 'Models/'.$className.'.php';
});
$vinto = false;
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
}catch(PDOException $e) {
    errorMessage('Errore generico al Database<br>'.$e->getMessage());
}catch(Exception $e){
    if($e->getCode() == 404)
        errorMessage('Questa pagina non è stata trovata');
    else
        errorMessage();
}
?>


