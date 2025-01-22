<?php
include 'configure.php';
session_start();

$post_id = $_GET['id'];
$join = "SELECT posts.*, createcategories.title FROM posts 
          LEFT JOIN createcategories ON posts.category_id = createcategories.id 
          WHERE posts.id='$post_id'";

$result = mysqli_query($conn, $join);
$posts = mysqli_num_rows($result);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>post title</title>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
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
            <button type="button" class="btn btn-warning"> <a href="register.html"></a>Register</button>
          </li>
          <a href="login.php" class="btn btn-warning ms-4">Login</a>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="header mt-5">
      <?php if ($posts != 0) {

        while ($data = mysqli_fetch_assoc($result)) {
          //var_dump($data);
      ?>
          <p class="mb-1">
            <a class="text-decoration-none" href="index.php">Home </a>
          </p>
          <h4><?= $data['title'] ?></h4>
          <div class="content d-flex">
            <p class="text-info">Author</p>
            <p class="ms-2 me-2 text-primary">| <?= $data['title'] ?></p>
            <p>| <?php date_default_timezone_set("Asia/Kathmandu");
                  echo date("h:ia") ?></p>
          </div>

    </div>
    <div class="row">
      <div class="col-lg-9 border-bottom">
        <img
          style="width: 100%; height: 50%"
          src="admin/images/post/<?= $data['image'] ?>"
          alt="" />
        <p> <?= $data['description'] ?>
        </p>

        <nav class="nav justify-content-between  py-5">
          <div class="icons d-flex">
            <p class="fs-2 ms-2 me-4">Share this</p>
            <a class="nav-link" href="#"><i class="fab fa-facebook fs-2"></i></a>
            <a class="nav-link" href="#"><i class="fab fa-twitter fs-2"></i></a>
            <a class="nav-link" href="#"><i class="fab fa-instagram fs-2"></i></a>
          </div>
          <ul class="nav me-5">
            <button type="button" class="btn btn-primary mx-4 my-4">
              Design
            </button>
            <button type="button" class="btn btn-success mx-3 my-4">
              Web
            </button>
          </ul>
        </nav>
      </div>
      <div class="col-lg-3">
        <h4 class="mb-2">| Available Categories</h4>
        <p class="text-primary ms-3">Cameras</p>
        <p class="text-primary ms-3">lenses</p>
        <p class="text-primary ms-3">Accessories</p>
        <p class="text-primary ms-3">software</p>
        <p class="text-primary ms-3">printers</p>
      </div>
    </div>
<?php }
      } ?>

  </div>
  <div class="container pt-5">
    <h3>More posts</h3>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <img
            src="https://www.photographyblog.com/imager/entryimages/127929/fujifilm_xf_16_55mm_f2_8_r_lm_wr_ii_review_103c90e1ec5d69b15d400760b3c86bfb.webp"
            class="card-img-top"
            alt="..." />
        </div>
        <h4 class="mt-2">Fujifilm XF 16-55mm F2.8 R LM WR II</h4>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img
            src="https://www.photographyblog.com/imager/entryimages/127900/nikon_z_35mm_f1_4_review_103c90e1ec5d69b15d400760b3c86bfb.webp"
            class="card-img-top"
            alt="..." />
        </div>
        <h4 class="mt-2">Nikon Z 35mm f/1.4 </h4>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img
            src="https://www.photographyblog.com/imager/entryimages/122292/nikon_z_50mm_f1_2_s_01_8c9cd6ffa9b02044a7a3327bc82c5649.jpg"
            class="card-img-top"
            alt="..." />
        </div>
        <h4 class="mt-2">Nikon Z 50mm f/1.2 S</h4>
      </div>
    </div>
  </div>

  <div class="container">
    <h2 class="mt-5">Comments</h2>
    <div class="input-group mb-3">
      <input
        type="text"
        class="form-control"
        placeholder="your comments"
        aria-label=""
        aria-describedby="basic-addon2" />
      <span class="input-group-text bg-danger text-light" id="basic-addon2">Comments</span>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-8 bg-dark text-light py-3 d-flex">
        <div class="user">
          <i class="fa fa-user"></i>
          <p>user</p>
        </div>
        <div class="rply">
          <p class="">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit
            ea sed esse excepturi assumenda beatae deleniti.
          </p>
          <div class="display d-flex ms-5">
            <h6>reply</h6>
            <p class="text-primary ms-4">a min ago</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-md-8 bg-dark text-light py-3 d-flex">
        <div class="user">
          <i class="fa fa-user"></i>
          <p>user</p>
        </div>
        <div class="rply">
          <p class="">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit
            ea sed esse excepturi assumenda beatae deleniti.
          </p>
          <div class="display d-flex ms-5">
            <h6>reply</h6>
            <p class="text-primary ms-4">a min ago</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-5 mb-4">
      <div class="col-md-8 bg-dark text-light py-3 d-flex">
        <div class="user">
          <i class="fa fa-user"></i>
          <p>user</p>
        </div>
        <div class="rply">
          <p class="">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit
            ea sed esse excepturi assumenda beatae deleniti.
          </p>
          <div class="display d-flex ms-5">
            <h6>reply</h6>
            <p class="text-primary ms-4">a min ago</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section class="bg-dark py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h1 class="text-light fs-3"><img style="height: 60px;" src="img/IMG-20241201-WA0004-removebg-preview.png" alt=""></h1>
        </div>
        <div class="col-md-4">
          <a class="text-light fs-4 text-decoration-none me-5 " href="https://www.facebook.com/"><i class="fab fa-facebook text-primary"></i></a>
          <a class="text-light fs-4 text-decoration-none ms-2 me-5" href="https://x.com/i/flow/login"><i class="fab fa-twitter text-primary"></i></a>
          <a class="text-light fs-4 text-decoration-none" href="https://www.instagram.com/"><i class="fab fa-instagram text-danger"></i></a>
        </div>
        <div class="col-md-4">
          <p class="text-light text-end">
            @ your company 2024 ,we love you ?
          </p>
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