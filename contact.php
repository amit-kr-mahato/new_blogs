<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
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
          aria-label="Toggle navigation"
        >
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
<body style="background-color:#030c4f ;">
    <div class="container mt-5 rounded " style="width: 50%; background-color:#038580;">
        <h2 class="text-black text-center">Contact Us</h2>
        <p  class="text-black text-center">We would love to hear from you! Please fill out the form below.</p>
        <form action="submit_contact.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label text-black ">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label text-black">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label text-black">Subject <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label text-black">Message <span class="text-danger">*</span></label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-danger text-black">Send Message</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>