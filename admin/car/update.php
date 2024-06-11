<?php
include("../../include/db_connect.php");

// Отримання даних з POST-запиту
$CarIDClient = $_POST["CarIDClient"];
$CarModel = $_POST["CarModel"];
$CarBrand = $_POST["CarBrand"];
$Vin = $_POST["Vin"];
$Changed = isset($_POST['Changed']) ? 0 : 1;
$Probig = $_POST["Probig"];
$Description = $_POST["Description"];
$EngineСapacity = $_POST["EngineСapacity"];
$FuelCosts = $_POST["FuelCosts"];
$FuelType = $_POST["FuelType"];
$Privod = $_POST["Privod"];
$Transmission = $_POST["Transmission"];
$Year = $_POST["Year"];
$CarID = $_POST["IDCar"];
$Salon = $_POST["Salon"];
$TypeBody = $_POST["TypeBody"];

// SQL-запит для оновлення даних в таблиці car
$sql = "UPDATE car SET CarIDClient = ?, CarModel = ?,Salon = ?,TypeBody = ?,CarBrand = ?, Vin = ?, Сhanged = ?, Probig = ?, `Description` = ?, EngineСapacity = ?, FuelCosts = ?, FuelType = ?, Privod = ?, Transmission = ?, Year = ? WHERE IDCar = ?";

if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("iissssissssdsssi", $CarIDClient, $CarModel,$Salon,$TypeBody, $CarBrand, $Vin, $Changed, $Probig, $Description, $EngineСapacity, $FuelCosts, $FuelType, $Privod, $Transmission, $Year, $CarID);

    if ($stmt->execute()) {
        $stmt->close();
        $mysqli->close();
        header('Location: ../car.php');
        exit();
    } else {
        echo "Failed to execute SQL statement: " . $stmt->error;
    }
} else {
    echo "Failed to prepare SQL statement: " . $mysqli->error;
}

$mysqli->close();
?>
