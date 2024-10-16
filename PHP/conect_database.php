<?php
//inicia sessão no servidor para armazenar variaveis a serem usadas em varias paginas
session_start();

//credenciais para conexão ao banco de dados atraves do metodo PDO 
//  mysql: tipo de sistema de banco de dados
//  host: servidor hosteando o banco de dados
//      geralmente é localhost ou 127.0.0.1 (se nao me engano)
//  dbname: nome do banco de dados
$dsn = "mysql:host=localhost;dbname=rede_social_tw";
//  root é o nome padrão para conexão
$dbusername = "root";
//  a senha padrão é ""(vazio) mas na escola é "123456", descobri pela aula de banco de dados,
//  onde tivemos que entrar numa instancia local, e a senha era essa
$dbpassword = "123456";

//try roda os codigos em suas chaves, mas se ocorrer uma exessao/erro ele joga para a funcão abaixo (catch)
try {
    // cria uma conexão PDO na variavel $pdo
    $pdo = new PDO($dsn, $dbusername, $dbpassword);

    // Configura o modo de tratamento de erros do PDO para lançar exceções
    // Isso permite que você capture e trate erros de forma mais elegante usando try-catch
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//catch, aqui esta pegando as exeções da conexão pdo (erros, em termo mais facil)
//e armazenando numa variavel $e
} catch (PDOException $e) {

    //se o erro armazenado na variavel $e for a falta do banco de dados (mensagem copiada de quando o erro realmente ocorreu)
    if($e = "Connection failed: SQLSTATE[HY000] [1049] Unknown database 'rede_social_tw'"){

        //manda o usuario para um arquivo onde sera criado o banco de dados base
        //(isso foi criado apenas a facilitação da utilização do codigo em outros computadores
        //visto que este 'site' nao esta sendo hosteado em um servidor real e na web)
        header('Location: ../criar_base.php');
        exit();
    };

    //mostra a mensagem de erro na tela
    echo "Connection failed: " . $e->getMessage(); // Exibe uma mensagem de erro com a descrição da exceção
}