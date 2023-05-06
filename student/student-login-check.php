<?php
session_start();
include "../config/connection.php";

if (isset($_POST['studentLogin'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    $password = md5($password);

    $sql = "SELECT * FROM `students` WHERE `email`='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 0) {
        echo '<script type="text/javascript">
                  alert("Unregistered Email. Please register first!");
                  window.location.replace("student-login.php");
              </script>';
    }

    $sql2 = "SELECT * FROM `students` WHERE `email`='$email' AND `password`='$password'";
    $result2 = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($result2) === 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role'];
        echo '<script type="text/javascript">
                  alert("You have successfully logged in!");
                  window.location.replace("student-dashboard.php");
              </script>';
    } else {
        echo '<script type="text/javascript">
              alert("Incorrect Credentials!");
              window.location.replace("student-login.php");
            </script>';
        exit();
    }
}

?>