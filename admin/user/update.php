<?php
include("../../include/db_connect.php");

    $CName = $_POST["CName"];
    $CFamilia = $_POST["CFamilia"];
    $CPobatkovi = $_POST["CPobatkovi"];
    $CRang = $_POST["CRang"];
    $ClientEmile = $_POST["ClientEmile"];
    $CPhone = $_POST["CPhone"];
    $UserID = intval($_POST["UserID"]); 

    $sql = "UPDATE Client SET CName = ?, CFamilia = ?, CPobatkovi = ?, CRang = ?, ClientEmile = ?, CPhone = ? WHERE IDClient = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssssssi", $CName, $CFamilia, $CPobatkovi, $CRang, $ClientEmile, $CPhone, $UserID);

        if ($stmt->execute()) {
            echo "User updated successfully.";
            $stmt->close();
            $mysqli->close();
            header('Location: ../users.php');
        } 
        $stmt->close();
    } 
?>
