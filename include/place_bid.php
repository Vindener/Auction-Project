<?php
include("db_connect.php"); 

$auctionId = $_POST['auctionId'];
$clientId = $_POST['clientId'];
$bidAmount = $_POST['bidAmount'];

if (empty($auctionId) || empty($clientId) || empty($bidAmount)) {
    die("All fields are required.");
}

$query = "INSERT INTO bids (AuctionID, ClientID, BidAmount, BidTime) VALUES (?, ?, ?, NOW())";
$stmt = $mysqli->prepare($query);

$stmt->bind_param("iid", $auctionId, $clientId, $bidAmount);

if ($stmt->execute()) {
    echo "Bid placed successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>
