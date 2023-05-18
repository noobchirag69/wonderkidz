<?php

session_start();

require '../config/config.php';
require '../config/connection.php';

require '../vendor/autoload.php';

use Razorpay\Api\Api;

if (isset($_POST['payNow'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $amount = validate($_POST['amount']);
    $api = new Api(API_KEY, API_SECRET);

    $res = $api->order->create(
        array(
            'receipt' => '123',
            'amount' => $amount,
            'currency' => 'INR'
        )
    );

    if (!empty($res['id'])) {
        $_SESSION['order_id'] = $res['id'];
        ?>
        <form action="success.php" method="POST">
            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo API_KEY; ?>"
                data-amount="<?php echo $amount; ?>" data-currency="INR" data-order-id="<?php echo $res['id']; ?>"
                data-buttontext="Pay Rs. <?php echo ($amount / 100); ?>/-" data-name="<?php echo COMPANY_NAME; ?>" data-prefill.name="<?php echo $name; ?>" data-prefill.email="<?php echo $email; ?>">
                </script>
            <input type="hidden" custom="Hidden Element" name="hidden">
        </form>
    <?php
    }
}

?>