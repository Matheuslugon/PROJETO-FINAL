
<?php

class AccessLogs {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    function create($data){

        $SQL = "INSERT INTO access_logs(
            user_id, 
            authentication_type_id, 
            logged, 
            created_at
        ) VALUES (
            ".$data['user_id'].",
            ".$data['authentication_type_id'].",
            0,
            '".date('Y-m-d H:i:s')."'
        );";

        mysqli_query($this->db->conn, $SQL);
        return $this->db->conn->insert_id;
        
    }

    function read($data){
        
        $SQL = "SELECT * FROM access_logs";

        if(array_key_exists('id', $data)){
            $SQL = "SELECT * FROM access_logs WHERE id=".$data['id']."";
        }
       
        if(array_key_exists('user_id', $data) && array_key_exists('logged', $data)){
            $SQL = "SELECT * FROM access_logs WHERE user_id=".$data['user_id']." AND logged=".$data['logged']." AND attempt_at IS NULL ORDER BY ID DESC LIMIT 1";
        }
        
        $result = mysqli_query($this->db->conn, $SQL);
        if($result) return mysqli_fetch_all($result, MYSQLI_ASSOC);
        return [];
    }

    function update($id, $user_id, $logged){
        $SQL ="UPDATE access_logs SET logged=$logged, attempt_at='".date('Y-m-d H:i:s')."' WHERE id=$id AND user_id=$user_id";
        mysqli_query($this->db->conn, $SQL);
    }

}

