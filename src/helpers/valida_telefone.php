<?php 


function validaTelefone($telefone)
{
    $regex = '/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/';

    if (preg_match($regex, $telefone) == false) {

        // O número não foi validado.
        return false;
    } else {

        // Telefone válido.
        return true;
    }        
}