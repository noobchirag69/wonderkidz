<?php
session_start();
include "../config/connection.php";

if (isset($_POST['register'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $password2 = validate($_POST['password2']);

    if ($password !== $password2) {
        echo '<script type="text/javascript">
              alert("Passwords should match!");
              window.location.replace("register.php");
            </script>';
        exit();
    } else {
        $password = md5($password);
        $sql = "SELECT * FROM `admins` WHERE `email`='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<script type="text/javascript">
                alert("This email address is already taken!");
                window.location.replace("register.php");
              </script>';
            exit();
        } else {
            $sql2 = "INSERT INTO `admins`(`name`, `email`, `password`, `role`) VALUES('$name', '$email', '$password', 'admin')";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                echo '<script type="text/javascript">
                  alert("Registration successful! Login to access your dashboard.");
                  window.location.replace("login.php");
                </script>';
                exit();
            } else {
                echo '<script type="text/javascript">
                  alert("Unexpected error occured, try after some time!");
                  window.location.replace("register.php");
                </script>';
                exit();
            }
        }
    }
}

?>