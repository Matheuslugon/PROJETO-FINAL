<?php

    session_start();

    $root = realpath($_SERVER["DOCUMENT_ROOT"]);

    require "$root/telecall/src/database/connect.php";
    require "$root/telecall/src/controllers/AuthController.php";
    
    if($_POST){
        $db = new DB();
        $authController = new AuthController($db);
        $auth = $authController->autenticateUser($_POST);
        $db->conn->close();
    }

    if(array_key_exists('isAuth', $_SESSION)){
        return header("Location: ./dashboard/index.php");
    }
    
?>
<!DOCTYPE html> 
<html lang="pt-br">
    <?php require "$root/telecall/src/includes/header.php"; ?>
    <body>
        <?php include "$root/telecall/src/includes/alerts.php"; ?>
        <form class="form" method="POST" action="./index.php">
            <div class="card">
            <div class="card-top">
                <img class="imglogin" src="src/img/images.png" alt="">
                <h2 class="title"> Painel de controle</h2>
                <p class="descricao"> Comunidade para desenvolvedores</p>
                </div> 

            <div class="card-group">
                <label>Email</label>
                <input type="email" placeholder="Digite seu email" required name="email" />
            </div> 
    
            <div class="card-group">
                <label>Senha</label>
                <input type="password" placeholder="Digite sua senha" required name="password" />
            </div> 

            <div class="card-group">
                <label><input type="checkbox"> Lembre-me</label>
            </div>    
    
            <div class="card-group">
                <button type="submit">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    ACESSAR
                </button>
            </div>

            <div class="links">
                <a href="cadastrar.php"><p>Ainda não sou cadastrado</p></a>
            </div>
        </form>
    </body>
</html>
