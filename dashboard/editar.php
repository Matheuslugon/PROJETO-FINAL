
<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);

    include "$root/telecall/src/database/connect.php";
    include "$root/telecall/src/entities/User.php";
    include "$root/telecall/src/controllers/UserController.php";

    session_start();
    $userID = $_SESSION['id'];
    $roleID = $_SESSION['role_id'];

    if(!empty($_SESSION['isAuth']) && $_SESSION["isAuth"] == true){

        $db = new DB();
        $userContr = new UserController($db);

        if($_GET && $_GET['id'] && $_GET['id'] != ""){
            $getUserId = $_GET['id'];

            if($roleID == 1 && $getUserId == $userID || $roleID == 2){
                $users = $userContr->getUserById($getUserId);
                if(empty($users)) return header("Location: ./index.php");
                $selectedUser = $users[0];
            }else{
                return header("Location: ./index.php");
            }
        
        }

        if($_POST){
            $updateUserId = $userContr->updateUser($_POST);
            return header("Location: ./editar.php?id=$updateUserId");
        }

        if($_GET && !array_key_exists('id', $_GET) || $_GET['id'] == "") {
            return header("Location: ./index.php");
        }
        
?>

<!DOCTYPE html> 
<html lang="pt-br">

    <?php include "$root/telecall/src/includes/header.php"; ?>
    <body>
        <div class="container">
            <?php include "$root/telecall/dashboard/includes/header.php"; ?>

            <div class="main">
                <div class="sidebar">
                    <?php include "$root/telecall/dashboard/includes/menu.php"; ?>
                </div>
                
                <div class="page-content">
                    <?php include "$root/telecall/src/includes/alerts.php"; ?>
                    <form class="form" method="POST" action="./editar.php">
                        <div class="card">
                            <div class="card-top">
                                <a href="http://localhost/telecall/dashboard" class="back-button">Voltar</a>
                                <div class="card-content">
                                    <h2 class="title2"> Editar usuário </h2>
                                </div>
                            </div> 

                            <input type="hidden" name="user_id" value="<?php echo $selectedUser['id']; ?>">
                            <div class="card-group">
                                <label>Nome</label>
                                <input name="nome" placeholder="Digite seu nome" type="text" required value="<?php echo $selectedUser['name']; ?>" />
                            </div> 

                            <div class="card-group">
                                <label>Data de Nascimento</label>
                                <input name="data" placeholder="Digite sua data de nascimento" type="date" required value="<?php echo $selectedUser['birthdate']; ?>"/>
                            </div> 

                            <div class="card-group">
                                <label>Nome materno</label>
                                <input name="nome_materno" placeholder="Digite seu Nome materno" type="text" required value="<?php echo $selectedUser['maternal_name']; ?>"/>
                            </div> 
                                
                            <div class="card-group">
                                <label>CPF</label>
                                <input id="cpf" name="cpf" maxlength="14" onkeypress="formatar_cpf(this, cpf)" placeholder="Digite seu CPF" type="text" value="<?php echo $selectedUser['cpf']; ?>" required/>
                            </div> 

                            <div class="card-group">
                                <label>Celular</label>
                                <input name="celular" placeholder="Digite seu celular" type="text" required value="<?php echo $selectedUser['cellphone']; ?>"/>
                            </div>

                            <div class="card-group">
                                <label>Telefone</label>
                                <input name="telefone" placeholder="Digite seu telefone" type="text" required value="<?php echo $selectedUser['phone']; ?>"/>
                            </div>

                            <div class="card-group">
                                <label>Endereço</label>
                                <input name="endereco" placeholder="Digite seu endereço" type="text" required value="<?php echo $selectedUser['address']; ?>"/>
                            </div>

                            <div class="card-group">
                                <label>E-mail</label>
                                <input name="email" placeholder="Digite seu e-mail" type="email" required value="<?php echo $selectedUser['email']; ?>"/>
                            </div>

                            <div class="card-group">
                                <button type="submit">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    Editar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?php 
    }else{
        return header("Location: $root/telecall/dashboard/index.php");
    }
?>