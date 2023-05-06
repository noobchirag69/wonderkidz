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
?>

<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Create"; ?>
<?php include('../partials/head.php'); ?>

<body>
    <?php include('../partials/header.php'); ?>
    <div class="container my-5 border rounded p-5">
        <h3>Create New Contest</h3>
        <form class="mt-3" action="add-check.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="image" class="form-label fw-bold">Banner/Poster (JPEG/JPG/PNG/WEBP)</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    placeholder="Please enter the name of the competition" required>
            </div>
            <div class="mb-3">
                <label for="organizer" class="form-label fw-bold">Organization Name</label>
                <input type="text" class="form-control" id="organizer" name="organizer"
                    placeholder="Please enter the name of the organization that is organizing this contest" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label fw-bold">Event Date</label>
                <input type="date" class="form-control" id="date" name="eventDate" required>
            </div>
            <div class="mb-3">
                <label for="last_registration" class="form-label fw-bold">Last Date of Registration</label>
                <input type="date" class="form-control" id="last_registration" name="last_registration" required>
            </div>
            <div class="mb-3">
                <label for="mode" class="form-label fw-bold">Mode</label>
                <select class="form-select" aria-label="Default select example" name="mode" id="mode" required>
                    <option selected>Please select the mode of the contest</option>
                    <option value="offline">Offline</option>
                    <option value="online">Online</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea class="form-control" id="description"
                    name="description" required>Please include Rules, Eligibility, Process, Registration Fees, Format, Venue etc., to make the contest clearer to the potential participants. Use bullet points for more clarity. The more details you provide, higher goes the chance of someone participating!</textarea>
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
                    placeholder="Write about the prizes shorty" required>
            </div>
            <div class="mb-3">
                <label for="fees" class="form-label fw-bold">Registration Fees (Rs.)</label>
                <input type="number" class="form-control" id="fees" name="fees"
                    placeholder="Enter the fees per participant" required>
            </div>
            <div class="mb-3">
                <label for="commission" class="form-label fw-bold">Commission (%)</label>
                <input type="number" class="form-control" id="commission" name="commission"
                    placeholder="Commission Percentage" required>
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label fw-bold">Discount (%)</label>
                <input type="text" class="form-control" id="discount" name="discount"
                    placeholder="Discount percentage on registering through WonderKidz" required>
            </div>
            <button type="submit" name="create" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>