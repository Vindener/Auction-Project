<?php
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
  header("Location: ../../login.php"); // Перенаправлення на головну сторінку
  exit();
}else{
    include("../../include/db_connect.php");

    $id = $_GET['id'];
  $sel = mysqli_query($mysqli, "SELECT * FROM Client
    WHERE `IDClient` = '$id'");
  $row = mysqli_fetch_assoc($sel);
  mysqli_close($mysqli);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Панель адміністрування  - бренди</title>
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
          <a class="nav-link" href="../index.php">
            <h1>Адміністративна панель cайту</h1>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../users.php">Користувачі</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../brands.php">Бренди</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../car.php">Машини</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../model.php">Моделі</a>
        </li>
        <li class="nav-item">
          <button type="button" class="btn btn_exit" data-toggle="modal" data-target="#exit">
                    Вихід
          </button>
        </li>
      </ul>
    </div>
  </nav>

  <div>
    <h1 class="title">Перегляд користувача</h1>
      <hr>
      <form class="form-auto" action="../index.php" method="post">
        <p>№ користувача</p>
        <input type="text" name="IDClient" value="<?= $row['IDClient'] ?>" disabled>
        <p>Ім'я</p>
        <input type="text" name="CName" value="<?= $row['CName']?>" disabled>
        <p>Прізвище</p>
        <input type="text" name="CFamilia" value="<?= $row['CFamilia'] ?>" disabled>
        <p>По батькові</p>
        <input type="text" name="CPobatkovi" value="<?= $row['CPobatkovi'] ?>" disabled>
        <p>Ранг</p>
        <input type="text" name="CRang" value="<?= $row['CRang'] ?>" disabled>
        <p>Електронна адреса</p>
        <input type="text" name="ClientEmile" value="<?= $row['ClientEmile'] ?>" disabled>
        <p>Номер телефону</p>
        <input type="text" name="CPhone" value="<?= $row['CPhone'] ?>" disabled>
        <br><br>
        <button type="submit" class="user_button" style="cursor:pointer;">Повернутися на головну сторінку</button>
      </form>
    </div>

  <script src="js/delete.js"></script>
</body>

</html>