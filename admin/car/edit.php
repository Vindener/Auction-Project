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

    $sql1 = "SELECT * FROM Model";
    $result = $mysqli->query($sql1);
    
    $models = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $models  [] = $row;
        }
    }

    $sql2 = "SELECT * FROM Brand";
    $result = $mysqli->query($sql2);
    
    $brands = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $brands  [] = $row;
        }
    }

    $id = $_GET['id'];
  $sel = mysqli_query($mysqli, "SELECT *,  m.Model,i.CFamilia FROM `Car`
    JOIN 
        Model m ON CarModel = m.IDModel
    JOIN 
        Client i ON CarIDClient = i.IDClient  
    WHERE `IDCar` = '$id'");
  $row = mysqli_fetch_assoc($sel);
  mysqli_close($mysqli);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Панель адміністрування  - машини</title>
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
    <h1 class="title">Редагування машини</h1>
      <hr>
      <form class="form-auto" action="update.php" method="post">
        <p>№ машини - <?=$row["IDCar"] ?></p>
        <input type="text" name="IDCar" value="<?= $row['IDCar'] ?>" readonly hidden>
        <?php 
            if ($row["CarPhoto"] != ''||$row["CarPhoto"] != null) {
                echo   '<p>Фото</p><img class="thumbnail-light-image" src="../../'. $row["CarPhoto"] .'" alt="" style="max-width: 150px; max-height: 150px;"/>';        
            } 
        ?>
        <p>Користувач</p>
        <select name="CarIDClient" required>
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['IDClient']; ?>" <?php if ($user['IDClient'] == $row['CarIDClient']) echo 'selected'; ?>>
                        <?php echo $user['CFamilia'] . ' (' . $user['IDClient'] . ')'; ?>
                    </option>
                <?php endforeach; ?>
        </select> 
        <p>Модель</p>
        <select name="CarModel" required>
                <?php foreach ($models as $model): ?>
                    <option value="<?php echo $model['IDModel']; ?>" <?php if ($model['IDModel'] == $row['CarModel']) echo 'selected'; ?>>
                        <?php echo   $model['Model']; ?>
                    </option>
                <?php endforeach; ?>
        </select>
        <p>Бренд</p>
        <select name="CarBrand" required>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?php echo $brand['IDBrand']; ?>" <?php if ($brand['IDBrand'] == $row['CarBrand']) echo 'selected'; ?>>
                        <?php echo   $brand['Brand']; ?>
                    </option>
                <?php endforeach; ?>
        </select>
        <p>ВІН код</p>
        <input type="text" name="Vin" value="<?= $row['Vin'] ?>" >
        <p>Салон</p>
        <input type="text" name="Salon" value="<?= $row['Salon'] ?>" >
        <br>
        <input type="checkbox" name="Сhanged" <?php if($row['Сhanged']==0){ echo 'checked';} ?>>Чи був в ДТП?</input>
        <p>Пробіг</p>
        <input type="number" name="Probig" value="<?= $row['Probig'] ?>" >
        <p>Опис</p>
        <textarea name="Description" ><?= $row['Description'] ?></textarea>
        <p>Об'єм двигуна</p>
        <input type="number" name="EngineСapacity" value="<?= $row['EngineСapacity'] ?>" >
        <p>Витрати палива</p>
        <input type="text" name="FuelCosts" value="<?= $row['FuelCosts'] ?>" >
        <p>Привід</p>
        <input type="text" name="Privod" value="<?= $row['Privod'] ?>" >,
        <p>Коробка передач</p>
        <input type="text" name="Transmission" value="<?= $row['Transmission'] ?>" >
        <p>Рік</p>
        <input type="number" name="Year" value="<?= $row['Year'] ?>" >
        <p>Тип кузова</p>
        <input type="text" name="TypeBody" value="<?= $row['TypeBody'] ?>" >
        <br><br>
        <button type="submit" class="user_button" style="cursor:pointer;">Внести зміни</button>
      </form>
    </div>

  <script src="js/delete.js"></script>
</body>

</html>