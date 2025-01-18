<?php
require('../configure.php');

session_start();
$query = "SELECT * FROM createcategories";
$result = mysqli_query($conn, $query);
$total = mysqli_num_rows($result);



?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Posts - Admin</title>
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

        <div class="col-lg-9">
          <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-light">categories</h2>
            <a href="create-categories.php" class="btn btn-primary">
              <i class="bi bi-plus"></i> Add New categories
            </a>
          </div>
          <?php if (!empty($message)): ?>
            <div class="alert alert-<?= $messageType ?>" role="alert">
              <?= $message ?>
            </div>
          <?php endif; ?>
          <div class="table-responsive mt-4">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">S.N</th>
                  <th scope="col">categories Title</th>
                  <th scope="col">Image</th>
                  <th scope="col">Date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($total != 0) {

                  while ($data = mysqli_fetch_assoc($result)) {
                    echo "
  <tr>
  <td>" . $data['id'] . "</td>
  <td>" . $data['title'] . "</td>
  <td><img width=80 height=80 src=".'images/categories/'. $data['image'] . "></td>
  <td>" . $data['create_at'] . "</td>
   <td>
       <a class='btn btn-primary btn-sm' href='edit-categories.php ?rn=$data[id]'' >
       <i class='bi bi-pencil'></i>
        </a>
        <a href='delete-categories.php ?rn=$data[id]' class='btn btn-danger btn-sm'>
        <i class='bi bi-trash'></i>
        </a>
       </td>
  </tr>
  ";
                  }
                } else {
                  echo "<tr>
                  <h4 class='text-center' style='color:yellow'>table is empty </h4>
                  </tr>
                  ";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>