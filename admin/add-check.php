<?php
session_start();
include "../config/connection.php";

if (isset($_POST['create'])) {

  function validate($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

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
  $user = $_SESSION['id'];

  $allowed_types = array("jpg", "jpeg", "png", "webp", );

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
      $sql2 = "INSERT INTO `contests`(`title`, `description`, `prizes`, `user`, `mode`, `organizer`, `eventDate`, `fees`, `commission`, `discount`, `last_registration`, `image`) VALUES('$title', '$description', '$prizes', '$user', '$mode', '$organizer', '$eventDate', '$fees', '$commission', '$discount', '$last_registration', '$new_file_name')";
      $result2 = mysqli_query($conn, $sql2);
      if ($result2) {
        echo '<script type="text/javascript">
                  alert("Contest successfully created!");
                  window.location.replace("../");
                </script>';
        exit();
      } else {
        echo '<script type="text/javascript">
                  alert("Unexpected error occured, try after some time!");
                  window.location.replace("add.php");
                </script>';
        exit();
      }
    } else {
      echo '<script type="text/javascript">
              alert("The image could not be uploaded, please try after some time!");
              window.location.replace("add.php");
            </script>';
      exit();
    }
  } else {
    echo '<script type="text/javascript">
          alert("Only JPEG, JPG, PNG and WEBP images are supported.");
          window.location.replace("add.php");
        </script>';
    exit();
  }

}

?>