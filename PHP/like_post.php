<?php
require_once "conect_database.php";

$query = "SELECT * from `likes` where `idliker`=:idliker And `idlikedpost`=:idpost;";
$stmt = $pdo->prepare($query);
$stmt->bindparam(":idliker",$_SESSION['user']['iduser'],PDO::PARAM_INT);
$stmt->bindparam(":idpost",$_GET['post'],PDO::PARAM_INT);
$stmt->execute();

if($stmt->rowCount()==0){
    $query = NULL;
    $stmt = NULL;

    $query = "INSERT INTO `likes`(idliker,idlikedpost) VALUES(?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['user']['iduser'],$_GET['post']]);
}else{
    $query = NULL;
    $stmt = NULL;

    $query = "DELETE from `likes` where `idliker`=:idliker and `idlikedpost`=:idpost;";
    $stmt = $pdo->prepare($query);
    $stmt->bindparam(":idliker",$_SESSION['user']['iduser'],PDO::PARAM_INT);
    $stmt->bindparam(":idpost",$_GET['post'],PDO::PARAM_INT);
    $stmt->execute();
}

$query = NULL;
$stmt = NULL;

header("Location:../PAGES/mainpage.php");
exit;