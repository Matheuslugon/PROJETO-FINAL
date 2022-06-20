<?php

    include "../database/connect.php";
    include "../entities/user.php";
    include "../helpers/formatar_cpf_cnpj.php";

    if(
        !empty($_POST['nome'])            && $_POST['nome'] != ""         &&
        !empty($_POST['nome_materno'])    && $_POST['nome_materno'] != "" &&
        !empty($_POST['data'])            && $_POST['data'] != ""         &&
        !empty($_POST['cpf'])             && $_POST['cpf'] != ""          &&
        !empty($_POST['celular'])         && $_POST['celular'] != ""      &&
        !empty($_POST['telefone'])        && $_POST['telefone'] != ""     &&
        !empty($_POST['endereco'])        && $_POST['endereco'] != ""     &&
        !empty($_POST['email'])           && $_POST['email'] != ""        &&
        !empty($_POST['senha'])           && $_POST['senha'] != ""        &&
        !empty($_POST['confirmar_senha']) && $_POST['senha'] != ""
    ){

        $userInfo = [
            "nome"            => $_POST['nome'],
            "nome_materno"    => $_POST['nome_materno'],
            "data"            => $_POST['data'],
            "cpf"             => formatar_cpf_cnpj($_POST['cpf']),
            "celular"         => $_POST['celular'],
            "telefone"        => $_POST['telefone'],
            "endereco"        => $_POST['endereco'],
            "email"           => $_POST['email'],
            "senha"           => $_POST['senha'],
            "confirmar_senha" => $_POST['confirmar_senha']
        ];

        $conn = new DB();
        $user = new User($conn);
        $user->create($userInfo);
        $conn->conn->close();

        return header('Location: ../../index.php');

    }

    return header('Location: ../../cadastrar.php');

?>