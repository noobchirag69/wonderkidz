<?php
session_start();
if (isset($_SESSION['id'])) {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            header('Location: ../admin/dashboard.php');
        }
    }
} else {
    header('Location: ../index.php');
}

include('../config/connection.php');
$id = $_GET['id'];
$sql = "SELECT * FROM `contests` WHERE `id`='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Details"; ?>
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
        <a onclick="return confirm('This link will take you to the payment portal, sure you want to continue?')"
            href="participate-check.php?id=<?php echo $id; ?>" class="btn btn-info px-5">Confirm Registration</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>