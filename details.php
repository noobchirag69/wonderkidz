<?php
session_start();
if (isset($_SESSION['id'])) {
    $student_id = $_SESSION['id'];
}
include('config/connection.php');
$id = $_GET['id'];
$sql = "SELECT * FROM `contests` WHERE `id`='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$sql2 = "SELECT * FROM `contest_participants` WHERE `student_id`='$student_id' AND `contest_id`='$id'";
$result2 = mysqli_query($conn, $sql2);
?>

<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Details"; ?>
<?php include('partials/head.php'); ?>

<body>
    <?php include('partials/header.php'); ?>
    <div class="container my-5 border rounded p-5">
        <h3 class="mb-4">
            <?php echo $row['title']; ?>
        </h3>
        <div style="max-width: 500px;">
            <img class="img-fluid rounded" src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>"
                title="<?php echo $row['title']; ?>">
        </div>
        <p>
            <?php echo html_entity_decode($row['description']); ?>
        </p>
        <p>
            <strong>Registrations: </strong>
            <?php
            $sql3 = "SELECT COUNT(*) as count FROM `contest_participants` WHERE `contest_id`='$id'";
            $result3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_assoc($result3);
            echo $row3['count'];
            ?>
        </p>
        <p>
            <strong>Event Date: </strong>
            <?php echo date("F d, Y", strtotime($row['eventDate'])) . "."; ?>
        </p>
        <p>
            <strong>Last Date to Register: </strong>
            <?php echo date("F d, Y", strtotime($row['last_registration'])) . "."; ?>
        </p>
        <p>
            <strong>Prizes: </strong>
            <?php echo $row['prizes'] . "."; ?>
        </p>
        <p>
            <strong>Mode: </strong>
            <?php echo ucfirst($row['mode']) . "."; ?>
        </p>
        <p>
            <strong>Hosted By: </strong>
            <?php echo $row['organizer'] . "."; ?>
        </p>
        <?php
        $fees = $row['fees'];
        $discount = $row['discount'];
        $discount_amount = ($discount / 100) * $fees;
        $new_fees = $fees - $discount_amount;
        ?>
        <p>
            <strong>Registration Fees: </strong>
            <span>Rs. <s>
                    <?php echo $fees; ?>
                </s>
                <?php echo "&nbsp;" . $new_fees; ?>/- only. (This discount of
                <?php echo $discount ?>% is only available if the registration is done through <b>WonderKidz</b>
                platform)
            </span>
        </p>
        <?php if (isset($_SESSION['id'])) { ?>
            <?php if ($_SESSION['role'] != 'admin') { ?>
                <?php if (mysqli_num_rows($result2) > 0) { ?>
                    <h3>You have already registered for this contest!</h3>
                <?php } else { ?>
                    <a href="student/participate.php?id=<?php echo $id; ?>" class="btn btn-success px-5">Register</a>
                <?php } ?>
            <?php } ?>
        <?php } else { ?>
            <h4>Please login with a valid student profile to register for this contest.</h4>
        <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>