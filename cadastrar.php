<?php
    session_start();
    
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);

    require "$root/telecall/src/entities/User.php";
    require "$root/telecall/src/database/connect.php";
    require "$root/telecall/src/controllers/UserController.php";

    if($_POST){
        
        $db = new DB();
        $userController = new UserController($db);
        $auth = $userController->createUser($_POST);
        $db->conn->close();
    }
?>

<!DOCTYPE html> 
    <html lang="pt-br">
    <?php include "$root/telecall/src/includes/header.php"; ?>

    <body>
        <?php include "$root/telecall/src/includes/alerts.php"; ?>
        <form class="form" method="POST" action="./cadastrar.php">
            <div class="card">
                <div class="card-top">
                    <a href="/telecall" class="back-button">Voltar</a>
                    <div class="card-content">
                        <img class="imglogin" src="./src/img/images.png" alt="">
                        <h2 class="title2"> Cadastro</h2>
                    </div>
                </div> 

                <div class="card-group">
                    <label>Nome</label>
                    <input name="nome" placeholder="Digite seu nome" type="text" required />
                </div> 

                <div class="card-group">
                    <label>Data de Nascimento</label>
                    <input name="data" placeholder="Digite sua data de nascimento" type="date" required />
                </div> 

                <div class="card-group">
                    <label>Nome materno</label>
                    <input name="nome_materno" placeholder="Digite seu Nome materno" type="text" required />
                </div> 
                    
                <div class="card-group">
                    <label>CPF</label>
                    <input id="cpf" name="cpf" maxlength="14" onkeypress="formatar_cpf(this, cpf)" placeholder="Digite seu CPF" type="text" required/>
                </div> 

                <div class="card-group">
                    <label>Celular</label>
                    <input name="celular" placeholder="Digite seu celular" type="text" required />
                </div>

                <div class="card-group">
                    <label>Telefone</label>
                    <input name="telefone" placeholder="Digite seu telefone" type="text" required />
                </div>
                
                <div class="card-group">
                    <label>Endereço</label>
                    <input name="endereco" placeholder="Digite seu endereço" type="text" required />
                </div>

                <div class="card-group">
                    <label>E-mail</label>
                    <input name="email" placeholder="Digite seu e-mail" type="email" required />
                </div>

                <div class="card-group">
                    <label>Senha</label>
                    <input name="senha" placeholder="Digite sua senha" type="password" required />
                </div> 
                
                <div class="card-group">
                    <label>Confirme a Sua Senha</label>
                    <input name="confirmar_senha" placeholder="Confirme a sua senha" type="password" required />
                </div> 
        
                <div class="card-group">
                    <button type="submit" >
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Cadastrar
                    </button>
                </div>
            </div>
        </form>
    </body>
</html>
