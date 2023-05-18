<?php
session_start();
if (isset($_SESSION['id'])) {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            header('Location: ../admin/dashboard.php');
        }
    }
    $student_id = $_SESSION['id'];
} else {
    header('Location: ../index.php');
}

require '../config/config.php';
require '../vendor/autoload.php';

include('../config/connection.php');

use Razorpay\Api\Api;

$api = new Api(API_KEY, API_SECRET);

$payment = $api->payment->fetch($_POST['razorpay_payment_id']);

$payment_data = [
    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
    'razorpay_order_id' => $_POST['razorpay_order_id'],
    'razorpay_signature' => $_POST['razorpay_signature']
];

try {
    $api->utility->verifyPaymentSignature($payment_data);
    $contest_id = $_GET['id'];
    $sql = "INSERT INTO `contest_participants` (`contest_id`, `student_id`) VALUES ('$contest_id', '$student_id')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<script type="text/javascript">
                    alert("You have successfully registered for this contest!");
                    window.location.replace("student-dashboard.php");
              </script>';
        exit();
    } else {
        echo '<script type="text/javascript">
                alert("Unexpected error occured, try after some time!");
                window.location.replace("student-dashboard.php");
              </script>';
        exit();
    }

} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>