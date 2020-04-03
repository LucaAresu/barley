<?php
class DB {

    private $conn;
    private static $instance;

    private function __construct()
    {
        $data = require 'config/database.php';
        $dns = "mysql:host={$data['host']};dbname={$data['database']};charset={$data['charset']};";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try{
            $pdo = new PDO($dns,$data['username'],$data['password'], $options);
        }catch(PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        $this->conn = $pdo;
    }

    public static function create()
    {
        if(static::$instance === null)
            static::$instance = new static();
        return static::$instance;
    }

    public function getConn()
    {
        return $this->conn;
    }


}

