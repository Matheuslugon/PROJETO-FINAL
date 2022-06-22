<?php

    include "./src/entities/User.php";

    class AuthController{
        
        private $db; // Variavel reservada a classe

        public function __construct($db) {
            $this->db = $db; // Atribui a variavel DB (Banco de dados) a variavel privada
        }

        function autenticateUser($data){

            // Realiza as validacoes de user e password (verifica se vazio)
            if(
                !empty($data['email']) && $data['email'] != "" &&
                !empty($data['password']) && $data['password'] != ""
            ){

                // Array com os dados de email e senha
                $userLogin = [
                    "email"     => $data['email'],
                    "password"  => $data['password'],
                ];
                
                try{
                    // Busca o email no banco de dados
                    $user = new User($this->db);
                    $resultUser = $user->read(['email' => $userLogin['email']]);
                    if($resultUser){
                        session_start();
                        $_SESSION["error"] = "E-mail já utilizado";
                        session_write_close();
                    }

                }catch(Exception $e){
                    session_start();
                    $_SESSION["error"] = "Erro interno, por favor tente novamente";
                    session_write_close();
                }
               
                // Verifica se existe o usuario e se a senha e igual
                if($resultUser && password_verify($userLogin['password'], $resultUser['password'])){
                    
                    // Inicia uma sessao e redireciona o usuario para o dashboad
                    session_start();
                    $_SESSION["verifyUserAuthentication"] = $resultUser['id'];
                    session_write_close();

                    return header('Location: ./autenticacao.php');

                }else{
                    session_start();
                    $_SESSION["error"] = "E-mail ou senha inválidos";
                    session_write_close();
                }
            }
        }
    }
?>