<?php
require('../configure.php');
session_start();


$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
$total = mysqli_num_rows($result);



?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>profile - Admin</title>
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
          <div class="table-responsive mt-4">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">S.N</th>
                  <th scope="col">Full name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>

                <?php if ($total != 0) {

                  while ($data = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr>
                       <td>" . $data['id'] . "</td>
                       <td>" . $data['fullname'] . "</td>
                      <td>" . $data['email'] . "</td>
                      <td>
                          <a class='btn btn-primary btn-sm' href='edit-user.php ?rn=$data[id]' >
                         <i class='bi bi-pencil'></i>
                         </a>
                      </td>
                    </tr>";
                  }
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