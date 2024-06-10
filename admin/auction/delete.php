<?php
require_once '../../include/db_connect.php';
$id = $_GET['id'];

mysqli_query($mysqli, "DELETE FROM Auction WHERE `Auction`.`IDAuction` = '$id'");
header('Location: ../index.php');
?>