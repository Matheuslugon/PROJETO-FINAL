<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);

    require "$root/telecall/src/entities/User.php";

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

                }catch(Exception $e){
                    $_SESSION["error"] = "Erro interno, por favor tente novamente";
                    session_write_close();
                }
                
                // Verifica se existe o usuario e se a senha e igual
                if(!empty($resultUser) && password_verify($userLogin['password'], $resultUser[0]['password'])){
                    
                    // Inicia uma sessao e redireciona o usuario para o dashboad
                    $_SESSION["verifyUserAuthentication"] = $resultUser[0]['id'];
                    session_write_close();
  
                    return header("Location: ./autenticacao.php");

                }else{
                    $_SESSION["error"] = "E-mail ou senha inválidos";
                    session_write_close();
                }
            }
        }
    }
?>