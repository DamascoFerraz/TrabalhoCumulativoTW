<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){              // checa se o usuario entrou na pagina atraves do envio de form

    $name = htmlspecialchars($_POST['name']);           // extrai o valor postado no formulario e bota em var
    $pwd = htmlspecialchars($_POST['pwd']);
    $email = htmlspecialchars($_POST['email']);

    if (empty($name) or empty($pwd)){                   // checa se o valor postado no form foi vazio 
        header("Location :../HTML/index.html");         // coloca como proxima pagina o index
        exit();                                         // sai da pagina php e vai para onde esta definido o header
    }

    require_once "conect_database.php";                 //utiliza uma vez o arquivo php (criando o arquivo PDO conectando a database)

    $query = "INSERT INTO users(username,pwd,email) VALUES (?,?,?)"; //cria query sql com valores a ser definidos ("?")

    $stmt = $pdo->prepare($query); //prepara a consulta SQL para execução

    $stmt->execute([$name,$pwd,$email]); //executa consulta com os valores

    $pdo = Null; // reseta as variaveis de consulta
    $stmt = Null;


    die();  //corta conexão
} else {
    header("Location :../HTML/index.html");
    exit();
}
header("Location :../HTML/index.html");
exit();