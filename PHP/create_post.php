<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST'){
    header("Location:../PAGES/mainpage.php");
    exit();
}

$postcontent = htmlspecialchars($_POST['postcontent']);

require_once "conect_database.php";

$query="INSERT into posts (iduser,postcontent) values(?,?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user']['iduser'],$postcontent]);

header("Location:../PAGES/mainpage.php?return=Postagem%20publicada");
exit();