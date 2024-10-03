<?php
// credenciais do mysql 
$dsn = "mysql:host=localhost;dbname=rede_social_tw"; //Data Source Name
$dbusername = "root";
$dbpassword = "123456";

try {
    // Tenta estabelecer uma conexão com o banco de dados usando PDO
    $pdo = new PDO($dsn, $dbusername, $dbpassword);

    // Configura o modo de tratamento de erros do PDO para lançar exceções
    // Isso permite que você capture e trate erros de forma mais elegante usando try-catch
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    //se o erro for a falta de uma database
    if($e = "Connection failed: SQLSTATE[HY000] [1049] Unknown database 'rede_social_tw'"){
        header('Location: ../criar_base.php'); //vai para o arquivo de criação da base de database
        exit();
    };
    echo "Connection failed: " . $e->getMessage(); // Exibe uma mensagem de erro com a descrição da exceção
}