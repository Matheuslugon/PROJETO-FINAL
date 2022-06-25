<?php
    class DashboardController{
        
        private $db; // Variavel reservada a classe

        public function __construct($db) {
            $this->db = $db; // Atribui a variavel DB (Banco de dados) a variavel privada
        }

        public function exportLogsCsvData(){

            $log = new AccessLogs($this->db);
            $logs = $log->read([]);

            if(count($logs) > 0){ 
                $delimiter = ","; 
                $filename = "logs-data_" . date('Y-m-d') . ".csv"; 
                 
                $f = fopen('php://memory', 'w'); 
                
                $fields = ['id', 'user_id', 'authentication_type_id', 'logged', 'attempt_at']; 
                fputcsv($f, $fields, $delimiter); 

                foreach ($logs as $k => $userData) {
                    $lineData = [
                        $userData['id'], 
                        $userData['user_id'], 
                        $userData['authentication_type_id'], 
                        $userData['logged'], 
                        $userData['attempt_at']
                    ]; 
                    fputcsv($f, $lineData, $delimiter); 
                }

                fseek($f, 0); 
                  
                header('Content-Type: text/csv'); 
                header('Content-Disposition: attachment; filename="' . $filename . '";'); 
                 
                fpassthru($f); 
            } 
            
            exit; 
        }
    }
?>