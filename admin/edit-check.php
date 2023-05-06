<?php
session_start();
include "../config/connection.php";

if (isset($_POST['update'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = validate($_POST['id_to_edit']);
    $title = validate($_POST['title']);
    $description = validate($_POST['description']);
    $prizes = validate($_POST['prizes']);
    $mode = validate($_POST['mode']);
    $organizer = validate($_POST['organizer']);
    $eventDate = validate($_POST['eventDate']);
    $fees = validate($_POST['fees']);
    $commission = validate($_POST['commission']);
    $discount = validate($_POST['discount']);
    $last_registration = validate($_POST['last_registration']);

    $allowed_types = array("jpg", "jpeg", "png", "webp", );

    if (!empty($_FILES['image']['name'])) {
        $file_name = $_FILES['image']['name'];
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_type, $allowed_types)) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $target_folder = "../images/";
            $new_file_name = uniqid() . '_' . $file_name;

            $sql = "SELECT * FROM `contests` WHERE `image`='$new_file_name'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $new_file_name = uniqid() . '_' . $file_name;
            }

            $target_path = $target_folder . $new_file_name;

            if (move_uploaded_file($tmp_name, $target_path)) {
                $sql2 = "UPDATE `contests` SET `title`='$title', `description`='$description', `prizes`='$prizes', `mode`='$mode', `organizer`='$organizer', `eventDate`='$eventDate', `fees`='$fees', `commission`='$commission', `discount`='$discount', `last_registration`='$last_registration', `image`='$new_file_name' WHERE `id`='$id'";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2) {
                    echo '<script type="text/javascript">
                      alert("Contest successfully updated!");
                      window.location.replace("../");
                    </script>';
                    exit();
                } else {
                    echo '<script type="text/javascript">
                      alert("Unexpected error occured, try after some time!");
                      window.location.replace("dashboard.php");
                    </script>';
                    exit();
                }
            } else {
                echo '<script type="text/javascript">
                    alert("The image could not be uploaded, please try after some time!");
                    window.location.replace("dashboard.php");
                  </script>';
                exit();
            }
        } else {
            echo '<script type="text/javascript">
              alert("Only JPEG, JPG, PNG and WEBP images are supported.");
              window.location.replace("dashboard.php");
            </script>';
            exit();
        }
    } else {
        $sql3 = "UPDATE `contests` SET `title`='$title', `description`='$description', `prizes`='$prizes', `mode`='$mode', `organizer`='$organizer', `eventDate`='$eventDate', `fees`='$fees', `commission`='$commission', `discount`='$discount', `last_registration`='$last_registration' WHERE `id`='$id'";
        $result3 = mysqli_query($conn, $sql3);
        if ($result3) {
            echo '<script type="text/javascript">
                      alert("Contest successfully updated!");
                      window.location.replace("../");
                    </script>';
            exit();
        } else {
            echo '<script type="text/javascript">
                      alert("Unexpected error occured, try after some time!");
                      window.location.replace("dashboard.php");
                    </script>';
            exit();
        }
    }
}

?>