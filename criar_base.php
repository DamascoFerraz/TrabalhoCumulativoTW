<?php
$dsn = "127.0.0.1:3306"; //Data Source Name
$dbusername = "root";
$dbpassword = "123456";

$conection = new mysqli($dsn,$dbusername,$dbpassword); //conecta ao servidor de mysql a um objeto msqli

$sqlscript= file_get_contents('criar_base.sql'); //pega o conteudo do arquivo script sql e armazena em var

$worked = $conection->multi_query($sqlscript); //executa diversas linhas de query inseridas na variavel de script no objeto mslqi
?>

<!-------------------- HTML ------------------->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database create</title>
    <style>
        img{
            height: 50px;
            width: 50px;
        }
        p{
            font-size: larger;
        }
        html,body{
            height:100%;
            display:flex;
            align-items:center;
            justify-content:center;
            flex-direction:column;
        }
    </style>
</head>
<body>
    <h1>!!! Missing Database !!!</h1>
    <hr>

    <?php
        if($worked){
            echo("<p>modelo base do banco de dados criado automaticamente!</p><br>");
            echo("<img src='ASSETS/database_created_icon.png' alt='databasecreatedicon'><br>");
        }else{
            echo("error creating database! please inform error to data manager, contact:+55(35)99273-6703 [whatsapp]<br>");
            echo("<img src='ASSETS/database-error-icon.png' alt='databaseerroricon'>");
        }
    ?>

    <hr>
    <a href="PAGES/index.php">voltar manualmente a pagina principal</a>
    <br>
    <p>retornando para pagina principal em 10 segundos...</p>

    <!-- script para retornar ao index -->
    <script>
        setTimeout(function() {
            window.location.href = "PAGES/index.php";
        }, 10000);
    </script>
</body>
</html>