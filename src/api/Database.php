<?php

namespace api;
class Database
{

    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'Practic';
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}