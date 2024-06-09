<?php
    session_start();
    include("./include/db_connect.php"); 

    $auctionId = $_GET['IDAuction'];

    $query = "SELECT 
    a.IDAuction, 
    a.StartAuction, 
    a.EndAuction, 
    a.MinPrice, 
    b.Brand, 
    m.Model,
    c.Description,
    c.CarPhoto
    FROM 
        Auction a
    JOIN 
        Car c ON a.AuctionIDCar = c.IDCar
    JOIN 
        Brand b ON c.CarBrand = b.IDBrand
    JOIN 
        Model m ON c.CarModel = m.IDModel WHERE IDAuction = ?";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $auctionId);
    $stmt->execute();
    $result = $stmt->get_result();
    $auction = $result->fetch_assoc();
    $stmt->close();

    //Обробка ставок
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $clientId = $_POST['clientId'];
        $bidAmount = $_POST['bidAmount'];

        $currentDateTime = new DateTime();
        $endDateTime = new DateTime($auction['EndAuction']);

        if ($currentDateTime > $endDateTime) {
            echo "<script>alert(\"Цей аукціон закінчився!\");
                            </script>";
        } else {
            if (empty($auctionId) || empty($clientId) || empty($bidAmount)) {
                echo "<script>alert(\"Ви не заповнили поля!\");
                            </script>";
            } else {
                if ($bidAmount <= $auction['MinPrice']) {
                    echo "<script>alert(\"Ваша ставка мала для участі!\");
                            </script>";
                } else {
                    $query = "INSERT INTO bids (AuctionID, ClientID, BidAmount, BidTime) VALUES (?, ?, ?, NOW())";
                    $stmt = $mysqli->prepare($query);
                    if ($stmt) {
                        $stmt->bind_param("iid", $auctionId, $clientId, $bidAmount);
                        if ($stmt->execute()) {
                            echo "<script>alert(\"Ваша ставка успішно додана!\");
                            </script>";

                            // Оновлення MinPrice
                            $updateQuery = "UPDATE auction SET MinPrice = (SELECT MAX(BidAmount) FROM bids WHERE AuctionID = ?) WHERE IDAuction = ?";
                            $updateStmt = $mysqli->prepare($updateQuery);
                            if ($updateStmt) {
                                $updateStmt->bind_param("ii", $auctionId, $auctionId);
                                $updateStmt->execute();
                                $updateStmt->close();
                            }
                        } else {
                            echo "Error: " . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
                    }
                }
            }
        }
    }

    //Отримання списку всіх ставок
    $bidsQuery = "SELECT * FROM bids WHERE AuctionID = ? ORDER BY BidTime DESC";
    $bidsStmt = $mysqli->prepare($bidsQuery);
    $bidsStmt->bind_param("i", $auctionId);
    $bidsStmt->execute();
    $bidsResult = $bidsStmt->get_result();
    $bids = [];
    while ($row = $bidsResult->fetch_assoc()) {
        $bids[] = $row;
    }
    $bidsStmt->close();

    //Закриття з'єднання з базою даних
    $mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Сторінка аукціону № <?php echo $_GET['IDAuction'];?></title>
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
              <h2 class="text-uppercase breadcrumbs-custom-title">Ласкаво просимо до сторінки аукціона  № <?php echo $_GET['IDAuction'];?></h2>
            </div>
            <ul class="breadcrumbs-custom-path">
              <li><a href="index.html">Home</a></li>
            </ul>
          </div>
        </div>
      </section>

       <section class="section novi-background section-lg text-center">
        <div class="aution-container">

    <div id="auction-details">
        <h1>Авто -  <?php echo $auction['Brand']; ?> <?php echo $auction['Model']; ?></h1>
        <h4 id="warning" class="warning-auction"></h4>
        <img class="thumbnail-light-image" src=<?php echo $auction['CarPhoto']; ?> alt="" style="max-width: 270px; max-height: 220px;"/>
        <h4>Початок: <?php echo htmlspecialchars($auction['StartAuction']); ?></h4>
        <h4>Кінець: <?php echo htmlspecialchars($auction['EndAuction']); ?></h4>
        <h4>Мінімальна ставка: <?php echo htmlspecialchars($auction['MinPrice']); ?></h4>
        <?php if($auction['Description']!="" || $auction['Description']!=null){
            echo "<h5>Опис: ".$auction['Description']."<h5>";
        } ?>
    </div>

    <div id="bid-list" class="bid-list">
        <h2>Ставки користувачів: </h2>
        <?php foreach ($bids as $bid): ?>
            <h5>Ставка № <?php echo htmlspecialchars($bid['IDBid']); ?> - <?php echo htmlspecialchars($bid['BidAmount']); ?> в <?php echo htmlspecialchars($bid['BidTime']); ?></h5>
        <?php endforeach; ?>
        <?php if (isset($_SESSION['user_id'])) :?>
        <form id="bid-form" method="POST">
            <input type="hidden" id="auctionId" name="auctionId" value="<?php echo htmlspecialchars($auctionId); ?>">
            <input type="hidden" id="clientId" name="clientId" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>"> 
            <input type="number" id="bidAmount" name="bidAmount" placeholder="Ваша ставка" required>
            <button type="submit">Виставити ставку</button>
        </form>
        <?php endif; ?>
    </div>

    </div>

    </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const auctionId = "<?php echo htmlspecialchars($auctionId); ?>";
        const endAuction = new Date("<?php echo htmlspecialchars($auction['EndAuction']); ?>").getTime();

        let checkAuctionInterval;
        let fetchBidsInterval;

        // Перевірка на кінець та наближення кінця аукціона
        function checkAuctionEnd() {
            const now = new Date().getTime();
            const timeLeft = endAuction - now;

            if (timeLeft <= 3600000 && timeLeft > 0) {
                document.getElementById('warning').innerText = "Увага! Скоро кінець аукціона!";
            } else {
                document.getElementById('warning').innerText = "";
            }

            if (timeLeft <= 0) {
                clearInterval(checkAuctionInterval);
                clearInterval(fetchBidsInterval);
                document.getElementById('bid-form').style.display = "none";
                document.getElementById('warning').innerText = "Увага! Аукціон завершено!";
            }
        }

        checkAuctionInterval = setInterval(checkAuctionEnd, 1000);

        //AJAX код
        function fetchBids() {
            fetch(`<?php echo $_SERVER['PHP_SELF']; ?>?IDAuction=${auctionId}`)
                .then(response => response.text())
                .then(data => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(data, 'text/html');
                    const bidList = doc.getElementById('bid-list').innerHTML;
                    document.getElementById('bid-list').innerHTML = bidList;

                    const auctionDetails = doc.getElementById('auction-details').innerHTML;
                    document.getElementById('auction-details').innerHTML = auctionDetails;
                });
        }

        fetchBidsInterval = setInterval(fetchBids, 5000); // Оновлення сторінки кожні 5 секунд

        document.getElementById('bid-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('<?php echo $_SERVER['PHP_SELF']; ?>?IDAuction=<?php echo htmlspecialchars($auctionId); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                alert(result);
                fetchBids();
            });
        });
    });

    </script>
</body>
</html>