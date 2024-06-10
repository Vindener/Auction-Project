<?php
require_once '../../include/db_connect.php';
$id = $_GET['id'];

mysqli_query($mysqli, "DELETE FROM Car WHERE `Car`.`IDCar` = '$id'");
header('Location: ../car.php');
?>