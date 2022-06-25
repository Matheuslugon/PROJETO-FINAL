<?php
    $request = $_SERVER['REQUEST_URI'];

    $title = "Telecall";
    
    $nameRoute = [
        "/telecall/" => "Telecall - Login",
        "/telecall/cadastrar.php" => "Telecall - Cadastrar",
        "/telecall/autenticacao.php" => "Telecall - Autenticação",
        "/telecall/dashboard/index.php" => "Telecall - Dashboard"
    ];

    if(array_key_exists($request, $nameRoute)){
        $title = $nameRoute[$request];
    }

?>

<head>
    <meta charset="UT-8">
    <meta name="viewport" content="width=device-width, initial-sacale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie=edge">
    <title><?php echo $title; ?> </title>
    <link rel="stylesheet" href="http://localhost/telecall/src/css/style.css">
    <script src="http://localhost/telecall/src/js/formatar_cpf.js"></script>
    <script src="http://localhost/telecall/src/js/main.js"></script>
</head>

