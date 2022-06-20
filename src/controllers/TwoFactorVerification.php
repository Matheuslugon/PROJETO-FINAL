<?php 

class TwoFactorVerification{

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getVerification(){
        $methods = $this->getsortMethod();
        $shortIndex = array_rand($methods);
        return $methods[$shortIndex];
    }

    private function getsortMethod(){
        $selectMethods = $selectUser = mysqli_query($this->db->conn, "SELECT * FROM athentication_type");
        return mysqli_fetch_all($selectMethods);
    }
}