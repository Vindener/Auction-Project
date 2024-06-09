<?php
session_start();

// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DBAutoAuk";

// Створення підключення
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Отримання IDCar з URL
$IDCar = isset($_GET['IDCar']) ? $_GET['IDCar'] : 0;

// SQL запит для отримання CarPhoto
$sql = "SELECT CarPhoto FROM Car WHERE IDCar = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $IDCar);
$stmt->execute();
$stmt->bind_result($CarPhoto);
$stmt->fetch();
$stmt->close();
$conn->close();

// Перевірка, чи знайдено фото
if (!$CarPhoto) {
    $CarPhoto = "default_photo.jpg"; // Шлях до фото за замовчуванням, якщо не знайдено фото для IDCar
}
?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <title>Contacts</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
   
      <!-- Page Header-->
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
                    <li class="rd-nav-item"><a class="rd-nav-link" href="account.php">Акаунт</a>
                    </li>                  
                  </ul>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
      <!-- Breadcrumbs -->
      <section class="section novi-background breadcrumbs-custom bg-image context-dark" style="background-image: url(images/registr.jpg);">
        <div class="breadcrumbs-custom-inner">
          <div class="container breadcrumbs-custom-container">
            <div class="breadcrumbs-custom-main">
              <h6 class="breadcrumbs-custom-subtitle title-decorated"></h6>
              <h2 class="text-uppercase breadcrumbs-custom-title">Вітаю в формі створення аукціону</h2>
            </div>
            <ul class="breadcrumbs-custom-path">
              <li><a href="index.php">Home</a></li>
              <li class="active">Contacts</li>
            </ul>
          </div>
        </div>
      </section>
      
      <section class="section novi-background bg-gray-100 centered-section">
        <div class="range justify-content-xl-center">
            <div class="cell-xl-6 align-self-center container">
                <div class="row justify-content-center">
                    <div class="col-lg-9 cell-inner">
                        <div class="section-lg">
                            <h3 class="text-uppercase wow-outer"><span class="wow slideInDown">Додати новий аукціон</span></h3>
                            <!-- RD Mailform-->                           
                            <form action="../bat/addAuction.php?IDCar=<?php echo $_GET['IDCar']; ?>" method="POST" enctype="multipart/form-data">
        <section class="section novi-background section-lg">
            <div class="container">
                <div class="row row-50 justify-content-center justify-content-lg-between flex-lg-row-reverse">
                    <div class="col-md-10 col-lg-6 col-xl-5">
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-6">
                        <img id="uploaded-image" class="img-responsive" src="<?php echo htmlspecialchars($CarPhoto); ?>" alt="Car Photo" width="570" height="388"/>
                    </div>
                </div>
            </div>
        </section>
    


<script>
function loadFile(event) {
    var image = document.getElementById('uploaded-image');
    image.src = URL.createObjectURL(event.target.files[0]);
    image.onload = function() {
        URL.revokeObjectURL(image.src); // release memory
    }
}
</script>
        
        <div class="row row-10">
        <div class="col-md-6 wow-outer">
            <div class="form-wrap wow fadeSlideInUp">
                <label class="form-label-outside" for="contact-login">Старт аукціонку</label>
                <input class="form-input" id="contact-login" type="datetime-local" name="StartAuK" data-constraints="@Required">
            </div>
        </div>  
    
        <div class="col-md-6 wow-outer">
            <div class="form-wrap wow fadeSlideInUp">
                <label class="form-label-outside" for="contact-password">Кінець аукціону</label>
                <input class="form-input" id="contact-password" type="datetime-local" name="EndAuk" data-constraints="@Required">
            </div>
        </div>  
        <div class="col-md-6 wow-outer">
            <div class="form-wrap wow fadeSlideInUp">
                <label class="form-label-outside" for="contact-phone">мінімальна ставка</label>
                <input class="form-input" id="contact-phone" type="number" name="MinBet" data-constraints="@Required">
            </div>     
    </div>
    </div>
    <div class="group group-middle">

        <div class="wow-outer">
        <button class="button button-primary button-winona wow slideInRight" type="submit">
      <span class=""></span>Додати аукціон
         </button>        
        </div>   
    </div>
</form>     
      </section>               
                        </div>
                    </div>
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