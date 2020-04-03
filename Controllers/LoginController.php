<?php

require_once 'Models/User.php';

class LoginController
{
    private $conn;
    private $template = 'views/login/template.php';
    private $content;
    public function __construct()
    {
        $this->conn = DB::create()->getConn();
    }

    public function login()
    {
        $user = User::whereEqual('name',$_POST['name']);
        if($user) {
            if(password_verify($_POST['psw'], $user->password)) {
                $session = CSRF::createToken();
                $cookie = CSRF::createToken();
                $user->update(compact(['session','cookie']));
                $this->setSession($user->id,$user->name,$user->session);
                creaCookie(['userId' => $user->id,
                                'cookie' => $cookie,
                ]);
                redirect();
            }
            else return $this->loginPage(['gen' => 'Password Errata']);

        }else
            return $this->loginPage(['gen' => 'Utente non trovato']);
    }
    public function loginPage($err = [])
    {
        $this->content = view('login/login',compact('err'));
    }

    public function logout()
    {
        $user = User::find($_SESSION['userId']);
        $user->update(['cookie' => null]);
        deleteCookie();
        session_destroy();
        redirect();
    }

    public function register()
    {
        $csrf = $_POST['csrf'];
        $name = $_POST['name'];
        $psw1 = $_POST['psw1'];
        $psw2 = $_POST['psw2'];

        if ($err = $this->checkFormRegistrazione($name, $csrf, $psw1, $psw2))
            return $this->registerPage($err);
        $sessionToken = CSRF::createToken();
        $user = new User();
        try {

        $user->create([
            'name' => $name,
            'password' => password_hash($psw1, PASSWORD_DEFAULT),
            'session' => $sessionToken,
        ]);
        $user->risorse = new Resource();
        $user->risorse->create(['user_id' => $user->id, 'last_update' => time()]);

    }catch (Exception $e) {
        if($e->getCode() == 23000) //nome utente già presente
            return $this->registerPage(['gen' => 'Questo utente è già presente']);
        else
            die($e->getMessage());
    }

        $this->setSession($user->id,$name, $sessionToken);
        redirect();

    }

    private function setSession($userid, $userName, $session)
    {
        $_SESSION['userId'] = $userid;
        $_SESSION['user'] = $userName;
        $_SESSION['token'] = $session;
    }

    public function registerPage(array $err = [])
    {
        $this->content = view('login/register', compact('err'));
    }

    public function display()
    {
        require $this->template;
    }

    public function passCheckRegistrazione()
    {
        $psw1 = $_POST['psw1'];
        $psw2 = $_POST['psw2'];
        if($psw1 !== $psw2)
            return 'Le password devono essere uguali';

        if(strlen($psw1) < 5)
            return 'La password deve essere almeno di 6 caratteri';

        return false;
    }
    public function checkFormRegistrazione()
    {
        $csrf = $_POST['csrf'];
        $name = $_POST['name'];
        $psw1 = $_POST['psw1'];
        $psw2 = $_POST['psw2'];
        if(!$name || !$psw1 || !$psw2 || !$csrf)
            return ['gen' => 'Non tutti i campi sono stati inseriti'];
        if(strlen($name) < 6)
            return ['name' => 'Il campo Nome deve avere almeno 6 caratteri'];
        if(!checkToken($csrf))
            return ['token' => 'Token mismatch'];
        if($err = $this->passCheckRegistrazione())
            return ['psw' => $err];
    }



}