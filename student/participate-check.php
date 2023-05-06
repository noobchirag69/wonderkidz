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

include('../config/connection.php');
$contest_id = $_GET['id'];
$sql = "INSERT INTO `contest_participants` (`contest_id`, `student_id`) VALUES ('$contest_id', '$student_id')";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo '<script type="text/javascript">
                      alert("Registration to the contest successful!");
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

?>