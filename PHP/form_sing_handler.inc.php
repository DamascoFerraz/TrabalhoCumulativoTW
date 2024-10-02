<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = htmlspecialchars($_POST['name']);
    $pwd = htmlspecialchars($_POST['pwd']);

    if (empty($name) or empty($pwd)){
        header("Location :../HTML/index.html");
        exit();
    }

    require_once "conect_database.php";

    $query = "INSERT INTO users(username,pwd,email) VALUES (?,?,?)";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $pdo = Null;
    $stmt = Null;

    die();

} else {
    header("Location :../HTML/index.html");
    exit();
}