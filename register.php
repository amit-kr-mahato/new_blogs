<?php
include 'configure.php';
session_start();
$message = "";
$messageType = "";

if (isset($_POST['register'])) {
  $fullname = $_POST['fullname'];
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $image = $_FILES["image"];

  $upload_folder_path = "images/user/";
  $imageName = $image['name'];

  $fileExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

  $fileNewName = uniqid('', true) . "-" . $imageName;
  $fileDestination = $upload_folder_path . $fileNewName;
  move_uploaded_file($image['tmp_name'], $fileDestination);

  // Check if email already exists
  $checkEmail = "SELECT * FROM users WHERE email = '$email'";
  $result = $conn->query($checkEmail);


  if ($result->num_rows > 0) {
    $message = "Email is already registered.";
    $messageType = "danger";
  } else {
    $sql = "INSERT INTO users (fullname, email, password,image) VALUES ('$fullname', '$email', '$password','$fileNewName')";

    if ($conn->query($sql) === TRUE) {
      session_start();
      $_SESSION['message'] = "Registration successful. Please login.";
      $_SESSION['messageType'] = "success";
      header("Location: login.php");
      exit;
    } else {
      $message = "Error: " . $conn->error;
      $messageType = "danger";
    }
  }
}
?>






<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-dark py-3">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img style="height:70px" src="img/IMG-20241201-WA0004-removebg-preview.png" alt="">
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-light" aria-current="page" href="post.php">Home</a>
          </li>
          <li class="nav-item ms-4">
            <a class="nav-link text-light" href="contact.php">Contact Us</a>
          </li>
          <li class="nav-item ms-4">
            <a class="nav-link text-light">Categories</a>
          </li>
          <li class="nav-item ms-4">
            <button type="button" class="btn btn-warning"> <a href="register.php"></a>Register</button>
          </li>
          <a href="login.php" class="btn btn-warning ms-4">Login</a>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-6 mx-auto">
        <?php if (!empty($message)): ?>
          <div class="alert alert-<?= $messageType ?>" role="alert">
            <?= $message ?>
          </div>
        <?php endif; ?>
        <div class="card">
          <div class="card-body p-4">
            <h2>Create Account</h2>
            <p>Enter your details.</p>
            <form action="#" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label class="form-label" for="fullname">Full Name
                  <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" name="fullname" placeholder="Enter your fullname">
              </div>
              <div class="form-group mt-3">
                <label class="form-label" for="email">Email
                  <span class="text-danger">*</span>
                </label>
                <input type="email" class="form-control" name="email" placeholder="Email">
              </div>
              <div class="form-group mt-3">
                <label class="form-label" for="password">Password
                  <span class="text-danger">*</span>
                </label>
                <input type="password" class="form-control" name="password" placeholder="Password">
              </div>
              <div class="form-group mt-3">
                <label class="form-label" for="password">upload image
                  <span class="text-danger">*</span>
                </label>
                <input type="file" class="form-control" name="image">

              </div>
              <button type="submit" name="register" class="btn btn-primary w-100 mt-4">Register</button>
              <div class="mt-4 text-center">
                <p>
                  Already have an Account? <a href="login.php" class="fw-semibold">Login</a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>