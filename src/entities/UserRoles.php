
<?php

class UserRoles {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    function read($data){
        $SQL = "SELECT * FROM user_roles";
            
        $selectQueries = [
            'id' => function($value){ return "SELECT * FROM user_roles WHERE id=$value"; },
            'user_id' => function($value){ return "SELECT * FROM user_roles WHERE user_id=$value"; },
            'role_id' => function($value){ return "SELECT * FROM user_roles WHERE role_id=$value"; },
        ];

        foreach ($selectQueries as $k => $query) {
            if(array_key_exists($k, $data)){
                $SQL = $selectQueries[$k]($data[$k]);
            }
        }

        $selectUser = mysqli_query($this->db->conn, $SQL);
        if($selectUser) return mysqli_fetch_all($selectUser, MYSQLI_ASSOC);

        return [];
    }
        
    function create($id){
        return mysqli_query(
            $this->db->conn, 
            "INSERT INTO user_roles (
                user_id, 
                role_id
            ) 
            VALUES (
                $id, 
                1
            )"
        );
    }

    function delete($id){
        return mysqli_query(
            $this->db->conn, 
            "DELETE FROM user_roles WHERE user_id=$id"
        );
    }
}

