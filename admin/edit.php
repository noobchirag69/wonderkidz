<?php
session_start();
if (isset($_SESSION['id'])) {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'student') {
            header('Location: ../student/student-dashboard.php');
        }
    }
} else {
    header('Location: ../index.php');
}
include('../config/connection.php');
$id = $_GET['id'];
$sql = "SELECT * FROM `contests` WHERE `id`='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Edit"; ?>
<?php include('../partials/head.php'); ?>

<body>
    <?php include('../partials/header.php'); ?>
    <div class="container my-5 border rounded p-5">
        <h3>Edit Contest</h3>
        <form class="mt-3" action="edit-check.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_to_edit" value="<?php echo $row['id']; ?>">
            <div class="mb-3">
                <label for="image" class="form-label fw-bold">Banner/Poster (JPEG/JPG/PNG/WEBP)</label>
                <input type="file" class="form-control mb-2" id="image" name="image">
                <?php if ($row['image']) { ?>
                    <img class="rounded" width="150" height="100" src="../images/<?php echo $row['image']; ?>"
                        alt="<?php echo $row['title']; ?>" title="<?php echo $row['title']; ?>">
                <?php } ?>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    placeholder="Please enter the name of the competition" value="<?php echo $row['title']; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="organizer" class="form-label fw-bold">Organization Name</label>
                <input type="text" class="form-control" id="organizer" name="organizer"
                    placeholder="Please enter the name of the organization that is organizing this contest"
                    value="<?php echo $row['organizer']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label fw-bold">Event Date</label>
                <input type="date" class="form-control" id="date" name="eventDate"
                    value="<?php echo $row['eventDate']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="last_registration" class="form-label fw-bold">Last Date of Registration</label>
                <input type="date" class="form-control" id="last_registration" name="last_registration"
                    value="<?php echo $row['last_registration']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="mode" class="form-label fw-bold">Mode</label>
                <select class="form-select" aria-label="Default select example" name="mode" id="mode" required>
                    <option>Please select the mode of the contest</option>
                    <option value="offline" <?php if ($row['mode'] === 'offline')
                        echo 'selected' ?>>Offline</option>
                        <option value="online" <?php if ($row['mode'] === 'online')
                        echo 'selected' ?>>Online</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea class="form-control" id="description" name="description" required>
                    <?php echo $row['description']; ?>
                </textarea>
            </div>
            <script>
                ClassicEditor
                    .create(document.querySelector('#description'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            </script>
            <div class="mb-3">
                <label for="prizes" class="form-label fw-bold">Prizes</label>
                <input type="text" class="form-control" id="prizes" name="prizes"
                    placeholder="Write about the prizes shorty" value="<?php echo $row['prizes']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="fees" class="form-label fw-bold">Registration Fees (Rs.)</label>
                <input type="number" class="form-control" id="fees" name="fees"
                    placeholder="Enter the fees per participant" value="<?php echo $row['fees']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="commission" class="form-label fw-bold">Commission (%)</label>
                <input type="number" class="form-control" id="commission" name="commission"
                    placeholder="Commission Percentage" value="<?php echo $row['commission']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label fw-bold">Discount (%)</label>
                <input type="text" class="form-control" id="discount" name="discount"
                    placeholder="Discount percentage on registering through WonderKidz"
                    value="<?php echo $row['discount']; ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>