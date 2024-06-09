<?php
// Підключення до бази даних
$conn = new mysqli('localhost', 'root', '', 'DBAutoAuk');

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Помилка з'єднання: " . $conn->connect_error);
}

if (isset($_POST['brandID'])) {
    $brandID = $_POST['brandID'];

    // Запит для отримання моделей на основі ID марки
    $sql = "SELECT IDModel, Model FROM Model WHERE IDBrand = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $brandID);
    $stmt->execute();
    $result = $stmt->get_result();

    $models = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $models[] = $row;
        }
    }

    echo json_encode($models);
}

$conn->close();
?>
