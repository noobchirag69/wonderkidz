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
$sql = "SELECT * FROM `students` WHERE `id`='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Edit"; ?>
<?php include('../partials/head.php'); ?>

<body>
    <?php include('../partials/header.php'); ?>
    <div class="container my-5 border rounded p-5">
        <h3>Edit Profile</h3>
        <form class="mt-3" action="student-edit-check.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="student_to_edit" value="<?php echo $row['id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label fw-bold">Birthday</label>
                <input type="date" class="form-control" id="birthday" name="birthday"
                    value="<?php echo $row['birthday']; ?>">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label fw-bold">Gender</label>
                <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                    <option>Please select your gender</option>
                    <option value="male" <?php if ($row['gender'] === 'male')
                        echo 'selected' ?> >Male</option>
                        <option value="female" <?php if ($row['gender'] === 'female')
                        echo 'selected' ?> >Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="institute" class="form-label fw-bold">School/College</label>
                    <input type="text" class="form-control" id="institute" name="institute"
                        value="<?php echo $row['institute']; ?>">
            </div>
            <button type="submit" name="updateStudent" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>