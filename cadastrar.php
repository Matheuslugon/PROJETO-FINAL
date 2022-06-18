<?php 
    if(isset($_GET['error']) && $_GET['error'] == 400){
        echo "Dados incompletos";
    }

?>

<!DOCTYPE html> 
    <html lang="pt-br">
    <head>
        <meta charset="UT-8">
        <meta name="viewport" content="width=device-width, initial-sacale=1.0">
        <meta http-equiv="X-UA-compatible" content="ie=edge">
        <title> acesso</title>
        <link rel="stylesheet" href="./src/css/style.css">
        <script src="./src/js/formatar_cpf.js"></script>
    </head>

    <body> 
        
        <form class="form" method="POST" action="./src/controllers/CreateUser.php">
            <div class="card">
                <div class="card-top">
                    <img class="imglogin" src="./src/img/images.png" alt="">
                    <h2 class="title2"> Cadastro</h2>   
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
                    <input id="cpfcnpj" name="cpfcnpj" maxlength="15" placeholder="Digite seu CPF" type="text" required onkeyup="mascara_cpf()"/>
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