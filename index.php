<?php
session_start();
include('config/connection.php');
$sql = 'SELECT * FROM `contests` ORDER BY id DESC';
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Home"; ?>
<?php include('partials/head.php'); ?>

<body>
  <?php include('partials/header.php'); ?>
  <div class="container my-5 border rounded p-5">
    <h3>Contests:</h3>
    <?php if (!$row) { ?>
      <p>No contests to show :/</p>
    <?php } else { ?>
      <?php foreach ($row as $contest) { ?>
        <div class="card mb-3 mt-4">
          <div class="row g-0">
            <div class="col-md-4">
              <?php if ($contest['image'] !== "") { ?>
                <img class="img-fluid h-100 w-100 rounded-start" src="images/<?php echo $contest['image'] ?>"
                  class="img-fluid rounded-start" alt="<?php echo $contest['image'] ?>"
                  title="<?php echo $contest['title']; ?>">
              <?php } else { ?>
                <img class="img-fluid h-100 w-100 rounded-start" src="https://via.placeholder.com/400x300"
                  alt="<?php echo $contest['title']; ?>" title="<?php echo $contest['title']; ?>">
              <?php } ?>
            </div>
            <div class="col-md-8">
              <div class="card-body p-5">
                <h4 class="card-title mb-3">
                  <?php echo $contest['title']; ?>
                </h4>
                <p class="card-text">
                  <strong>Date:</strong>
                  <?php echo date("F d, Y", strtotime($contest['eventDate'])) . "."; ?>
                </p>
                <p class="card-text">
                  <strong>Hosted By:</strong>
                  <?php echo $contest['organizer'] . "."; ?>
                </p>
                <a href="details.php?id=<?php echo $contest['id']; ?>" class="btn btn-outline-success">View Details</a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>