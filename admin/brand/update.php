<?php
require_once '../../include/db_connect.php';

$id = $_POST["IDBrand"];
$Brand = $_POST["Brand"];

mysqli_query($mysqli, "UPDATE Brand SET
            Brand='" . $Brand . "'
            WHERE Brand.IDBrand   = " . $id . " ");

header('Location: ../brands.php');
?>
