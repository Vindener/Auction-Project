<?php
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
  header("Location: ../login.php"); // Перенаправлення на головну сторінку
  exit();
}else{
    include("../include/db_connect.php");

  $sel = mysqli_query($mysqli, "SELECT * , b.Brand, 
    m.Model,i.CFamilia
    FROM Auction
     JOIN 
        Car c ON AuctionIDCar = c.IDCar
    JOIN 
        Brand b ON c.CarBrand = b.IDBrand
    JOIN 
        Model m ON c.CarModel = m.IDModel
    JOIN 
        Client i ON AuctionIDClient = i.IDClient 
    GROUP BY IDAuction");
  $num_rows = mysqli_num_rows($sel); //Визначення кількості рядків у таблиці
  //Виведення в циклі записів у таблицю веб-сторінки
  $row = mysqli_fetch_assoc($sel);
  mysqli_close($mysqli);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Панель адміністрування</title>
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
        <th width="25px">№ аукіону</th>
        <th width="125px">Назав транспорту</th>
        <th width="180px">Ім'я користувача та його індекс</th>
        <th>Фото</th>
        <th width="100px">Початок аукціону</th>
        <th width="100px">Кінець аукціону</th>
        <th width="100px">Мінімальна ціна</th>
        <th width="100px">Індекс переможця</th>
        <th width="100px">Стан</th>
        <th>📷</th>
        <th>&#9998;</th>
        <th>&#10006;</th>
      </tr>
      <?php
      do {
        

        echo '
                    <tr>
                    <td>' . $row['IDAuction'] . '</td>
                    <td>' . $row['Brand'] . ' ' . $row['Model'] . '</td>
                    <td>' . $row['CFamilia'] . " " . $row['AuctionIDClient'] . '</td>';

                    if ($row["CarPhoto"] != ''||$row["CarPhoto"] != null) {
                           echo   '<td><img class="thumbnail-light-image" src="../'. $row["CarPhoto"] .'" alt="" style="max-width: 50px; max-height: 50px;"/></td>';        
                        } else{
                            echo '<td></td>';
                        }
                   echo 
                    '<td>' . $row['StartAuction'] . '</td>
                    <td>' . $row['EndAuction'] . '</td>
                    <td>' . $row['MinPrice'] . '</td>';
                if ($row["IDWinner"] != ''||$row["IDWinner"] != null) {
                   echo' <td>' . $row['IDWinner'] . '</td>';}
                   else{
                    echo' <td>Ще не обрано</td>';
                   }
                if ($row["State"] != ''||$row["State"] != null) {
                    echo '<td> Неактивне </td>';
                }else{
                    echo '<td> Активне </td>';
                }
                    echo '<td><a class="admin-links" href="..\auto.php?id=' . $row['id_spisok'] . '">Перегляд</a></td>
                    <td><a class="admin-links" href="auto\edit_auto.php?id_spisok=' . $row['id_spisok'] . '">Оновити</a></td>
                    <td><a class="admin-links" href="auto\vendor\delete_auto.php?id_spisok=' . $row['id_spisok'] . '" onclick="return ConfirmDelete()">Видалити</a></td>
                    </tr>
                    ';
      } while ($row = mysqli_fetch_assoc($sel));
      ?>
    </table>
  </div>

</body>

</html>