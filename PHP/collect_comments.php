<?php
require_once "conect_database.php";

$query = "SELECT * FROM `comments` where idcommentedpost=".$_SESSION['this_post']." ORDER BY createdat DESC";
$comments=$pdo->query($query);


$commentsarray = $comments->fetchAll();