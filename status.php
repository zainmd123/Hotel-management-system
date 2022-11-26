<?php
session_start();

$conn=mysqli_connect("localhost","root","","hotel");

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

require('vendor/autoload.php');

$amount = $_SESSION['final_amt'];
$UID = $_SESSION['user_id'];
$oid = $_POST['razorpay_order_id'];

$success = true;
$keyId = "rzp_test_euRAMPtWDQ6BS0";
$keySecret = "Nco5RFNfK65w6h0oGAkJV3nz";
$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {

        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{

    $query1 = "INSERT INTO transactions(User_Id,order_id,payment_status,amount) VALUES('$UID','$oid','$success','$amount')";
    mysqli_query($conn, $query1);
    $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";

    $query2 = "UPDATE room_book SET Amount = 0 WHERE User_Id = $UID";
    mysqli_query($conn, $query2);

    $query3 = "UPDATE event_book SET Amount = 0 WHERE User_Id = $UID";
    mysqli_query($conn, $query3);

    $query4 = "UPDATE dine_book SET Amount = 0 WHERE User_Id = $UID";
    mysqli_query($conn, $query4);

             
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
header("Location: ./home.html");
exit();
