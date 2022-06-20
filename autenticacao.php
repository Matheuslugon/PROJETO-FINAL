<?php

    include "./src/controllers/TwoFactorVerification.php";
    include "./src/database/connect.php";

    $conn = new DB();
    $auth = new TwoFactorVerification($conn);
    $method = $auth->getVerification();

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
      <form class="form" action="">
         <div class="card">
         <div class="card-top">
            <img class="imglogin" src="./src/img/images.png" alt="">
            <h2 class="title"></h2>
            <p class="descricao-validacao"> Autentificação dois fatores</p>
         </div>
         <div class="card-group bloco-validacao">
            <label><?php echo $method[2]; ?></label>
            <input name="<?php echo $method[1]; ?>" type="<?php echo $method[3]; ?>" placeholder="" required>
         </div>
         <div class="continue-valid">
            <button class="cta" type="button">
               <span class="hover-underline-animation"> Continue </span>
               <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10" viewBox="0 0 46 16">
                  <path id="Path_10" data-name="Path 10" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" transform="translate(30)"></path>
               </svg>
            </button>
         </div>
      </form>
   </body>
</html>