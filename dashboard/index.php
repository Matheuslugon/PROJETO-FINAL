
<?php 
    session_start();
    if(!empty($_SESSION['isAuth']) &&  $_SESSION["isAuth"] == true){
        // session_unset();
?>

VOCE ESTA LOGADO PIRANHA!!!

<?php 
    }else{
        session_unset();
        return header('Location: ../index.php');
    }

?> 
