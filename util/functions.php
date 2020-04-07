<?php
function view($path, $data = []) {
    extract($data);
    ob_start();
    require 'views/'.$path.'.php';
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

function redirect($location = null) {
    if($location === null) {
        global $homeURL;
        $location = $homeURL;
    }
    Header("Location: $location");
}
function auth() {
    if(isset($_COOKIE['barley_user'])) {
        $cookie = json_decode($_COOKIE['barley_user']);
        $user = User::find($cookie->userId);
        if($user->cookie === $cookie->cookie) {
            $_SESSION['userId'] = $user->id;
            $_SESSION['user'] = $user->name;
            $_SESSION['token'] = CSRF::createToken();
            return true;
        }
    }
    if($_SESSION['userId']) {
        $user = User::find($_SESSION['userId']);
        if($user)
            if($user->name === $_SESSION['user'] && $user->session === $_SESSION['token'])
                return true;
    }
    return false;
}

function requiredLogin() {
    if(!auth())
        redirect('login');
}

function checkToken($token) {
    return $token === $_SESSION['token'];
}

function error($err, $index)
{
    if($err[$index])
        return "<p class='error'>$err[$index]</p>";
}

function creaCookie(array $arr){
    $cookie = json_encode($arr);
    setcookie('barley_user',$cookie, strtotime('+30 days'));
}
function deleteCookie() {
    setcookie('barley_user','', 0);
}
function getAuthUser()
{
    return User::find($_SESSION['userId']);
}

function dump($something)
{
    echo '<pre>';
    var_dump($something);
    echo '</pre>';
}

function errorMessage($str = '')
{
    $str = $str ?? 'Errore Generico';
    require_once 'Controllers/GameController.php';
    $con = new GameController();
    $con->errorMessage($str);
    $con->display();
}