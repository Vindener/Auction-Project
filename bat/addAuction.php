<?php
// Стартуємо сесію для отримання AuctionIDClient
session_start();

// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DBAutoAuk";

// Створення підключення
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Підключення до бази даних не вдалося: " . $conn->connect_error);
}

// Отримання значень з POST
$StartAuction = $_POST['StartAuK'];
$EndAuction = $_POST['EndAuk'];
$MinPrice = $_POST['MinBet'];

// Отримання значення AuctionIDCar з URL
$AuctionIDCar = $_GET['IDCar'];

// Отримання значення AuctionIDClient з сесії
$AuctionIDClient = $_SESSION['user_id'];

// Підготовка та виконання SQL запиту
$sql = "INSERT INTO Auction (AuctionIDCar, AuctionIDClient, StartAuction, EndAuction, MinPrice) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iissd", $AuctionIDCar, $AuctionIDClient, $StartAuction, $EndAuction, $MinPrice);

if ($stmt->execute()) {
    echo "Новий аукціон успішно створено!";
} else {
    echo "Помилка: " . $sql . "<br>" . $conn->error;
}

// Закриття з'єднання
$stmt->close();
$conn->close();
?>