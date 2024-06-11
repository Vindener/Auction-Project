<?php
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
  header("Location: ../../login.php"); // Перенаправлення на головну сторінку
  exit();
}else{
    include("../../include/db_connect.php"); 

   $sql = "SELECT IDBrand, Brand FROM Brand";
    $result = $mysqli->query($sql);
    
    $brands = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $brands[] = $row;
        }
    }

    $id = $_GET['id'];
  $sel = mysqli_query($mysqli, "SELECT * , b.Brand FROM Model JOIN 
        Brand b ON Model.IDBrand = b.IDBrand
    WHERE `IDModel` = '$id'");
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
    <h1 class="title">Редагування моделі</h1>
      <hr>
      <form class="form-auto" action="update.php" method="post">
        <p>№ моделі - <?=$row['IDModel'] ?></p>
        <input type="text" name="IDModel" value="<?= $row['IDModel'] ?>" readonly hidden>
        <p>Бренд</p>
            <select name="BrandID" required>
                <option value="">Виберіть бренд</option>
                <?php foreach ($brands as $brand): ?>
                    <?php if($brand['IDBrand'] == $row['IDBrand']){
                        echo"<option value=".$brand['IDBrand']." selected >  ".$brand['Brand']." </option>";
                    }else{
                        echo"<option value=".$brand['IDBrand']." >  ".$brand['Brand']." </option>";
                    }
                     ?>
                <?php endforeach; ?>
            </select>
        <p>Назва моделі</p>
        <input type="text" name="Model" value="<?= $row['Model'] ?>" >
        <br><br>
        <button type="submit" class="user_button" style="cursor:pointer;">Внести зміни</button>
      </form>
    </div>

</body>

</html>