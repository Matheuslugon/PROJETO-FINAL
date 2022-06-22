<?php 

include "./src/entities/AuthenticationType.php";
include "./src/entities/AccessLogs.php";

include "./src/entities/User.php";

include "./src/helpers/valida_cpf.php";
include "./src/helpers/valida_telefone.php";
include "./src/helpers/formatar_cpf_cnpj.php";

class TwoFactorVerification{

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getVerification($userId){
        try{
            $authenticationType = new AuthenticationType($this->db);
            $methods = $authenticationType->read(null);
            
            $accessLogs = new AccessLogs($this->db);
            $existLogs = $accessLogs->read(['user_id' => $userId, 'logged' => 0]);

            if(empty($existLogs)){
                $shortIndex = array_rand($methods);
                $method = $methods[$shortIndex];

                $authObj = [
                    'user_id' => $userId,
                    'authentication_type_id' => $method[0]
                ];

                $log = $accessLogs->create($authObj);
                $method["log_id"] = $log;

                return $method;

            }else{
                $seconds = 1800; // 30 mins
                $time1 = strtotime($existLogs[0][4]) + $seconds;

                if(time() >= $time1) {
                    $accessLogs->update($existLogs[0][0], $userId, 0);
                    $_SESSION["error"] = "Autenticação expirada";
                    session_destroy();
                    return header('Location: ./index.php');
                }else{
                    $getMethod = $authenticationType->read($existLogs[0][2]);
                    $getMethod[0]['log_id'] = $existLogs[0][0];
                    return $getMethod[0];
                }
            }
  
        }catch(Exception $e){
            $_SESSION["error"] ="Erro ao buscar o tipo de autenticação";
            session_destroy();
            return header('Location: ./index.php');
        }
    }

    public function verify($id, $data){
        if(
            $id && !is_null($id) && $data && !empty($data) &&
            !empty($data['log_id']) && $data['log_id'] != '' &&
            !empty($data['value']) && $data['value'] != ''
        ){
            $authenticationType = new AuthenticationType($this->db);
            $accessLogs = new AccessLogs($this->db);

            $existLogs = $accessLogs->read(['id' => $data['log_id']]);
            $methodId = $existLogs[0][2];

            $method = $authenticationType->read($methodId);
            $validationKey = $method[0][1];

            $validations = [
                'CPF' => [
                    'DB_KEY' => 'cpf',
                    'VALIDATION' => function ($value) {
                        return true;
                    }
                ],
                'BIRTH_DATE' => [
                    'DB_KEY' => 'birthdate',
                    'VALIDATION' => function ($value) {
                        return true;
                    }
                ],
                'CELLPHONE' => [
                    'DB_KEY' => 'cellphone',
                    'VALIDATION' => function ($value) {
                        return true;
                    }
                ],
                'MATERNAL_NAME' => [
                    'DB_KEY' => 'maternal_name',
                    'VALIDATION' => function ($value) {
                        return true;
                    }
                ],
            ];

            if(array_key_exists($validationKey, $validations)){
                $validationObj = $validations[$validationKey];
                
                $user = new User($this->db);
                $user = $user->read(['id' => $id]);
                $getUserValueByValidation = $user[$validationObj['DB_KEY']];

                $formValue = $validationObj['DB_KEY'] == 'cpf' ? formatar_cpf_cnpj($data['value']) : $data['value'];
                
                if($validationObj['VALIDATION']($data['value']) && $formValue == $getUserValueByValidation){
                    $accessLogs->update($existLogs[0][0], $id, 1);
                    session_destroy();

                    session_start();
                    $_SESSION["isAuth"] = true;
                    session_write_close();

                    return header('Location: ./dashboard/index.php');
                }else{
                    $_SESSION["error"] = "Valor incorreto";
                    session_write_close();
                }
            }else{

                $_SESSION["error"] = "Valor incorreto";
                session_write_close();
            }
        }else{
            session_destroy();
            return header('Location: ./index.php');
        }
    }
}