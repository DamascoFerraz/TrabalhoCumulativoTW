<?php
$dsn = "127.0.0.1:3306"; //endereço do servidor
$dbusername = "root";
$dbpassword = "123456";

$conection = new mysqli($dsn,$dbusername,$dbpassword); //conecta ao servidor de mysql a um objeto msqli

$sqlscript= file_get_contents('criar_base.sql'); //pega o conteudo do arquivo script sql e armazena em var

$worked = $conection->multi_query($sqlscript); //executa diversas linhas de query inseridas na variavel de script no objeto mslqi

if($worked){
    $return = 'created_database';
} else{
    $return = 'fail_creating_database';
};

header("Location: PAGES/index.php?return={$return}");