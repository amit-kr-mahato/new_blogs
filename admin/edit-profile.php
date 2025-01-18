<?php
require('../configure.php');
session_start();
if (!isset($_SESSION['id'])) {
  // Redirect to the login/register page
  header("Location: ../login.php");
}
$userId = $_SESSION['id'];
$select = "SELECT * FROM users WHERE id='$userId'";
$query = mysqli_query($conn, $select);
$user = mysqli_fetch_assoc($query);



if (isset($_POST['update'])) {
  $fullname = mysqli_real_escape_string($conn, $_POST['fname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);

  $image = $_FILES["image"];
  $upload_folder_path = "../images/user/";
  $imageName = $image['name'];


  $fileNewName = uniqid('', true) . "-" . $imageName;
  $fileDestination = $upload_folder_path . basename($fileNewName);
  // die($fileDestination);
  move_uploaded_file($image['tmp_name'], $fileDestination);

  $queryUpdate = "UPDATE users SET fullname='$fullname', email='$email', image='$fileNewName' WHERE id='$userId'";
  $resultUpdate = mysqli_query($conn, $queryUpdate);

  if ($resultUpdate) {
    $message = "User  updated successfully";
    $messageType = "success";
    header("Location: edit-profile.php");
    exit();
  } else {
    $message = "Error updating user: " . mysqli_error($conn);
    $messageType = "danger";
  }
}


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

        <div class="col-lg-5 bg-light ms-5">
          <div class="profile-container">
            <form action="#" method="post" enctype="multipart/form-data">
              <center>

                <img class="rounded-circle" width="150px" height="150px" src="../images/user/<?= $user['image'] ?>" alt="Profile Picture">

                <input type="file" name="image" class="form-control" style="width: 80%;">

                <div class="text-start">
                  <table class="table">
                    <tr>
                      <th>Full Name:</th>
                      <td>
                        <input type="text" class="form-control" value="<?php echo $user['fullname'] ?>" name="fname">
                      </td>
                    </tr>
                    <tr>
                      <th>Email:</th>
                      <td><input type="text" class="form-control" value="<?php echo $user['email'] ?>" name="email"></td>
                    </tr>

                  </table>
                </div>


                <button class="btn btn-primary btn-custom mt-5 me-5 " name="update">save Profile</button>
              </center>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>