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

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $CName = $_POST['CName'];
    $CFamilia = $_POST['CFamilia'];
    $CPobatkovi = $_POST['CPobatkovi'];
    
    // Перевірка на порожні значення
    if (empty($username) || empty($password) || empty($email) || empty($phone) || empty($CName) || empty($CFamilia) || empty($CPobatkovi)) {
        $message = "ви незаповнили поля";
        echo "<script type='text/javascript'>alert('$message');window.location.href='../registr.php';</script>";
        exit();
    } else {
        // Перевірка існування користувача з таким же логіном або email
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM Client WHERE CLogin = ? OR ClientEmile = ?");
        $stmt->execute([$username, $email]);
        $userExists = $stmt->fetchColumn();

        if ($userExists) {
            // Якщо користувач вже існує, показуємо повідомлення про помилку
            $message = "такий користувач вже існує ";
        echo "<script type='text/javascript'>alert('$message');window.location.href='../registr.php';</script>";
        exit();
        } else {
            // Хешування паролю
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Вставляємо нового користувача в таблицю Client
            $stmt = $pdo->prepare("INSERT INTO Client (CName, CFamilia, CPobatkovi, CLogin, CPassword, CRang, CScore, ClientEmile, Cphone ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$CName, $CFamilia, $CPobatkovi, $username, $hashed_password, 0, 0.0, $email, $phone]);
            
            // Отримуємо ID новоствореного користувача
            $userId = $pdo->lastInsertId();

            // Авторизація користувача
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;

            // Перенаправляємо користувача на іншу сторінку або показуємо повідомлення про успішну реєстрацію
            header("Location: ../typography.php");
            exit();
        }
    }
}
?>