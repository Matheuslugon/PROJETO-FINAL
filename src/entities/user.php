
<?php

    class User {

        private $db;

        public function __construct($db) {
            $this->db = $db;
        }
            
        function create($user){

            $passwordHash = password_hash($user['senha'], PASSWORD_DEFAULT);
            
            return mysqli_query(
                $this->db->conn, 
                "INSERT INTO users (
                    name, 
                    birthdate, 
                    maternal_name, 
                    cpf, 
                    cellphone, 
                    phone, 
                    address, 
                    email, 
                    password
                ) 
                VALUES (
                    '".$user['nome']."', 
                    '".$user['data']."', 
                    '".$user['nome_materno']."', 
                    '".$user['cpf']."', 
                    '".$user['celular']."',  
                    '".$user['telefone']."',
                    '".$user['endereco']."',
                    '".$user['email']."',
                    '".$passwordHash."'
                )"
            );
        }

        function read($data){

            $SQL = "SELECT * FROM users";
            
            $selectQueries = [
                'id' => function($value){ return "SELECT * FROM users WHERE id=".$value.""; },
                'email' => function($value){ return "SELECT * FROM users WHERE email='".$value."'"; },
                'birthdate' => function($value){ return "SELECT * FROM users WHERE birthdate='".$value."'"; },
                'maternal_name' => function($value){ return "SELECT * FROM users WHERE maternal_name='".$value."'"; },
                'cpf' => function($value){ return "SELECT * FROM users WHERE cpf='".$value."'"; },
                'cellphone' => function($value){ return "SELECT * FROM users WHERE cellphone='".$value."'"; },
            ];

            foreach ($selectQueries as $k => $query) {
                if(array_key_exists($k, $data)){
                    $SQL = $selectQueries[$k]($data[$k]);
                }
            }

            $selectUser = mysqli_query($this->db->conn, $SQL);
            if($selectUser) return mysqli_fetch_assoc($selectUser);

            return [];
        }

        function update($user){

        }

        function delete($id){

        }
    }

