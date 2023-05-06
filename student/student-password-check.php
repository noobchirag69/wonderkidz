<?php
session_start();
include "../config/connection.php";

if (isset($_POST['changeStudentPass'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = $_POST['student_to_edit'];
    $sql = "SELECT * FROM `students` WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $password = validate($_POST['password']);
    $newPassword = validate($_POST['password2']);
    $confirmNewPassword = validate($_POST['password3']);

    if (md5($password) !== $row['password']) {
        echo '<script type="text/javascript">
              alert("Incorrect old password!");
              window.location.replace("student-password-change.php");
            </script>';
        exit();

    } elseif ($password === $newPassword) {
        echo '<script type="text/javascript">
              alert("Old and new passwords should not be same!");
              window.location.replace("student-password-change.php");
            </script>';
        exit();

    } elseif ($newPassword !== $confirmNewPassword) {
        echo '<script type="text/javascript">
              alert("Passwords should match!");
              window.location.replace("student-password-change.php");
            </script>';
        exit();

    } else {

        $newPassword = md5($newPassword);

        $sql2 = "UPDATE `students` SET `password` = '$newPassword' WHERE `id`='$id'";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2) {
            echo '<script type="text/javascript">
                  alert("Password has been changed successfully!");
                  window.location.replace("student-dashboard.php");
                </script>';
            exit();
        } else {
            echo '<script type="text/javascript">
                  alert("Unexpected error occured, try after some time!");
                  window.location.replace("student-password-change.php");
                </script>';
            exit();
        }
    }
}

?>