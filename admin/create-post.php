<?php
require('../configure.php');
session_start();


$message = '';
$messageType = '';

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $messageType = $_SESSION['messageType'];
    unset($_SESSION['message'], $_SESSION['messageType']);
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
   // $image = $_POST['image'];
    $image = $_FILES["image"];
    $upload_folder_path = "images/posts/";
    $imageName = $image['name'];
    $fileExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    $fileNewName = uniqid('', true) . "." . $fileExt;
    $fileDestination = $upload_folder_path . basename($fileNewName);
    move_uploaded_file($image['tmp_name'], $fileDestination);

    $description = $_POST['description'];
    $categories = $_POST['category'];
    $status = $_POST['status']; 

    if (empty($title) || empty($image) || empty($description)) {
        $message = 'Please enter the all field';
        $messageType = 'danger';
    } else {
        $sql = "INSERT INTO posts (title, image,description,category_id,status) VALUES ('$title', '$fileNewName','$description','$categories','$status')";

        if ($conn->query($sql) === TRUE) {
            session_start();
            $_SESSION['message'] = "<h5 class='text-center'> add successful </h5>";
            $_SESSION['messageType'] = "success";
            header("Location: create-post.php");
            exit;
        } else {
            $message = "Error: " . $conn->error;
            $messageType = "danger";
        }
    }
}
?>




<?php
require('../configure.php');

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

<body style="background-color: #12473d;">

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-3">
                <?php
                include 'layouts/sidebar.php';
                ?>
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="text-light">Create Post</h2>
                        <a href="index-post.php" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i> All Posts
                        </a>
                    </div>
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-<?= $messageType ?>" role="alert">
                            <?= $message ?>
                        </div>
                    <?php endif; ?>
                    <div class="mt-4">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="form-label">Post Title
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter Post Title">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 mt-3">
                                            <label class="form-label">Post Image
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="file" class="form-control" name="image" placeholder="Enter Post Title">
                                        </div>
                                        <div class="form-group col-md-6 mt-3">
                                            <label class="form-label" >Category
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select" name="category" aria-label="Default select example">
                                                <option selected>Select Category</option>
                                                <?php if ($total != 0) {

                                                    while ($data = mysqli_fetch_assoc($result)) {
                                                        echo "
                                                     <option value='" . $data['id'] . "' selected>" . $data['title'] . "</option>
                                                       ";
                                                    }
                                                }

                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label">Post Details
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control" name="description" id="" rows="10" placeholder="Enter Post details "></textarea>
                                    </div>
                                    <div class="form-group col-md-6 mt-3">
                                        <label class="form-label">status
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select" name="status" aria-label="Default select example">
                                            <option selected>Select status</option>
                                            <option value="1">publish</option>
                                            <option value="0">draft</option>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" name="submit" class="btn btn-primary">Save Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>