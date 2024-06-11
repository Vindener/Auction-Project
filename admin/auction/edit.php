<?php
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
  header("Location: ../../login.php"); // Перенаправлення на головну сторінку
  exit();
}else{
    include("../../include/db_connect.php");


     $sql = "SELECT IDClient,CFamilia  FROM Client";
    $result = $mysqli->query($sql);
    
    $users  = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $users [] = $row;
        }
    }

    $sql1 = "SELECT c.IDCar, b.Brand, m.Model FROM car c 
                JOIN 
        Brand b ON c.CarBrand = b.IDBrand
    JOIN 
        Model m ON c.CarModel = m.IDModel";
    $result = $mysqli->query($sql1);
    
    $cars = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $cars  [] = $row;
        }
    }

    $id = $_GET['id'];
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
    WHERE `IDAuction` = '$id'");
  $row = mysqli_fetch_assoc($sel);
  mysqli_close($mysqli);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Панель адміністрування  - аукціон</title>
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
    <h1 class="title">Редагування аукціону</h1>
      <hr>
      <form class="form-auto" action="update.php" method="post">
        <input type="text" name="IDAuction" value="<?= $row['IDAuction'] ?>" readonly hidden>
        <?php 
            if ($row["CarPhoto"] != ''||$row["CarPhoto"] != null) {
                echo   '<p>Фото</p><img class="thumbnail-light-image" src="../../'. $row["CarPhoto"] .'" alt="" style="max-width: 150px; max-height: 150px;"/>';        
            } 
        ?>
        <p>Назва транспорту</p>
        <select name="CarID" required>
                <?php foreach ($cars as $car): ?>
                    <option value="<?php echo $car['IDCar']; ?>" <?php if ($car['IDCar'] == $row['AuctionIDCar']) echo 'selected'; ?>>
                        <?php echo $car['Brand'] . ' ' . $car['Model']; ?>
                    </option>
                <?php endforeach; ?>
        </select>
        <p>Користувач</p>

        <select name="ClientID" required>
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['IDClient']; ?>" <?php if ($user['IDClient'] == $row['AuctionIDClient']) echo 'selected'; ?>>
                        <?php echo $user['CFamilia'] . ' (' . $user['IDClient'] . ')'; ?>
                    </option>
                <?php endforeach; ?>
        </select>
        <p>Початок аукціону</p>
        <input type="datetime-local" name="StartAuction" value="<?= $row['StartAuction'] ?>" >
        <p>Кінець аукціону</p>
        <input type="datetime-local" name="EndAuction" value="<?= $row['EndAuction'] ?>" >
        <p>Мінімальна ціна</p>
        <input type="text" name="MinPrice" value="<?= $row['MinPrice'] ?>" >
        <p>Переможець</p>
        <select name="IDWinner" required>
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['IDClient']; ?>" <?php if ($user['IDClient'] == $row['IDWinner']) echo 'selected'; ?>>
                        <?php echo $user['CFamilia'] . ' (' . $user['IDClient'] . ')'; ?>
                    </option>
                <?php endforeach; ?>
        </select>
        <p>Стан</p>
        <input type="checkbox" name="State" <?php if($row['State']==0){ echo 'checked';} ?>>Чи активне?</input>
        <br><br>
        <button type="submit" class="user_button" style="cursor:pointer;">Внести зміни</button>
      </form>
    </div>

  <script src="js/delete.js"></script>
</body>

</html>