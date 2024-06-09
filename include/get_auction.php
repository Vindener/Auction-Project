<?php
include("db_connect.php"); 

$auctionId = $_GET['IDAuction'];

$query = "SELECT * FROM Auction WHERE IDAuction = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $auctionId);
$stmt->execute();
$result = $stmt->get_result();

$auction = $result->fetch_assoc();
echo json_encode($auction);

$stmt->close();
$mysqli->close();
?>
