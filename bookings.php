<?php
// Start the session
session_start();
?>
<!DOCTYPE <html>

<html>
<head>
    <title>Bookings</title>
    <link rel="icon" type="image/png" href="images/favicon.jpg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Work+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
    
  </head>
</html>
<body>
<div class="site-wrap">
    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> 
    <!-- .site-mobile-menu -->
    
   <!-- menubar used in all sites-->
       <div class="site-navbar-wrap js-site-navbar bg-white">
      
      <div class="container">
        <div class="site-navbar bg-light">
          <div class="py-1">
            <div class="row align-items-center">
              <div class="col-2">
                <h2 style="font-family:'coiny',bold; color: #FFFFFF; text-shadow: 4px 4px 4px gray;">Holiday</h2>
              </div>
              <div class="col-10">
                <nav class="site-navigation text-right" role="navigation">
                  <div class="container">
                    
                    <div class="d-inline-block d-lg-none  ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu h3"></span></a></div>
                    <ul class="site-menu js-clone-nav d-none d-lg-block">

                      <li >
                        <a href="home.html">Home</a>
                      </li>
                      <li>
                        <a href="rooms_loggedin.html">Rooms</a>
                      </li>
                      <li>
                        <a href="events_loggedin.html">Events</a>
                      </li>
                      <li>
                        <a href="dine_loggedin.html">Dine</a>
                      </li>
                      <li>
                        <a href="facilities_loggedin.html">Facilities</a>
                      </li>
                      <li>
                        <a href="tourism_loggedin.html">Tourism Near</a>
                      </li>
                      <li class="active">
                        <a href="bookings.php">Bookings</a>
                      </li>
                      <li>
                        <a href="index.html">Logout</a>
                      </li>

                      </ul>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="site-blocks-cover overlay" data-aos="fade" data-stellar-background-ratio="0.5" style="color:white">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-md-7 text-center" data-aos="fade">
            <?php
            
        $conn=mysqli_connect("localhost","root","","hotel");
        $user_id = $_SESSION['user_id'];
        $final_amt = 1;
        if(!$conn)
        echo "Connection failed";

        $sqlquery1 = "SELECT * FROM `dine_book` WHERE User_Id = '$user_id'";
        $res = mysqli_query($conn, $sqlquery1);
        if(mysqli_num_rows($res) > 0)
        {
            while($row = mysqli_fetch_assoc($res))
            {
                echo "Table Name:" . "&nbsp&nbsp". $row["Table_name"]. "<br>";
                echo "Guest:" . "&nbsp&nbsp". $row["Guest"]. "<br>";
                echo "Date: " . "&nbsp&nbsp". $row["Event_date"]. "<br>";
                echo "Time:" . "&nbsp&nbsp". $row["Event_time"]. "<br>";
                echo "Amount:" . "&nbsp&nbsp". $row["Amount"]. "<br><br><br>";
                $final_amt = $final_amt + $row['Amount'];
            }
        }
        else{
          echo "No dine booking<br><br><br>";
        }

        
        $sqlquery2 = "SELECT * FROM `room_book` WHERE User_Id = '$user_id'";
        $res2 = mysqli_query($conn, $sqlquery2);
        if(mysqli_num_rows($res2) > 0)
        {
            while($row2 = mysqli_fetch_assoc($res2))
            {
                echo "Room Name:" . "&nbsp&nbsp". $row2["Room_name"]. "<br>";
                echo "Arrival:" . "&nbsp&nbsp". $row2["Arrival"]. "<br>";
                echo "Departure: " . "&nbsp&nbsp". $row2["Departure"]. "<br>";
                echo "Rooms:" . "&nbsp&nbsp". $row2["Rooms"]. "<br>";
                echo "Amount:" . "&nbsp&nbsp". $row2["Amount"]. "<br><br><br>";
                $final_amt = $final_amt + $row2['Amount'];
            }
        }
        else{
          echo "No room booking<br><br><br>";
        }


        $sqlquery3 = "SELECT * FROM `event_book` WHERE User_Id = '$user_id'";
        $res3 = mysqli_query($conn, $sqlquery3);
        if(mysqli_num_rows($res3) > 0)
        {
            while($row3 = mysqli_fetch_assoc($res3))
            {
                echo "Hall Name:" . "&nbsp&nbsp". $row3["Hall_name"]. "<br>";
                echo "Event Name:" . "&nbsp&nbsp". $row3["Event_name"]. "<br>";
                echo "Date: " . "&nbsp&nbsp". $row3["Event_date"]. "<br>";
                echo "Start Time:" . "&nbsp&nbsp". $row3["Start_time"]. "<br>";
                echo "Event Time:" . "&nbsp&nbsp". $row3["End_time"]. "<br>";
                echo "Amount:" . "&nbsp&nbsp". $row3["Amount"]. "<br><br><br>";
                $final_amt = $final_amt + $row3['Amount'];
            }
        }
        else{
          echo "No event booking<br><br><br>";
        }


				
	?>
  <?php

require "vendor/autoload.php";
use Razorpay\Api\Api;

$keyId = "rzp_test_euRAMPtWDQ6BS0";
$keySecret = "Nco5RFNfK65w6h0oGAkJV3nz";

if(!isset($_SESSION))
    session_start();

$api = new Api($keyId, $keySecret);
$actual_amount = $final_amt;
$currency = "INR";
$receipt = str_replace('.', '', microtime(as_float:true)).rand(1, 10000).'2';
$order = $api->order->create(array('receipt' => $receipt, 'amount' => $actual_amount * 100, 'currency' => $currency, 'payment_capture' => '1'));
$order_id = $order['id'];
$order_receipt = $order['receipt'];
$order_amount = $order['amount'];
$order_currency = $order['currency'];
$order_created_at = $order['created_at'];

$_SESSION['final_amt'] = $final_amt;
$_SESSION['razorpay_order_id'] = $order_id;
?>
            <form id = "rzrpay" action="status.php" method="POST">
                <script
                src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?=$keyId?>" 
    data-amount="<?=$actual_amount?>"
    data-currency="<?=$currency?>"
    data-order_id="<?=$order_id?>"
    data-buttontext="Make Payment"
    data-name="Holiday"
    data-description="Yes."
    data-image="https://example.com/your_logo.jpg"
    data-theme.color="#00AC4C"
></script>
<!-- <input type="hidden" custom="Hidden Element" name="hidden"> -->
          </form>
          </div>  
          </div>
        </div>
      </div> 
   
    <footer class="site-footer">
      <div class="container">
        

        <div class="row">
          <div class="col-md-12">
            <h3 class="footer-heading mb-4 text-white">Developed By</h3>
            <p style="font-size: 150%;">398 Aditya&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;399 Yogitha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;400 Yuvan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;401 Zain&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
          </div>
        </div>
      </div>
    </footer>
  </div>
   <!--footer ends-->


  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/mediaelement-and-player.min.js"></script>
  <script src="js/main.js"></script>   
  <script src="js/login.js"></script>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
                var mediaElements = document.querySelectorAll('video, audio'), total = mediaElements.length;

                for (var i = 0; i < total; i++) {
                    new MediaElementPlayer(mediaElements[i], {
                        pluginPath: 'https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/',
                        shimScriptAccess: 'always',
                        success: function () {
                            var target = document.body.querySelectorAll('.player'), targetTotal = target.length;
                            for (var j = 0; j < targetTotal; j++) {
                                target[j].style.visibility = 'visible';
                            }
                  }
                });
                }
            });
    </script>
</body>





