<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST'){
    header("Location:../PAGES/index.php?return=Acesso_negado");
    exit();
}

$name = htmlspecialchars($_POST['name']);
$pwd = htmlspecialchars($_POST['pwd']);
$email = htmlspecialchars($_POST['email']);

if (empty($name) or empty($pwd) or empty($email)){
    header("Location :../PAGES/index.php?return=Campo_nao_preenchido");
    exit();
}

require_once "conect_database.php";

$query = "SELECT * from users where email=(?);";
$stmt = $pdo->prepare($query);
$stmt->execute([$email]);

if ($stmt->rowCount()>0){
    header("Location:../PAGES/index.php?return=Email_ja_cadastrado");
    exit();
}

//esvazia as variaveis para serem reutilizadas
$query= Null;
$stmt = Null;

$query = "INSERT INTO users(username,pwd,email) VALUES (?,?,?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$name,$pwd,$email]);

$pdo = Null;
$stmt = Null;
$checkemail = Null;

header("Location:../PAGES/index.php?return=Usuario_registrado_com_sucesso");
exit();
?>