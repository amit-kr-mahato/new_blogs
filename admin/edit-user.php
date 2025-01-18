<?php
require('../configure.php');
session_start();

// Fetch the user to edit
$id = $_GET['rn'];
$select = "SELECT * FROM users WHERE id='$id'";
$query = mysqli_query($conn, $select);
$user = mysqli_fetch_assoc($query);



if (isset($_POST['submit'])) {
  $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);

  $image = $_FILES["image"];
  $upload_folder_path = "image/user/";
  $imageName = $image['name'];
  
  $fileExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

  $fileNewName = uniqid('', true) . "-" . $imageName . "." . $fileExt;
  $fileDestination = $upload_folder_path . basename($fileNewName);
  move_uploaded_file($image['tmp_name'], $fileDestination);

  $queryUpdate = "UPDATE users SET fullname='$fullname', email='$email', image='$fileNewName' WHERE id='$id'";
  $resultUpdate = mysqli_query($conn, $queryUpdate);

  if ($resultUpdate) {
    $message = "User  updated successfully";
    $messageType = "success";
    header("Location: index-user.php");
    exit();
  } else {
    $message = "Error updating user: " . mysqli_error($conn);
    $messageType = "danger";
  }
}


?>

<?php
/*
$sql="SELECT image FROM users WHERE id='$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    $userimage= $row["image"];
  

  }

}*/




?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Update</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background-color:#12473d ;">
  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-3">
        <?php
        include 'layouts/sidebar.php';
        ?>


        <div class="col-lg-9">
          <div class="card  shadow-sm p-4 mx-3" style="width: 650px;">

            <div class="text-center mb-4">
              <div class="rounded-circle bg-light d-flex justify-content-center align-items-center" style="width: 100px; height: 100px;">
                <img class="rounded-circle" width="100" height="90" src="../image/user/<?php echo $user['image'] ?>" />

                <!-- <i class="bi bi-person-circle" style="font-size: 3rem; color: gray;"></i> -->
              </div>
              <!-- <input type="file" name="fileToUpload" id="fileToUpload"> -->

            </div>
            <form method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="fullname" id="fullName" value="<?php echo $user['fullname'] ?>" placeholder="Enter your full name">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $user['email'] ?>" placeholder="Enter your email">
              </div>
              <button type="submit" name="submit" class="btn btn-primary w-100">Update users</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>