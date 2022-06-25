<?php
   session_start();
   
   $root = realpath($_SERVER["DOCUMENT_ROOT"]);
   
   if($_SESSION && !empty($_SESSION['verifyUserAuthentication'])){
      
      require "$root/telecall/src/controllers/TwoFactorVerification.php";
      require "$root/telecall/src/database/connect.php";

      $conn = new DB();
      $auth = new TwoFactorVerification($conn);
      $userID = $_SESSION['verifyUserAuthentication'];
      $method = $auth->getVerification($userID);

      if(!empty($_POST)){
         $auth->verify($userID, $_POST);
      }
   
   }else{
      session_destroy();
      return header("Location: ./index.php");
   }

?>

<!DOCTYPE html> 
<html lang="pt-br">
   <?php include "$root/telecall/src/includes/header.php"; ?>
   <body>
      <?php include "$root/telecall/src/includes/alerts.php"; ?>
      <form class="form" action="./autenticacao.php" method="post">
         <div class="card">
            <div class="card-top">
               <img class="imglogin" src="./src/img/images.png" alt="">
               <h2 class="title"></h2>
               <p class="descricao-validacao">Autentificação dois fatores</p>
               <p class="descricao-validacao">Você deve responder corretamente em até 60 segundos</p>
            </div>
            <div class="card-group bloco-validacao">
               <label><?php echo $method[2]; ?></label>
               <input type="hidden" name="log_id" value="<?php echo $method['log_id']; ?>" required />
               <input 
                  name="value" 
                  type="<?php echo $method[3]; ?>" 
                  placeholder="" 
                  maxlength="<?php echo $method[1] == 'FIRST_THREE_CPF' || $method[1] == 'LAST_THREE_CPF' ? 3 : 100; ?>" 
                  required />
            </div>
            <div class="continue-valid">
               <button class="cta" type="submit">
                  <span class="hover-underline-animation"> Continue </span>
                  <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10" viewBox="0 0 46 16">
                     <path id="Path_10" data-name="Path 10" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" transform="translate(30)"></path>
                  </svg>
               </button>
            </div>
         </div>
      </form>
   </body>
</html>