
<?php 
    include "../src/includes/header.php";
    session_start();
    var_dump($_SESSION);
    if(!empty($_SESSION['isAuth']) && $_SESSION["isAuth"] == true){
       

?> 

<?php 
    }else{
        session_destroy();
        return header('Location: ../index.php');
    }
?>