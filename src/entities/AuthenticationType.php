
<?php

class AuthenticationType {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    function read($id){

        $SQL = "SELECT * FROM athentication_type";
        if($id) $SQL = "SELECT * FROM athentication_type WHERE id=$id";

        $selectMethods = mysqli_query($this->db->conn, $SQL);
        return mysqli_fetch_all($selectMethods);
        
    }

}

