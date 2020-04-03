<?php


class GameController
{
    private $content;
    private $template = 'views/template/template.php';


    public function __construct()
    {

    }

    public function index()
    {
        $this->content = "<br><br>a<br>a<br>a<br>a<br>a<br>";
    }

    public function display()
    {
        require $this->template;
    }


}