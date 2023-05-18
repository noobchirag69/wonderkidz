<?php
session_start();
if (isset($_SESSION['id'])) {
    $student_id = $_SESSION['id'];
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            header('Location: ../admin/dashboard.php');
        }
    }
} else {
    header('Location: ../index.php');
}

require '../config/config.php';
require '../vendor/autoload.php';

use Razorpay\Api\Api;

include('../config/connection.php');
$contest_id = $_GET['id'];
$sql = "SELECT * FROM `contests` WHERE `id`='$contest_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$sql2 = "SELECT * FROM `students` WHERE `id`='$student_id'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($result2);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Participate"; ?>
<?php include('../partials/head.php'); ?>

<body>
    <?php include('../partials/header.php'); ?>
    <div class="container my-5 border rounded p-5">
        <h3>Event:
            <?php echo $row['title']; ?>
        </h3>
        <?php
        $fees = $row['fees'];
        $discount = $row['discount'];
        $discount_amount = ($discount / 100) * $fees;
        $new_fees = $fees - $discount_amount;
        ?>
        <p>Amount Payable: Rs.
            <?php echo $new_fees; ?>/- only.
        </p>
        <?php
        $name = $row2['name'];
        $email = $row2['email'];
        $amount = $new_fees * 100;
        $api = new Api(API_KEY, API_SECRET);

        $orderData = array(
            'receipt' => mt_rand(10000000, 99999999),
            'amount' => $amount,
            'currency' => 'INR'
        );
        $res = $api->order->create($orderData);

        if (!empty($res['id'])) {
            $_SESSION['order_id'] = $res['id'];
        }
        ?>
        <button id="rzp-button1" class="btn btn-info px-4">Pay Now</button>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            let options = {
                "key": "<?php echo API_KEY; ?>",
                "amount": "<?php echo $amount; ?>",
                "currency": "INR",
                "name": "<?php echo COMPANY_NAME; ?>",
                "description": "Test Transaction",
                "image": "<?php echo COMPANY_LOGO; ?>",
                "order_id": "<?php echo $res['id']; ?>",
                "callback_url": "success.php?id=<?php echo $contest_id; ?>",
                "prefill": {
                    "name": "<?php echo $name; ?>",
                    "email": "<?php echo $email; ?>"
                },
                "theme": {
                    "color": "#1D3684"
                }
            };
            let rzp1 = new Razorpay(options);
            document.querySelector('#rzp-button1').onclick = (e) => {
                rzp1.open();
                e.preventDefault();
            }
        </script>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</body>

</html>