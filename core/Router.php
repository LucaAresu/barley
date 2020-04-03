<?php


class Router
{
    private $routes;
    public function __construct()
    {
        $this->routes = require 'config/routes.php';
    }

    public function dispatch()
    {
        $removeURL = '/progetti/browsergame/';
        $req = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestURL = str_replace($removeURL,'',$req);
        $method =  $_SERVER['REQUEST_METHOD'];

        if(array_key_exists($requestURL, $this->routes[$method]))
            return $this->handle($this->routes[$method][$requestURL]);
        else throw new Exception('Route not found');
    }

    public function handle($controllerMethod)
    {
        $params = explode('@',$controllerMethod);
        $controllerName = $params[0];
        $method = $params[1];
        require "Controllers/$controllerName.php";
        $controller = new $controllerName();
        $controller->$method();
        return $controller;
    }
}