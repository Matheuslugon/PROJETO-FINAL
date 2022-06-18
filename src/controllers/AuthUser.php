<?php

    include "../database/connect.php";

    if(
        !empty($_POST['email']) && $_POST['email'] != ""  &&
        !empty($_POST['password']) && $_POST['password'] != ""
    ){

        $userLogin = [
            "email"     => $_POST['email'],
            "password"  => $_POST['password'],
        ];
        

        $conn = new DB();
        $selectUser = mysqli_query(
            $conn->conn, 
            "SELECT * FROM users WHERE email = '".$userLogin['email']."'"
        );

        $user = mysqli_fetch_assoc($selectUser);

        $conn->conn->close();

        if($user && password_verify($userLogin['password'], $user['password'])){
            session_start();
            $_SESSION["isAuth"] = true;
            return header('Location: ../../dashboard/index.php');
        }else{
            return header('Location: ../../index.php');
        }


    }

    // return header('Location: ../index.php');

?>