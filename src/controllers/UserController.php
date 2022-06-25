<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/telecall/src/helpers/formatar_cpf_cnpj.php";
    require "$root/telecall/src/entities/UserRoles.php";

    class UserController{

        private $db; // Variavel reservada a classe

        public function __construct($db) {
            $this->db = $db; // Atribui a variavel DB (Banco de dados) a variavel privada);
        }
        
        public function getAllUsers(){
            $user = new User($this->db);
            return $user->read([]);
        }

        public function getUserById($id){
            $user = new User($this->db);
            return $user->read(['id' => $id]);
        }

        public function createUser($data){

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
                    "nome_materno"    => trim($data['nome_materno']),
                    "data"            => $data['data'],
                    "cpf"             => formatar_cpf_cnpj(trim($data['cpf'])),
                    "celular"         => (int) trim($data['celular']),
                    "telefone"        => (int) trim($data['telefone']),
                    "endereco"        => $data['endereco'],
                    "email"           => trim($data['email']),
                    "senha"           => $data['senha'],
                    "confirmar_senha" => $data['confirmar_senha']
                ];

                var_dump($userInfo);
                
                // Caso passe das validacoes, cria o usuario fecha a conexao e redireciona para tela de login
                try{
                    $user = new User($this->db);
                    $userRoles = new UserRoles($this->db);
                    $userId = $user->create($userInfo);
                    $userRoles->create($userId);

                    $_SESSION["success"] = "Usuario cadastrado com sucesso";
                    session_write_close();
                    return header("Location: ./index.php");
                    
                }catch(Exception $e){
                    $_SESSION["error"] ="E-mail ja cadastrado";
                    session_write_close();
                    return header("Location: ./index.php");
                }
            }

            // Fecha a conexao e redireciona para tela de cadastro
            $_SESSION["error"] = "Erro ao cadastrar o usuário, verifique os campos e tente novamente";
            session_write_close();
            
        }

        public function updateUser($data){
            if(!empty($data['user_id']) && $data['user_id'] != ""){
                if(
                
                    !empty($data['nome'])            && $data['nome'] != ""         &&
                    !empty($data['nome_materno'])    && $data['nome_materno'] != "" &&
                    !empty($data['data'])            && $data['data'] != ""         &&
                    !empty($data['cpf'])             && $data['cpf'] != ""          &&
                    !empty($data['celular'])         && $data['celular'] != ""      &&
                    !empty($data['telefone'])        && $data['telefone'] != ""     &&
                    !empty($data['endereco'])        && $data['endereco'] != ""     &&
                    !empty($data['email'])           && $data['email'] != ""        
                ){
         
                    // Array com os dados de cadastro
                    $userInfo = [
                        "nome"            => $data['nome'],
                        "nome_materno"    => trim($data['nome_materno']),
                        "data"            => $data['data'],
                        "cpf"             => formatar_cpf_cnpj(trim($data['cpf'])),
                        "celular"         => trim($data['celular']),
                        "telefone"        => trim($data['telefone']),
                        "endereco"        => $data['endereco'],
                        "email"           => trim($data['email']),
                    ];
                    
                    try{
                        $user = new User($this->db);
                        $user->update($data['user_id'], $userInfo);

                        $_SESSION["success"] = "Usuario atualizado com sucesso";
                        session_write_close();
                        return $data['user_id'];

                    }catch(Exception $e){
                        $_SESSION["error"] ="Erro ao fazer a atualização";
                        session_write_close();
                        return header("Location: ./desktop/editar.php?id=".$data['id']."");
                    }  
                   
                }
    
                $_SESSION["error"] = "Dados incorretos";
                session_write_close();
                return header("Location: ./dashboard/editar.php?id=".$data['id']."");
            }
            
            return header("Location: ./dashboard/index.php");
        }

        public function deleteUser($id){
            try{
                $user = new User($this->db);
                $userRoles = new UserRoles($this->db);

                $userRoles->delete($id);
                $user->delete($id);

                $_SESSION["success"] = "Usuario deletado com sucesso";
                session_write_close();

                return header("Location: ./index.php");
                
            }catch(Exception $e){
                $_SESSION["error"] = "Erro ao deletar o usuário";
                session_write_close();
                
                return header("Location: ./index.php");
            }      
        }
    }
?>