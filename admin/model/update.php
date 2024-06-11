<?php
include("../../include/db_connect.php");

    $BrandID = $_POST["BrandID"];
    $ModelName = $_POST["Model"];
    $ModelID = $_POST["IDModel"];

    $sql = "UPDATE model SET IDBrand = ?, Model = ? WHERE IDModel = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("isi", $BrandID, $ModelName,$ModelID);

        if ($stmt->execute()) {
            $mysqli->close();
            header('Location: ../model.php');
        }
        $stmt->close();
    } 
    
    $mysqli->close();
?>
