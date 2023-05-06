<?php
include('../config/connection.php');
$id = $_GET['id'];
$query = "DELETE FROM `contests` WHERE `id` = '$id'";
if (mysqli_query($conn, $query)) {
    header('Location: dashboard.php');
} else {
    echo 'Query Error: ' . mysqli_error($conn);
}
?>