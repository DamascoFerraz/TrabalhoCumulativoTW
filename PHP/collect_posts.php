<?php
require_once "conect_database.php";

$query = "SELECT * FROM `posts` ORDER BY createdat DESC";
$posts = $pdo->query($query);

$postsarray = $posts->fetchAll();