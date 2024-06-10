<?php
require_once '../../include/db_connect.php';
$id = $_GET['id'];

mysqli_query($mysqli, "DELETE FROM Client WHERE `Client`.`IDClient` = '$id'");
header('Location: ../users.php');
?>