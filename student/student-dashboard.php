<?php
session_start();
if (isset($_SESSION['id'])) {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            header('Location: ../admin/dashboard.php');
        }
    }
    $id = $_SESSION['id'];
}

include('../config/connection.php');
$sql = "SELECT * FROM `students` WHERE `id`='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if (isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['email'])) {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <?php $pageTitle = "Student Dashboard"; ?>
    <?php include('../partials/head.php'); ?>

    <body>
        <?php include('../partials/header.php'); ?>
        <div class="container mt-5 border rounded p-5">
            <h1 class="mb-3">Welcome,
                <?php echo $row['name']; ?>!
            </h1>
            <a onclick="return confirm('Logout of the current session?')" href="student-logout.php"
                class="btn btn-dark px-3">Logout</a>
            <a href="student-edit.php?id=<?php echo $id; ?>" class="btn btn-info px-3">Edit Profile</a>
            <a href="student-password-change.php?id=<?php echo $id; ?>" class="btn btn-danger px-3">Change Password</a>
            <h4 class="mt-5">Account Details:</h4>
            <div class="table-responsive my-3">
                <table class="table table-striped table-bordered border-primary text-center align-middle">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Birthday</th>
                            <th>School/College</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $row['name']; ?>
                            </td>
                            <td>
                                <?php echo $row['email']; ?>
                            </td>
                            <td>
                                <?php echo date("F d, Y", strtotime($row['birthday'])); ?>
                            </td>
                            <td>
                                <?php echo $row['institute']; ?>
                            </td>
                            <td>
                                <?php echo ucfirst($row['gender']); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="my-3">
                <h4>Contests participated in:</h4>
                <?php
                $sql2 = "SELECT * FROM `contest_participants` WHERE `student_id`='$id'";
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    ?>
                    <ol>
                        <?php while ($row2 = mysqli_fetch_array($result2)) {
                            $contest_id = $row2['contest_id'];
                            $sql3 = "SELECT * FROM `contests` WHERE `id`='$contest_id'";
                            $result3 = mysqli_query($conn, $sql3);
                            $row3 = mysqli_fetch_array($result3);
                            ?>
                            <li>
                                <a href="../details.php?id=<?php echo $contest_id; ?>">
                                    <?php echo $row3['title']; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ol>
                <?php } else { ?>
                    <p>You haven't participated in any contest yet.</p>
                <?php } ?>
            </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
    </body>

    </html>

    <?php

} else {
    header("Location: student-login.php");
    exit();
}
?>