<?php
session_start();
if (isset($_SESSION['id'])) {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            header('Location: ../admin/dashboard.php');
        }
    }
    $id = $_SESSION['id'];
} else {
    header('Location: ../index.php');
}

include('../config/connection.php');
$sql = "SELECT * FROM `students` WHERE `id`='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Change Password"; ?>
<?php include('../partials/head.php'); ?>

<body>
    <?php include('../partials/header.php'); ?>
    <div class="container my-5 border rounded p-5">
        <h3>Change Password</h3>
        <form class="mt-3" action="student-password-check.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="student_to_edit" value="<?php echo $id; ?>">
            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Old Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password2" class="form-label fw-bold">New Password</label>
                <input type="password" class="form-control" id="password2" name="password2" required>
            </div>
            <div class="mb-3">
                <label for="password3" class="form-label fw-bold">New Password</label>
                <input type="password" class="form-control" id="password3" name="password3" required>
            </div>
            <button type="submit" name="changeStudentPass" class="btn btn-primary">Change Password</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>