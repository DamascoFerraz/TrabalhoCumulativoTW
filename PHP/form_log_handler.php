<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){              // checa se o usuario entrou na pagina atraves do envio de form

    $name = htmlspecialchars($_POST['name']);           // extrai o valor postado no formulario e bota em var
    $pwd = htmlspecialchars($_POST['pwd']);

    if (empty($name) or empty($pwd)){                   // checa se o valor postado no form foi vazio 
        header("Location :../HTML/index.html");         // coloca como proxima pagina o index
        exit();                                         // sai da pagina php e vai para onde esta definido o header
    }

    // colocar metodo de autenticação !!!!!

} else {
    header("Location :../HTML/index.html");
    exit();
}