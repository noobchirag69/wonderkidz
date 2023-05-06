<?php
session_start();
if (isset($_SESSION['id'])) {
  if ($_SESSION['role'] == 'admin') {
    header('Location: admin/dashboard.php');
  } elseif ($_SESSION['role'] == 'student') {
    header('Location: student/student-dashboard.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Select Role"; ?>
<?php include('partials/head.php'); ?>

<body>
  <?php include('partials/header.php'); ?>
  <div class="container my-5 border rounded p-5">
    <h3>Choose your role:</h3>
    <div class="my-4">
      <a href="student/student-dashboard.php" class="btn btn-info w-100 mb-2">Student</a>
      <a href="admin/dashboard.php" class="btn btn-warning w-100">Admin</a>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>