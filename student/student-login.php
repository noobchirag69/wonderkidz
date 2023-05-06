<?php
session_start();
if (isset($_SESSION['id'])) {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            header('Location: ../admin/dashboard.php');
        } elseif ($_SESSION['role'] == 'student') {
            header('Location: ../student/student-dashboard.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Student Login"; ?>
<?php include('../partials/head.php'); ?>

<body>
    <?php include('../partials/header.php'); ?>
    <div class="container mt-5 border rounded p-5">
        <h3>Login</h3>
        <span>Don't have an account? <a href="student-register.php">Create One!</a></span>
        <form class="mt-3" action="student-login-check.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" name="studentLogin" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>