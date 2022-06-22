<?php

define('SERVER', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'telecall_db');

class DB{
    public function __construct(){
        $this->conn = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
        if ($this->conn->connect_error) die("Connection failed: " . $this->conn->connect_error);
        return $this->conn;
    }
}