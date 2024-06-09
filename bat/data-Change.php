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

if (!isset($_SESSION['user_id'])) {
    die("Ви повинні увійти, щоб змінити ваш профіль.");
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $CName = $_POST['CName'];
    $CFamilia = $_POST['CFamilia'];
    $CPobatkovi = $_POST['CPobatkovi'];
    
    // Перевірка на порожні значення
    if (empty($username) || empty($email) || empty($phone) || empty($CName) || empty($CFamilia) || empty($CPobatkovi)) {
        $message = "Ви не заповнили всі поля";
        echo "<script type='text/javascript'>alert('$message');window.location.href='../data-Change.php';</script>";
        exit();
    } else {
        // Перевірка існування користувача з таким же логіном або email, виключаючи поточного користувача
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM Client WHERE (CLogin = ? OR ClientEmile = ?) AND IDClient != ? AND IDClient != ?");
        $stmt->execute([$username, $email, $user_id, $user_id]);
        $userExists = $stmt->fetchColumn();

        if ($userExists) {
            // Якщо користувач вже існує, показуємо повідомлення про помилку
            $message = "Такий користувач вже існує";
            echo "<script type='text/javascript'>alert('$message');window.location.href='../data-Change.php';</script>";
            exit();
        } else {
            // Хешування паролю, якщо він був змінений
            if (!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE Client SET CName = ?, CFamilia = ?, CPobatkovi = ?, CLogin = ?, CPassword = ?, ClientEmile = ?, CPhone = ? WHERE IDClient = ?");
                $stmt->execute([$CName, $CFamilia, $CPobatkovi, $username, $hashed_password, $email, $phone, $user_id]);
            } else {
                $stmt = $pdo->prepare("UPDATE Client SET CName = ?, CFamilia = ?, CPobatkovi = ?, CLogin = ?, ClientEmile = ?, CPhonee = ? WHERE IDClient = ?");
                $stmt->execute([$CName, $CFamilia, $CPobatkovi, $username, $email, $phone, $user_id]);
            }

            $_SESSION['CName'] = $CName;
            // Перенаправлення після успішного оновлення
            header("Location: ../typography.php");
            exit();
        }
    }
}
?>