<?php
$dsn = "127.0.0.1:3306"; //Data Source Name
$dbusername = "root";
$dbpassword = "123456";

$conection = new mysqli($dsn,$dbusername,$dbpassword); //conecta ao servidor de mysql a um objeto msqli

$sqlscript= file_get_contents('criar_base.sql'); //pega o conteudo do arquivo script sql e armazena em var

$worked = $conection->multi_query($sqlscript); //executa diversas linhas de query inseridas na variavel de script no objeto mslqi

if($worked){
    echo("Missing database created! please go back to index and try again");
}else{
    echo("error creating database! please inform error to data manager, contact:+55(35)99273-6703 [whatsapp]");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database create</title>
</head>
<body>
    <hr>
    <a href="HTML/index.html">Back to index</a>
    <p>returning to index autimaticaly in 5 seconds...</p>

    <!-- script para retornar ao index -->
    <script>
        setTimeout(function() {
            window.location.href = "HTML/index.html";
        }, 5000);
    </script>
</body>
</html>