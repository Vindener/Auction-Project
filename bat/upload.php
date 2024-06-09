<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Перевірка на зображення
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Файл не є зображенням.";
        $uploadOk = 0;
    }

    // Перевірка розміру файлу
    if ($_FILES["photo"]["size"] > 5000000) { // 5MB
        echo "Вибачте, ваш файл занадто великий.";
        $uploadOk = 0;
    }

    // Дозволені формати файлів
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Вибачте, тільки JPG, JPEG, PNG та GIF файли дозволені.";
        $uploadOk = 0;
    }

    // Перевірка, чи встановлено $uploadOk на 0
    if ($uploadOk == 0) {
        echo "Вибачте, ваш файл не було завантажено.";
    // Якщо все гаразд, намагатись завантажити файл
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            header("Location: index.php?photo=" . urlencode(basename($_FILES["photo"]["name"])));
            exit;
        } else {
            echo "Вибачте, сталася помилка під час завантаження вашого файлу.";
        }
    }
} else {
    echo "Некоректний запит.";
}
?>