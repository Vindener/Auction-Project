<?php
include("../../include/db_connect.php");

    $CarIDClient = $_POST["CarIDClient"];
    $CarModel = $_POST["CarModel"];
    $CarBrand = $_POST["CarBrand"];
    $Vin = $_POST["Vin"];
    $Salon = $_POST["Salon"];
    $Changed = isset($_POST['Changed']) ? 0 : 1;
    $Probig = $_POST["Probig"]; 
    $Description = $_POST["Description"]; 
    $EngineCapacity = $_POST["EngineCapacity"]; 
    $FuelCosts = $_POST["FuelCosts"]; 
    $FuelType = $_POST["FuelType"]; 
    $Privod = $_POST["Privod"]; 
    $Transmission = $_POST["Transmission"]; 
    $Year = $_POST["Year"]; 
    $TypeBody = $_POST["TypeBody"]; 
    $CarID = $_POST["IDCar"]; 

     $sql = "UPDATE car SET CarIDClient = ?, CarModel = ?, CarBrand = ?, Vin = ?, Salon = ?, Сhanged = ?, Probig = ?, Description = ?, EngineСapacity = ?, FuelCosts = ?, FuelType = ?, Privod = ?, Transmission = ?, Year = ?, TypeBody = ? WHERE IDCar = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("iissisissdsssiis", $CarIDClient, $CarModel, $CarBrand, $Vin, $Salon, $Changed, $Probig, $Description, $EngineСapacity, $FuelCosts, $FuelType, $Privod, $Transmission, $Year, $TypeBody, $CarID);

        if ($stmt->execute()) {
            echo "Car updated successfully.";
            $stmt->close();
            $mysqli->close();
            header('Location: ../car.php');
        } 

    } 
?>
