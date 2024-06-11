<?php
include("../../include/db_connect.php");

    $CarID = $_POST["CarID"];
    $ClientID = $_POST["ClientID"];
    $StartAuction = $_POST["StartAuction"];
    $EndAuction = $_POST["EndAuction"];
    $MinPrice = $_POST["MinPrice"];
    $IDWinner = $_POST["IDWinner"];
    $State = intval($_POST["State"]); 
    $AuctionID = intval($_POST["IDAuction"]); 

    $sql = "UPDATE auction SET AuctionIDCar = ?, AuctionIDClient = ?, StartAuction = ?, EndAuction = ?, MinPrice = ?, IDWinner = ?, State = ? WHERE IDAuction = ?";
    if ($stmt = $mysqli->prepare($sql)) {
          $stmt->bind_param("iissdsii", $CarID, $ClientID, $StartAuction, $EndAuction, $MinPrice, $IDWinner, $State, $AuctionID);

        if ($stmt->execute()) {
            echo "Auction updated successfully.";
            $stmt->close();
            $mysqli->close();
            header('Location: ../index.php');
        } 
    } 
?>
