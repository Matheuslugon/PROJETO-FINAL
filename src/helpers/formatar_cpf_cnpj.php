 <?php 

 function formatar_cpf_cnpj($doc) {

    $doc = preg_replace("/[^0-9]/", "", $doc);
    $qtd = strlen($doc);

    if($qtd === 11 ) {
            
        $docFormulario = substr($doc, 0 ,3) . '.' .
                         substr($doc, 3 ,3) . '.' .                     
                         substr($doc, 6 ,3) . '-' .  
                         substr($doc, 9 ,2) ;
    } else {
        
        $docFormulario = substr($doc, 0 ,2) . '.' .
                         substr($doc, 2 ,3) . '.' .                     
                         substr($doc, 5 ,3) . '/' .  
                         substr($doc, 8 ,4) ;

    }
    
    return $docFormulario;
 }