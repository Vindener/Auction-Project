
<?php 
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DBAutoAuk";

// Перевірка, чи встановлено номер сторінки
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Кількість аукціонів на одній сторінці
$per_page = 20;

// Обчислення початкового рядка для SQL LIMIT
$start = ($page - 1) * $per_page;

// Створення з'єднання
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("З'єднання не вдалося: " . $conn->connect_error);
}

// SQL-запит для отримання даних для поточної сторінки
$sql = "
SELECT 
    a.StartAuction, 
    a.EndAuction, 
    a.MinPrice, 
    b.Brand, 
    m.Model,
    c.CarPhoto
FROM 
    Auction a
JOIN 
    Car c ON a.AuctionIDCar = c.IDCar
JOIN 
    Brand b ON c.CarBrand = b.IDBrand
JOIN 
    Model m ON c.CarModel = m.IDModel
LIMIT $start, $per_page;
";

$result = $conn->query($sql);

// SQL-запит для обчислення загальної кількості сторінок
$total_pages_sql = "SELECT COUNT(*) FROM Auction";
$result_total = $conn->query($total_pages_sql);
$total_rows = $result_total->fetch_array()[0];
$total_pages = ceil($total_rows / $per_page);
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
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
  </head>
  <body>
    <!--
    <div class="ie-panel"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <div class="preloader">
      <div class="preloader-logo"><img src="images/Mylogo-default-151x44.png" alt="" width="151" height="44" srcset="images/Mylogo-default-151x44.png 2x"/>
      </div>
      <div class="preloader-body">
        <div id="loadingProgressG">
          <div class="loadingProgressG" id="loadingProgressG_1"></div>
        </div>
      </div>
    </div>
    <div class="page">-->
     
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
                  <!-- RD Navbar Brand--><a class="rd-navbar-brand" href="index.html"><img src="images/Mylogo-default-151x44.png" alt="" width="151" height="44" srcset="images/Mylogo-default-151x44.png 2x"/></a>
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

      <section class="section novi-background breadcrumbs-custom bg-image context-dark" style="background-image: url(images/registr.jpg);">
        <div class="breadcrumbs-custom-inner">
          <div class="container breadcrumbs-custom-container">
            <div class="breadcrumbs-custom-main">
              <h6 class="breadcrumbs-custom-subtitle title-decorated">текст</h6>
              <h2 class="text-uppercase breadcrumbs-custom-title">Ласкаво просимо до вікна пошуку аукціона</h2>
            </div>
            <ul class="breadcrumbs-custom-path">
              <li><a href="index.html">Home</a></li>
              <li class="active">Contacts</li>
            </ul>
          </div>
        </div>
      </section>

      <!-- Services-->
      <section class="section novi-background section-lg text-center">
    <div class="container">
        <h3 class="text-uppercase">Хороші варіанти :</h3>
        <div class="row row-35 row-xxl-70 offset-top-2">
            <?php
            if ($result->num_rows > 0) {
                // Виведення даних кожного рядка
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-sm-6 col-lg-3">';
                    echo '  <article class="thumbnail-light">';
                    echo '      <a class="thumbnail-light-media" href="#"><img class="thumbnail-light-image" src="'. $row["CarPhoto"] .'" alt="" style="max-width: 270px; max-height: 220px;"/></a>';
                    echo '      <h4 class="thumbnail-light-title"><a href="#">'. $row["Brand"] .' '. $row["Model"] .'</a></h4>';
                    echo '      <p>Початок аукціону: '. $row["StartAuction"] .'</p>';
                    echo '      <p>Кінець аукціону: '. $row["EndAuction"] .'</p>';
                    echo '      <p>Мінімальна ставка: '. $row["MinPrice"] .'</p>';
                    echo '  </article>';
                    echo '</div>';
                }
            } else {
                echo "Немає доступних аукціонів.";
            }
            $conn->close();
            ?>
        </div>
        <!-- Пагінація -->
        <div class="row">
            <div class="col-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php
                        // Виведення кнопок пагінації
                        $page_range = 3;
                        $start_page = max(1, $page - $page_range);
                        $end_page = min($total_pages, $page + $page_range);

                        if ($page > 4) {
                            echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                            if ($page > 5) {
                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                        }

                        for ($i = $start_page; $i <= $end_page; $i++) {
                            echo '<li class="page-item';
                            if ($page == $i) {
                                echo ' active';
                            }
                            echo '"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
                        }

                        if ($end_page < $total_pages - 3) {
                            if ($end_page < $total_pages - 4) {
                                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                            }
                            echo '<li class="page-item"><a class="page-link" href="?page='.$total_pages.'">'.$total_pages.'</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
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
            <div class="footer-advanced-layout"><a class="brand" href="index.html"><img src="images/Mlogo-lingh-151x44.png" alt="" width="115" height="34" srcset="images/Mlogo-lingh-151x44.png 2x"/></a>
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