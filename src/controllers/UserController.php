<?php

    include "./src/entities/User.php";
    include "./src/helpers/formatar_cpf_cnpj.php";

    class UserController{

        private $db; // Variavel reservada a classe

        public function __construct($db) {
            $this->db = $db; // Atribui a variavel DB (Banco de dados) a variavel privada
        }

        function createUser($data){

            // Recebe os valores do formulario e realiza as validacoes (verifica se vazio)
            if(
                !empty($data['nome'])            && $data['nome'] != ""         &&
                !empty($data['nome_materno'])    && $data['nome_materno'] != "" &&
                !empty($data['data'])            && $data['data'] != ""         &&
                !empty($data['cpf'])             && $data['cpf'] != ""          &&
                !empty($data['celular'])         && $data['celular'] != ""      &&
                !empty($data['telefone'])        && $data['telefone'] != ""     &&
                !empty($data['endereco'])        && $data['endereco'] != ""     &&
                !empty($data['email'])           && $data['email'] != ""        &&
                !empty($data['senha'])           && $data['senha'] != ""        &&
                !empty($data['confirmar_senha']) && $data['senha'] != ""
            ){
     
                // Array com os dados de cadastro
                $userInfo = [
                    "nome"            => $data['nome'],
                    "nome_materno"    => $data['nome_materno'],
                    "data"            => $data['data'],
                    "cpf"             => formatar_cpf_cnpj($data['cpf']),
                    "celular"         => $data['celular'],
                    "telefone"        => $data['telefone'],
                    "endereco"        => $data['endereco'],
                    "email"           => $data['email'],
                    "senha"           => $data['senha'],
                    "confirmar_senha" => $data['confirmar_senha']
                ];
                
                // Caso passe das validacoes, cria o usuario fecha a conexao e redireciona para tela de login
                try{
                    $user = new User($this->db);
                    $user->create($userInfo);
                    
                }catch(Exception $e){
                    session_start();
                    $_SESSION["error"] ="E-mail ja cadastrado";
                    session_write_close();
                }   
                
                session_start();
                $_SESSION["success"] = "Usuario cadastrado com sucesso";
                return header('Location: ./index.php');
                session_write_close();
    
            }

            // Fecha a conexao e redireciona para tela de cadastro
            session_start();
            $_SESSION["error"] = "Erro ao cadastrar o usuário, verifique os campos e tente novamente";
            session_write_close();
            
        }
    }
?>