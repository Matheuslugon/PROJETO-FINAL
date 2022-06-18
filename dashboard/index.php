
<?php 
    session_start();
    if(!empty($_SESSION['isAuth']) &&  $_SESSION["isAuth"] == true){
        // session_unset();
?>

<?php 
    }else{
        session_unset();
        return header('Location: ../index.php');
    }

?> 
