
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

        function read(){
            
        }

        function update($user){

        }

        function delete($id){

        }
    }

