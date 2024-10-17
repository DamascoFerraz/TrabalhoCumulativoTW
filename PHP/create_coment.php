<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST'){
    header("Location:../PAGES/mainpage.php");
    exit();
}

$comentcontent = htmlspecialchars($_POST['comentcontent']);
$comentid = $_POST['comentid'];

require_once "conect_database.php";

$query="INSERT into comments (iduser,idcommentedpost,commentcontent) values(?,?,?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user']['iduser'],$comentid,$comentcontent]);

header("Location:../PAGES/mainpage.php");
exit();