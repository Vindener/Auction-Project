<?php
include("../../include/db_connect.php");

    $id = $_POST["IDBrand"];
    $Brand = $_POST["Brand"];

    $sql = "UPDATE brand SET Brand = ? WHERE IDBrand = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("si", $Brand, $id);

        if ($stmt->execute()) {
            $mysqli->close();
            header('Location: ../brands.php');
        }

        $stmt->close();
    } 


    $mysqli->close();
?>
