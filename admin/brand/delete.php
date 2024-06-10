<?php
require_once '../../include/db_connect.php';
$id = $_GET['id'];

mysqli_query($mysqli, "DELETE FROM Brand WHERE `Brand`.`IDBrand` = '$id'");
header('Location: ../brands.php');
?>