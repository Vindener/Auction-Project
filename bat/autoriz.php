<?php
session_start([
    'cookie_lifetime' => 86400, // 1 день
]);

$host = 'localhost';
$db_name = 'DBAutoAuk';
$db_user = 'root';
$charset = 'utf8';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=$charset", $db_user, '', $options);
} catch (PDOException $i) {
    die("Помилка підключення до бази даних: " . $i->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Отримуємо дані користувача за його логіном
    $stmt = $pdo->prepare("SELECT * FROM Client WHERE CLogin = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Перевірка чи знайдено користувача та чи вірний пароль
    if ($user && password_verify($password, $user['CPassword'])) {
        $_SESSION['user_id'] = $user['IDClient'];
        $_SESSION['user_username'] = $user['CLogin'];

        // Налагодження сесії
        error_log("Сесія встановлена: " . print_r($_SESSION, true));

        header("Location: ../account.php"); // Перенаправлення після успішної авторизації
        exit();
    } else {
        $message = "Неправильний логін або пароль!";
        echo "<script type='text/javascript'>alert('$message');window.location.href='../contacts.html';</script>";
        exit(); // Завершити скрипт після відправки повідомлення
    }
}
?>