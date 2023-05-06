<?php
session_start();
include "../config/connection.php";

if (isset($_POST['updateStudent'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = validate($_POST['student_to_edit']);
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $gender = validate($_POST['gender']);
    $birthday = validate($_POST['birthday']);
    $institute = validate($_POST['institute']);

    $sql = "UPDATE `students` SET `name`='$name', `email`='$email', `gender`='$gender', `birthday`='$birthday', `institute`='$institute' WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<script type="text/javascript">
                      alert("Profile successfully updated!");
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

}

?>