<?php
$dsn = "127.0.0.1:3306"; //Data Source Name
$dbusername = "root";
$dbpassword = "123456";

$conection = new mysqli($dsn,$dbusername,$dbpassword); //conecta ao servidor de mysql a um objeto msqli

$sqlscript= file_get_contents('criar_base.sql'); //pega o conteudo do arquivo script sql e armazena em var

$worked = $conection->multi_query($sqlscript); //executa diversas linhas de query inseridas na variavel de script no objeto mslqi

// if($worked){
//     echo("<p>modelo base do banco de dados criado automaticamente!</p><br>");
//     echo("<img src='ASSETS/database_created_icon.png' alt='databasecreatedicon'><br>");
// }else{
//     echo("error creating database! please inform error to data manager, contact:+55(35)99273-6703 [whatsapp]<br>");
//     echo("<img src='ASSETS/database-error-icon.png' alt='databaseerroricon'>");
// }
// img{
//     height: 50px;
//     width: 50px;
// }
// p{
//     font-size: larger;
// }
// html,body{
//     height:100%;
//     display:flex;
//     align-items:center;
//     justify-content:center;
//     flex-direction:column;
// }

header("Location: PAGES/index.php?created_database={$worked}");