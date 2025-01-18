<?php
require('../configure.php');
session_start();
if (!isset($_SESSION['id'])) {
  // Redirect to the login/register page
  header("Location: ../login.php");
}
$userId = $_SESSION['id'];
$query = "SELECT * FROM users where id='$userId'";
$result = mysqli_query($conn, $query);
$total = mysqli_fetch_assoc($result);



?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>profile - Admin</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background-color: rgb(3, 88, 60);">

  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-3">
        <?php
        include 'layouts/sidebar.php';
        ?>

        <div class="col-lg-6 bg-light ms-5">
          <div class="profile-container">
            <center>
              <img class="rounded-circle" width="150px" height="150px" src="../images/user/<?= $total['image'] ?>" alt="Profile Picture">

              <div class="text-start">
                <p><strong>Full Name:</strong> <?= $total['fullname'] ?> </p>
                <p><strong>Email:</strong> <?= $total['email'] ?></p>
              </div>
            </center>

            <a href="edit-profile.php"><button class="btn btn-primary btn-custom mt-5 me-5">Edit Profile</button></a>
            <a href="#"><button class="btn btn-warning btn-custom mt-5">Change Password</button></a>

          </div>

        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>