<?php
session_start();
if (isset($_SESSION['id'])) {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'student') {
            header('Location: ../student/student-dashboard.php');
        }
    }
}
include('../config/connection.php');
if (isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['email'])) {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <?php $pageTitle = "Admin Dashboard"; ?>
    <?php include('../partials/head.php'); ?>

    <body>
        <?php include('../partials/header.php'); ?>
        <div class="container mt-5 border rounded p-5">
            <h1 class="mb-3">Welcome,
                <?php echo $_SESSION['name']; ?>!
            </h1>
            <a onclick="return confirm('Logout of the current session?')" href="logout.php"
                class="btn btn-dark px-3">Logout</a>
            <a href="change-password.php" class="btn btn-danger px-3">Change Password</a>
            <?php
            $admin = $_SESSION['id'];
            $sql = "SELECT * FROM `contests` WHERE `user` = '$admin' ORDER BY `id`";
            $result = mysqli_query($conn, $sql);
            ?>
            <h3 class="mt-4">Contests Created:</h3>
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <div class="table-responsive my-3">
                    <table class="table table-striped table-bordered border-primary text-center align-middle">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Organizer</th>
                                <th>Date</th>
                                <th>Banner</th>
                                <th>Registrations</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td>
                                        <a href="../details.php?id=<?php echo $row['id']; ?>">
                                            <?php echo $row['title']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?php echo $row['organizer']; ?>
                                    </td>
                                    <td>
                                        <?php echo date("F d, Y", strtotime($row['eventDate'])); ?>
                                    </td>
                                    <td>
                                        <img class="rounded" width="150" height="100" src="../images/<?php echo $row['image']; ?>"
                                            alt="<?php echo $row['image']; ?>">
                                    </td>
                                    <td>
                                        <?php
                                        $contest_id = $row['id'];
                                        $sql3 = "SELECT COUNT(*) as count FROM `contest_participants` WHERE `contest_id`='$contest_id'";
                                        $result3 = mysqli_query($conn, $sql3);
                                        $row3 = mysqli_fetch_assoc($result3);
                                        echo $row3['count'];
                                        ?>
                                    </td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    </td>
                                    <?php
                                    if (isset($_POST['delete'])) {
                                        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
                                        echo "<script>
                                                const result = confirm('Are you sure you want to delete this contest?');
                                                if (result) {
                                                    window.location.href = 'delete.php?id=' + $id_to_delete;
                                                } else {
                                                    window.location.href = 'dashboard.php';
                                                }
                                            </script>";
                                    }
                                    ?>
                                    <td>
                                        <form action="dashboard.php" method="POST">
                                            <input type="hidden" name="id_to_delete" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="delete" class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <p>You haven't created any contest yet :(</p>
            <?php } ?>
            <a href="add.php" class="btn btn-success btn-lg px-3">Create New Contest</a>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
    </body>

    </html>

    <?php

} else {
    header("Location: login.php");
    exit();
}
?>