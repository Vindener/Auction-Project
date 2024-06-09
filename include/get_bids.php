
<?php
include("db_connect.php"); 


$auctionId = $_GET['IDAuction'];

$query = "SELECT * FROM bids WHERE AuctionID = ? ORDER BY BidTime DESC";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $auctionId);
$stmt->execute();
$result = $stmt->get_result();

$bids = [];
while ($row = $result->fetch_assoc()) {
    $bids[] = $row;
}
echo json_encode($bids);

$stmt->close();
$mysqli->close();
?>
