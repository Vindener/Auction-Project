<h3?php
session_start(); // Запускаємо сесію
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
              <h6 class="breadcrumbs-custom-subtitle title-decorated">Contacts</h6>
              <h2 class="text-uppercase breadcrumbs-custom-title">Ласкаво просимо до вікна зміни данних машини</h2>
            </div>
            <ul class="breadcrumbs-custom-path">
              <li><a href="index.html">Home</a></li>
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
                            <h3 class="text-uppercase wow-outer"><span class="wow slideInDown">Редагувати данні машини</span></h3>
                            <!-- RD Mailform-->                           
     <form action="../bat/carChenge.php" method="POST" enctype="multipart/form-data">
    <section class="section novi-background section-lg">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="container">
            <div class="row row-50 justify-content-center justify-content-lg-between flex-lg-row-reverse">
                <div class="col-md-10 col-lg-6 col-xl-5">
                    <h3>Загрузити фото</h3>
                    <p> ㅤ</p>
                    <input type="file" id="file-input" accept="image/*" name="CarPhoto" onchange="loadFile(event)">                 
                </div>
                <div class="col-md-10 col-lg-6 col-xl-6">
                    <img id="uploaded-image" class="img-responsive" src="images/careers-1-570x388.jpg" alt="" width="570" height="388"/>
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
                <label class="form-label-outside" for="contact-login">номер кузова</label>
                <input class="form-input" id="contact-login" type="text" name="Vin" data-constraints="@Required">
            </div>
        </div>  
    
        <div class="col-md-6 wow-outer">
            <div class="form-wrap wow fadeSlideInUp">
                <label class="form-label-outside" for="contact-password">Пробіг в км</label>
                <input class="form-input" id="contact-password" type="number" name="Probig" data-constraints="@Required">
            </div>
        </div>
        <div class="col-12 wow-outer">
                        <div class="form-wrap wow fadeSlideInUp">
                          <label class="form-label-outside" for="contact-message">Опис</label>
                          <textarea class="form-input" id="contact-message" name="Description" data-constraints="@Required"></textarea>
                        </div>
                      </div>
        <div class="col-md-6 wow-outer">
            <div class="form-wrap wow fadeSlideInUp">
                <label class="form-label-outside" for="contact-phone">об'єм двигуна</label>
                <input class="form-input" id="contact-phone" type="number" name="EngineСapacity" data-constraints="@Required">
            </div>
        </div>
        <div class="col-md-6 wow-outer">
            <div class="form-wrap wow fadeSlideInUp">
                <label class="form-label-outside" for="contact-name">Витрати пального </label>
                <input class="form-input" id="contact-name" type="number" name="FuelCosts" data-constraints="@Required">
            </div>
        </div>
        
        <div class="col-md-6 wow-outer">
            <div class="form-wrap wow fadeSlideInUp">
                <label class="form-label-outside" for="contact-phone">Рік</label>
                <input class="form-input" id="contact-phone" type="number" name="Year" data-constraints="@Required">
            </div>
        </div>
        <div class="col-md-6 wow-outer">
            <div class="form-wrap wow fadeSlideInUp">
                <label class="form-label-outside" for="contact-name">Опис салону</label>
                <input class="form-input" id="contact-name" type="text" name="Salon" data-constraints="@Required">
            </div>
        </div>
        <div class="container mt-5">
        <div class="form-inline">
            <div class="form-group mr-3">
                <label for="fuel-type-1">Тип пальногоㅤㅤ</label>
                <select class="form-control custom-width" id="fuel-type-1" name="FuelType">
                    <option value="Бензин">Бензин</option>
                    <option value="Дизель">Дизель</option>
                    <option value="Єлектро">Єлектро</option>
                    <option value="Газ">Газ</option>
                    <option value="Біодизель">Біодизель</option>
                    <option value="Бутан">Бутан</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fuel-type-2">ㅤㅤㅤㅤТип приводу</label>
                <select class="form-control custom-width" id="fuel-type-2" name="Privod">
                    <option value="Повний">Повний</option>
                    <option value="Передній">Передній</option>
                    <option value="Задній">Задній</option>
                </select>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="form-inline">
            <div class="form-group mr-3">
                <label for="fuel-type-1">коробка передач</label>
                <select class="form-control custom-width" id="fuel-type-1" name="Transmission">
                    <option value="Автомат">Автомат</option>
                    <option value="saab">Механіка</option>
                    <option value="mercedes">Типтронік</option>
                    <option value="audi">Робот</option>
                    <option value="audi">Варіатор</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fuel-type-2">ㅤㅤㅤㅤТип кузоваㅤ</label>
                <select class="form-control custom-width" id="fuel-type-2" name="TypeBody">
                    <option value="Седан">Седан</option>
                    <option value="Кросовер">Кросовер</option>
                    <option value="Мінівен">Mінівен</option>
                    <option value="Хетчбек">Хетчбек</option>
                    <option value="Універсал">Універсал</option>
                    <option value="Купе">Купе</option>
                    <option value="Кабріолет">Кабріолет</option>
                    <option value="Лімузин">Лімузин</option>
                    <option value="Фастбек">Фастбек</option>
                    <option value="Родсек">Родсек</option>
                    <option value="Пікап">Пікап</option>
                </select>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="form-inline">
            <div class="form-group mr-3">
                <label for="brand">Маркаㅤㅤㅤ</label>
                <select class="form-control custom-width" id="brand" name="CarBrand">
                    <option value="">Виберіть марку</option>
                    <?php
                    // Підключення до бази даних
                    $conn = new mysqli('localhost', 'root', '', 'DBAutoAuk');

                    // Перевірка з'єднання
                    if ($conn->connect_error) {
                        die("Помилка з'єднання: " . $conn->connect_error);
                    }

                    // Запит для отримання всіх марок
                    $sql = "SELECT IDBrand, Brand FROM Brand";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Виведення марок в випадаючий список
                        while($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["IDBrand"] . '">' . $row["Brand"] . '</option>';
                        }
                    } else {
                        echo '<option value="">Марок не знайдено</option>';
                    }

                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="model">ㅤㅤㅤМодельㅤ</label>
                <select class="form-control custom-width" id="model" name="CarModel">
                    <option value="">Виберіть марку</option>
                </select>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('brand').addEventListener('change', function() {
            var brandID = this.value;

            // AJAX запит для отримання моделей
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../bat/get_models.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    var models = JSON.parse(this.responseText);
                    var modelSelect = document.getElementById('model');

                    // Очищення попередніх моделей
                    modelSelect.innerHTML = '<option value="">Виберіть модель</option>';

                    // Додавання нових моделей
                    models.forEach(function(model) {
                        var option = document.createElement('option');
                        option.value = model.IDModel;
                        option.textContent = model.Model;
                        modelSelect.appendChild(option);
                    });
                }
            };
            xhr.send('brandID=' + brandID);
        });
    </script>
   <script>
  function getCheckboxValue() {
    var checkbox = document.getElementById("contact-login");
    var isChecked = checkbox.value === "true"; // Перевіряємо, чи значення рівне "true"
    console.log(isChecked); // Виведе true або false залежно від стану чекбоксу
  }
</script>
    </div>
    <div class="group group-middle">

        <div class="wow-outer">
        <button class="button button-primary button-winona wow slideInRight" type="submit">
                                          <span class=""></span>Авторизуватися
         </button>
        
        </div>
        <div class="form-wrap wow fadeSlideInUp">
      
          ㅤㅤㅤ<input type="checkbox" id="contact-login" name="Сhanged" value="1" onchange="getCheckboxValue()">
        <label for="варіант1">чи щось мінялося</label><br>
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