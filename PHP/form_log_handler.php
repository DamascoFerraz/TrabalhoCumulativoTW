<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = htmlspecialchars($_POST['name']);
    $pwd = htmlspecialchars($_POST['pwd']);

    if (empty($name) or empty($pwd)){
        header("Location :../HTML/index.html");
        exit();
    }

    // colocar metodo de autenticação

} else {
    header("Location :../HTML/index.html");
    exit();
}