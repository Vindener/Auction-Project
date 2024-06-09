<?php
session_start(); // Розпочати сесію

// Параметри підключення до бази даних
$servername = "localhost"; // Ім'я сервера
$username = "root"; // Ім'я користувача бази даних
$password = ""; // Пароль користувача бази даних
$dbname = "DBAutoAuk"; // Ім'я бази даних

// Підключення до бази даних
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Помилка підключення до бази даних: " . $conn->connect_error);
}

// Отримання ідентифікатора користувача з сесії
$CarIDClient = $_SESSION['user_id'];

// SQL запит для отримання машин користувача
$sql = "SELECT Car.*, Model.Model AS ModelName FROM Car 
        JOIN Model ON Car.CarModel = Model.IDModel 
        WHERE Car.CarIDClient = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $CarIDClient);
$stmt->execute();
$result = $stmt->get_result();

$cars = [];
while ($row = $result->fetch_assoc()) {
    $cars[] = $row;
}

// Закриття підготовленого виразу та підключення до бази даних
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <title>Home</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0 maximum-scale=1.0 user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800%7CPoppins:300,400,700">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css" id="main-styles-link">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
  </head>
  <body>
   
     
      <header class="section novi-background page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap">
          <nav class="rd-navbar rd-navbar-corporate" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-lg-stick-up="true" data-lg-stick-up-offset="118px" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xl-stick-up="true" data-xl-stick-up-offset="118px" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-xxl-stick-up-offset="118px" data-xxl-stick-up="true">
            <div class="rd-navbar-aside-outer">
              <div class="rd-navbar-aside">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                  <!-- RD Navbar Toggle-->
                  <button class="rd-navbar-toggle" data-rd-navbar-toggle="#rd-navbar-nav-wrap-1"><span></span></button>
                  <!-- RD Navbar Brand--><a class="rd-navbar-brand" href="index.php"><img src="images/Mylogo-default-151x44.png" alt="" width="151" height="44" srcset="images/Mylogo-default-151x44.png 2x"/></a>
                </div>
                <div class="rd-navbar-collapse">
                  <button class="rd-navbar-collapse-toggle rd-navbar-fixed-element-1" data-rd-navbar-toggle="#rd-navbar-collapse-content-1"><span></span></button>
                  <div class="rd-navbar-collapse-content" id="rd-navbar-collapse-content-1">
                    <article class="unit align-items-center">
                      <div class="unit-left"></div>
                      <div class="unit-body">
                        
                      </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="rd-navbar-main-outer">
              <div class="rd-navbar-main">
                <div class="rd-navbar-nav-wrap" id="rd-navbar-nav-wrap-1">
                  <!-- RD Navbar Nav-->
                  <ul class="rd-navbar-nav">
                    <li class="rd-nav-item active"><a class="rd-nav-link" href="index.php">Головна сторінка</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="MainAuction.php">Аукціони</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="account.php">Акаунт</a>
                    </li>                  
                  </ul>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
      <section class="section novi-background breadcrumbs-custom bg-image context-dark" style="background-image: url(background.jpg);">
        <div class="breadcrumbs-custom-inner">
          <div class="container breadcrumbs-custom-container">
            <div class="breadcrumbs-custom-main">
              <h6 class="breadcrumbs-custom-subtitle title-decorated">Вітаю в формі додавання аукціону</h6>
              <h2 class="text-uppercase breadcrumbs-custom-title">Виберіть авто з яким будете проводити аукціон</h2>
            </div>
            <ul class="breadcrumbs-custom-path">
              <li><a href="index.html">Home</a></li>
              <li class="active">акаунті</li>
            </ul>
          </div>
        </div>
      </section>
      <section class="section novi-background section-md text-center">
        <div class="container">
          <h3 class="text-uppercase font-weight-bold wow-outer"><span class="wow slideInDown">Ваші машини</span></h3>
          <div class="row row-lg-50 row-35 offset-top-2">
            <div class="col-md-6 wow-outer">
             
            
            
      </section>
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Підключення Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

      <div class="container">
  <div class="row">
    <?php foreach ($cars as $car): ?>
      <div class="col-md-6 wow-outer">
        <!-- Post Modern -->
        <article class="post-modern wow slideInLeft">
        <a class="post-modern-media" href="creatingAuction.php?IDCar=<?php echo $car['IDCar']; ?>" onclick="location.href=this.href;" data-toggle="modal" data-target="#carModal">
    <img src="<?php echo htmlspecialchars($car['CarPhoto']); ?>" alt="<?php echo htmlspecialchars($car['CarModel']); ?>" width="571" height="353"/>
      </a>  
          <h4 class="post-modern-title">
            <a class="post-modern-title" href="creatingAuction.php?IDCar=<?php echo $car['IDCar']; ?>"><?php echo htmlspecialchars($car['ModelName']); ?></a>
          </h4>
          <ul class="post-modern-meta">
            <li><a class="button-winona" href="#"><?php echo htmlspecialchars($car['Probig']); echo " пробіг";?></a></li>
            <li><?php echo htmlspecialchars($car['EngineСapacity']); echo " об'єм двигуна";?></li>
            <li><?php echo htmlspecialchars($car['Year']); echo " рік"; ?></li>
          </ul>
          <p><?php echo "опис :"; echo htmlspecialchars($car['Description']); ?></p>
        </article>
      </div>
    <?php endforeach; ?>
  </div>
</div>
 
      <footer class="section novi-background footer-advanced bg-gray-700">
        <div class="footer-advanced-main">
          <div class="container">
            
          </div>
        </div>
        <div class="footer-advanced-aside">
          <div class="container">
            <div class="footer-advanced-layout">
              
              <div>
                <ul class="foter-social-links list-inline list-inline-md">
                  <li><a class="icon novi-icon icon-sm link-default mdi mdi-facebook" href="#"></a></li>
                  <li><a class="icon novi-icon icon-sm link-default mdi mdi-twitter" href="#"></a></li>
                  <li><a class="icon novi-icon icon-sm link-default mdi mdi-instagram" href="#"></a></li>
                  <li><a class="icon novi-icon icon-sm link-default mdi mdi-google" href="#"></a></li>
                  <li><a class="icon novi-icon icon-sm link-default mdi mdi-linkedin" href="#"></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <hr/>
        </div>
        <div class="footer-advanced-aside">
          <div class="container">
            <div class="footer-advanced-layout"><a class="brand" href="index.html"><img src="images/Mlogo-lingh-151x44.png" alt="" width="115" height="34" srcset="images/Mlogo-lingh-151x44.png 2x"/></a>
              <!-- Rights-->
              <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span>. All Rights Reserved. Design by <a href="https://www.templatemonster.com">Riplovik Студент БФПЕП</a></p>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Javascript-->
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>