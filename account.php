<?php session_start();

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
  header("Location: autorization.php"); // Перенаправлення на сторінку входу
  exit();
}
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
$user_id = $_SESSION['user_id'];

// Отримання даних користувача з бази даних
$stmt = $pdo->prepare("SELECT CLogin, CName, CFamilia, CPobatkovi, ClientEmile FROM Client WHERE IDClient = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <title>Typography</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0 maximum-scale=1.0 user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800%7CPoppins:300,400,700">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css" id="main-styles-link">
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
                  <!-- RD Navbar Brand--><a class="rd-navbar-brand" href="index.php"><img src="images/background.jpg" alt="" width="151" height="44" srcset="images/Mylogo-default-151x44.png 2x"/></a>
                </div>
                <div class="rd-navbar-collapse">
                  <button class="rd-navbar-collapse-toggle rd-navbar-fixed-element-1" data-rd-navbar-toggle="#rd-navbar-collapse-content-1"><span></span></button>
                  <div class="rd-navbar-collapse-content" id="rd-navbar-collapse-content-1">
                    Авто Аукціон №1 в Україні
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
                    <li class="rd-nav-item"><a class="rd-nav-link" href="autorization.php">Вихій</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="AdminPanel.php">Адмінка</a>
                    </li>                  
                  </ul>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
      <!-- Breadcrumbs -->
      <section class="section novi-background breadcrumbs-custom bg-image context-dark" style="background-image: url(images/background.jpg);">
        <div class="breadcrumbs-custom-inner">
          <div class="container breadcrumbs-custom-container">
            <div class="breadcrumbs-custom-main">
              <h6 class="breadcrumbs-custom-subtitle title-decorated">перегляд</h6>
              <h2 class="text-uppercase breadcrumbs-custom-title">Вітаю вас в свому акаунті</h2>
            </div>
            <ul class="breadcrumbs-custom-path">
              <li><a href="index.html">Home</a></li>
              <li class="active">акаунті</li>
            </ul>
          </div>
        </div>
      </section>
       <!-- list typography-->
      <section class="section novi-background section-sm">
        <div class="container">
          <div class="row row-50">
            <div class="col-lg-10 col-xl-8">
              <h6>Ваш профіль</h6>
              <p></p>
              <ul class="list-marked">
               <li>Логін: <?php echo htmlspecialchars($user['CLogin']); ?></li>
               <li>Ім'я: <?php echo htmlspecialchars($user['CName']); ?></li>
               <li>Призвіще: <?php echo htmlspecialchars($user['CFamilia']); ?></li>
               <li>Побатькові: <?php echo htmlspecialchars($user['CPobatkovi']); ?></li>
               <li>Електронна пошта: <?php echo htmlspecialchars($user['ClientEmile']); ?></li>
              </ul>
              <p>якщо ви хочети змінити данні то натисніть на кнопку "Змінити облікові данні"</p>
              <h3>⠀ </h3>
              <div class="wow-outer">
            <button onclick="window.location.href='dataChange.php'" type="submit" id="register-button" class="button button-primary-outline button-icon button-icon-left button-winona wow slideInLeft">
                <span class=""></span>Змінити облікові данні
            </button>           
            </div>
          </div>
        </div>
      </section>
      <!-- Base typography-->
      <section class="section novi-background section-sm section-first">
        <div class="container">
          <div class="row row-50">
            <div class="col-xl-8">
              <ul class="list-xl">
                <li>
                  <h2>Аукціони в яких ви приймали участь</h2>  
                  <div class="wow-outer">
            <button onclick="window.location.href='dataChange.php'" type="submit" id="register-button" class="button button-primary-outline button-icon button-icon-left button-winona wow slideInLeft">
                <span class=""></span>Переглянути історію аукціонів
            </button>           
            </div>              
                </li>
                <li>
                  <h2>Переглянути власні аукціони</h2>
                  <div class="wow-outer">
            <button onclick="window.location.href='youAuction.php'" type="submit" id="register-button" class="button button-primary-outline button-icon button-icon-left button-winona wow slideInLeft">
                <span class=""></span>Переглянути аукціон
            </button>           
            </div>
                </li> 
                <li>
                  <h2>Додати Аукціон</h2>
                  <div class="wow-outer">
            <button onclick="window.location.href='choosingCarForTheAuction.php'" type="submit" id="register-button" class="button button-primary-outline button-icon button-icon-left button-winona wow slideInLeft">
                <span class=""></span>Провести аукціон
            </button>           
            </div>
                </li>  
                <li>
                  <h2>Переглянути Машини</h2>
                  <div class="wow-outer">
            <button onclick="window.location.href='youCar.php'" type="submit" id="register-button" class="button button-primary-outline button-icon button-icon-left button-winona wow slideInLeft">
                <span class=""></span>Переглянути
            </button>           
            </div>
                </li>       
                <li>
                  <h2>Додати Машину</h2>
                  <div class="wow-outer">
            <button onclick="window.location.href='ADDCar.php'" type="submit" id="register-button" class="button button-primary-outline button-icon button-icon-left button-winona wow slideInLeft">
                <span class=""></span>Додати машину
            </button>           
            </div>
                </li>         
              </ul>
            </div>
          </div>
        </div>
      </section>
    
      <!-- Page Footer-->
      <footer class="section novi-background footer-advanced bg-gray-700">
        <div class="footer-advanced-main">
         
          </div>
        </div>
        <div class="footer-advanced-aside">
          <div class="container">
            <div class="footer-advanced-layout">
              
              <div>
                <ul class="foter-social-links list-inline list-inline-md">
                  <li><a class="icon novi-icon icon-sm link-default mdi mdi-facebook" href="https://uk-ua.facebook.com/aroslavmarcuk"></a></li>
                  <li><a class="icon novi-icon icon-sm link-default mdi mdi-twitter" href="https://uk-ua.facebook.com/aroslavmarcuk"></a></li>
                  <li><a class="icon novi-icon icon-sm link-default mdi mdi-instagram" href="https://www.instagram.com/yaroslav_marthyk?igsh=cTRlZDc4bGptajly"></a></li>
                  <li><a class="icon novi-icon icon-sm link-default mdi mdi-google" href="https://mail.google.com/mail/u/0/#inbox"></a></li>
                  
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
            <div class="footer-advanced-layout"><a class="brand" href="index.php"><img src="images/Mlogo-lingh-151x44.png" alt="" width="115" height="34" srcset="images/Mlogo-lingh-151x44.png 2x"/></a>
              <!-- Rights-->
              <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span>. Всі права захищені. Розробник <a href="https://www.templatemonster.com">Ярослав Марчук сутдент групи П-422 </a></p>
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