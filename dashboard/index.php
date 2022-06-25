
<?php 
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);

    require "$root/telecall/src/database/connect.php";
    require "$root/telecall/src/controllers/UserController.php";
    require "$root/telecall/src/controllers/DashboardController.php";
    require "$root/telecall/src/entities/User.php";
    require "$root/telecall/src/entities/AccessLogs.php";
    
    session_start();
    $userID = $_SESSION['id'];
    $roleID = $_SESSION['role_id'];

    if(!empty($_SESSION['isAuth']) && $_SESSION["isAuth"] == true){

        if($_GET && array_key_exists('logout', $_GET) && $_GET['logout'] == true){
            session_destroy();
            return header("Location: ../index.php");
        }

        $db = new DB();
        $userContr = new UserController($db);

        if($_GET && array_key_exists('export', $_GET) && $_GET['export'] == true && $roleID == 2){
            $dashContr = new DashboardController($db);
            $dashContr->exportLogsCsvData();
        }
        
        if($_POST && array_key_exists('delete_id', $_POST) && $_POST['delete_id'] != '' && $roleID == 2){
            $users = $userContr->deleteUser($_POST['delete_id']);
        }
        
        $users = $userContr->getAllUsers();
        
?>

<!DOCTYPE html> 
<html lang="pt-br">
    <?php include "$root/telecall/src/includes/header.php"; ?>
    <body>
        <div class="container">
           

            <div class="main">
                <div class="sidebar">
                    <?php include "$root/telecall/dashboard/includes/menu.php"; ?>
                </div>
                
                <div class="page-content">
                    <?php include "$root/telecall/src/includes/alerts.php"; ?>
                    <div class="og-contianer">
                        <div class="og-row og-li og-li-head">
                            <div class="og-li-col">#</div>
                            <div class="og-li-col">Nome</div>
                            <div class="og-li-col">Telefone</div>
                            <div class="og-li-col">Celular</div>
                            <div class="og-li-col">Data nasc.</div>
                            <div class="og-li-col">CPF</div>
                            <div class="og-li-col">E-mail</div>
                            <div class="og-li-col">Endereço</div>
                            <div class="og-li-col">Nome materno</div>
                            <div class="og-li-col">Ação</div>
                        </div>

                        <?php 
                            foreach ($users as $k => $user) {
                                if($roleID == 1 && $user['id'] == $userID){
                        ?>
                                    <div class="data-row og-row og-li">
                                        <div class="og-li-col"><?php echo $k; ?></div>
                                        <div class="og-li-col"><?php echo $user['name']; ?></div>
                                        <div class="og-li-col"><?php echo $user['phone']; ?></div>
                                        <div class="og-li-col"><?php echo $user['cellphone']; ?></div>
                                        <div class="og-li-col"><?php echo $user['birthdate']; ?></div>
                                        <div class="og-li-col"><?php echo $user['cpf']; ?></div>
                                        <div class="og-li-col"><?php echo $user['email']; ?></div>
                                        <div class="og-li-col"><?php echo $user['address']; ?></div>
                                        <div class="og-li-col"><?php echo $user['maternal_name']; ?></div>
                                        <div class="og-li-col">
                                            <button class="button" type="button" onclick="location.href = './editar.php?id=<?php echo $user['id'];?>'">Editar</button>
                                            <?php if($userID !== $user['id']){ ?>
                                                <form action="./index.php" method="POST">
                                                    <input type="hidden" name="delete_id" value="<?php echo $user['id'];?>">
                                                    <button class="button" type="submit">Deletar</button>
                                                </form>
                                            <?php } ?>
                                        </div>
                                    </div>
                        <?php 
                                }

                                if($roleID == 2){

                        ?>
                                    <div class="data-row og-row og-li">
                                        <div class="og-li-col"><?php echo $k; ?></div>
                                        <div class="og-li-col"><?php echo $user['name']; ?></div>
                                        <div class="og-li-col"><?php echo $user['phone']; ?></div>
                                        <div class="og-li-col"><?php echo $user['cellphone']; ?></div>
                                        <div class="og-li-col"><?php echo $user['birthdate']; ?></div>
                                        <div class="og-li-col"><?php echo $user['cpf']; ?></div>
                                        <div class="og-li-col"><?php echo $user['email']; ?></div>
                                        <div class="og-li-col"><?php echo $user['address']; ?></div>
                                        <div class="og-li-col"><?php echo $user['maternal_name']; ?></div>
                                        <div class="og-li-col">
                                            <button class="button" type="button" onclick="location.href = './editar.php?id=<?php echo $user['id'];?>'">Editar</button>
                                            <?php if($userID !== $user['id']){ ?>
                                                <form action="./index.php" method="POST">
                                                    <input type="hidden" name="delete_id" value="<?php echo $user['id'];?>">
                                                    <button class="button" type="submit">Deletar</button>
                                                </form>
                                            <?php } ?>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        ?>
                        
                        <div id="no-match" class="no-match og-li  text-center hide">Sorry, No Student Matches your Criteria</div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php 
    }else{
        session_destroy();
        return header("Location: ./index.php");
    }
?>