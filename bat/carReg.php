<?php
session_start(); // Розпочати сесію

// Параметри підключення до бази даних
$servername = "localhost"; // Ім'я сервера
$username = "root"; // Ім'я користувача бази даних
$password = ""; // Пароль користувача бази даних
$dbname = "DBAutoAuk"; // Ім'я бази даних

// Підключення до бази даних
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Помилка підключення до бази даних: " . $conn->connect_error);
}

// Отримання ідентифікатора користувача з сесії
$CarIDClient = $_SESSION['user_id'];

// Отримання даних з форми
$CarModel = $_POST['CarModel'];
$Vin = $_POST['Vin'];
$Salon = $_POST['Salon'];
$Сhanged = isset($_POST['Сhanged']) ? $_POST['Сhanged'] : 0; // Перевірка на пусте значення і заміна на 0
$Probig = $_POST['Probig'];
$Description = $_POST['Description'];
$EngineСapacity = $_POST['EngineСapacity'];
$FuelCosts = $_POST['FuelCosts'];
$FuelType = $_POST['FuelType'];
$Privod = $_POST['Privod'];
$Transmission = $_POST['Transmission'];
$Year = $_POST['Year'];
$TypeBody = $_POST['TypeBody'];
$CarBrand = $_POST['CarBrand'];

// Перевірка чи завантажений файл існує
if (isset($_FILES["CarPhoto"]) && $_FILES["CarPhoto"]["error"] == 0) {
    // Використання відносного шляху
    $target_dir = dirname(__FILE__) . '/../uploads/';
    $relative_dir = 'uploads/';

    // Перевірка існування папки і створення її, якщо вона не існує
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $filename = basename($_FILES["CarPhoto"]["name"]);
    $target_file = $target_dir . $filename;
    $relative_file = $relative_dir . $filename;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Перевірка чи є файл зображенням
    $check = getimagesize($_FILES["CarPhoto"]["tmp_name"]);
    if($check !== false) {
        // Переміщення завантаженого файлу в цільову директорію
        if (move_uploaded_file($_FILES["CarPhoto"]["tmp_name"], $target_file)) {
            echo "Файл ". $filename . " було успішно завантажено.";

            // Використання підготовлених виразів для уникнення SQL ін'єкцій
            $stmt = $conn->prepare("INSERT INTO Car (CarIDClient, CarModel, Vin, Salon, Сhanged, Probig, Description, EngineСapacity, FuelCosts, FuelType, Privod, Transmission, Year, TypeBody, CarBrand, CarPhoto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssissssssisss", $CarIDClient, $CarModel, $Vin, $Salon, $Сhanged, $Probig, $Description, $EngineСapacity, $FuelCosts, $FuelType, $Privod, $Transmission, $Year, $TypeBody, $CarBrand, $relative_file);

            if ($stmt->execute()) {
                echo "Дані успішно додані до бази даних";
                header("Location: ../typography.php");
                exit();
            } else {
                echo "Помилка: " . $stmt->error;
            }

            // Закриття підготовленого виразу та підключення до бази даних
            $stmt->close();
        } else {
            echo "Виникла помилка при завантаженні файлу.";
        }
    } else {
        echo "Файл не є зображенням.";
    }
} else {
    echo "Файл не завантажено або виникла помилка при завантаженні.";
}

// Закриття підключення до бази даних
$conn->close();
?>