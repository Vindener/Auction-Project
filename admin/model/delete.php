<?php
require_once '../../include/db_connect.php';
$id = $_GET['id'];

mysqli_query($mysqli, "DELETE FROM Model WHERE `Model`.`IDModel` = '$id'");
header('Location: ../model.php');
?>