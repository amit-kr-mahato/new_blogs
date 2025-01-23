<?php
include 'configure.php';

$query1 = "SELECT * FROM createcategories";
$result1 = mysqli_query($conn, $query1);
$category = mysqli_num_rows($result1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blogs website</title>
  <link rel="stylesheet" href="style.css">
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet" />
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-dark py-3">
    <div class="container">
      <a class="navbar-brand" href="index.php">
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
            <a href="register.php" class="nav-link text-danger btn btn-warning">Register</a>
          </li>
          <a href="login.php" class="btn btn-warning ms-4">Login</a>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container ">
    <div class="row ">
    <?php if ($category != 0) {

while ($total = mysqli_fetch_assoc($result1)) {
?>
      <div class="col-lg-2 mt-4 mb-4">
        <div class="card">
          <img
            src="admin/images/categories/<?= $total['image'] ?>"
            class="card-img-top"
            alt="..." />
          <div class="card-body">
            <h5 class="card-title"><?= $total['title'] ?></h5>
          </div>
        </div>
      </div>
     
      <?php }
      } ?>
    </div>
  </div>

  <section class="bg-dark  py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h1 class="text-light fs-3"><img style="height: 70px;" src="img/IMG-20241201-WA0004-removebg-preview.png" alt=""></h1>
        </div>
        <div class="col-md-4 ">
          <a class="text-light fs-2 text-decoration-none me-5 " href="#"><i class="fab fa-facebook text-primary"></i></a>
          <a class="text-light fs-2 text-decoration-none ms-2 me-5 " href="#"><i class="fab fa-instagram text-danger"></i></a>
          <a class="text-light fs-2 text-decoration-none " href="#"><i class="fab fa-twitter text-primary"></i></a>
        </div>
        <div class="col-md-4 ">
          <p class="text-light text-end">@ your company 2024 ,we love you ?</p>
        </div>
      </div>
    </div>
  </section>


  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
   
</body>

</html>