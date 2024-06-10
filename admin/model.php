<?php
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
  header("Location: ../login.php"); // Перенаправлення на головну сторінку
  exit();
}else{
    include("../include/db_connect.php");

  $sel = mysqli_query($mysqli, "SELECT * , b.Brand FROM Model JOIN 
        Brand b ON Model.IDBrand = b.IDBrand
    GROUP BY IDModel ");
  $num_rows = mysqli_num_rows($sel); //Визначення кількості рядків у таблиці
  //Виведення в циклі записів у таблицю веб-сторінки
  $row = mysqli_fetch_assoc($sel);
  mysqli_close($mysqli);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Панель адміністрування  - моделі</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="../css/styles.css?<? echo time(); ?>" />
</head>

<body>
  <nav class="navbar navbar-expand-sm admin-navbar">
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <h1>Адміністративна панель cайту</h1>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="users.php">Користувачі</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="brands.php">Бренди</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="car.php">Машини</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="model.php">Моделі</a>
        </li>
        <li class="nav-item">
          <button type="button" class="btn btn_exit" data-toggle="modal" data-target="#exit">
                    Вихід
          </button>
        </li>
      </ul>
    </div>
  </nav>

  <div class="spisok-table">
    <table class="admin_table">
      <tr>
        <th width="25px">№ моделі</th>
        <th width="200px">№ бренда та назва</th>
        <th width="200px">Назва моделі</th>
        <th>📷</th>
        <th>&#9998;</th>
        <th>&#10006;</th>
      </tr>
      <?php
      do {
        

        echo '
                    <tr>
                    <td>' . $row['IDModel'] . '</td>
                    <td>' . $row['IDBrand'] . ' ' . $row['Brand'] . '</td>
                    <td>' . $row['Model'] . '</td>
                    <td><a class="admin-links" href="model\view.php?id=' . $row['IDModel'] . '">Перегляд</a></td>
                    <td><a class="admin-links" href="auto\edit_auto.php?id=' . $row['IDModel'] . '">Оновити</a></td>
                    <td><a class="admin-links" href="model\delete.php?id=' . $row['IDModel'] . '" onclick="return ConfirmDelete()">Видалити</a></td>
                    </tr>
                    ';
      } while ($row = mysqli_fetch_assoc($sel));
      ?>
    </table>
  </div>

  <script src="js/delete.js"></script>
</body>

</html>