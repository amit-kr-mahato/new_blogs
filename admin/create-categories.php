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
    $image = $_FILES["image"];
    $upload_folder_path = "images/categories/";
    $imageName = $image['name'];
    $fileExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    $fileNewName = uniqid('', true) . "." . $fileExt;
    $fileDestination = $upload_folder_path . basename($fileNewName);
    move_uploaded_file($image['tmp_name'], $fileDestination);
    // image upload end
    // if (!in_array($fileExt, $allowedExts)) {
    //     $message = "Invalid file type";
    //     $messageType = "danger";
    // } else {
        
    //     $fileNewName = uniqid('', true) . "." . $fileExt;
    //     $fileDestination = $upload_folder_path . basename($fileNewName);
    // }

    if (empty($title)) {
        $message = 'Please enter the title';
        $messageType = 'danger';
    } else {
        $sql = "INSERT INTO createcategories (title, image) VALUES ('$title', '$fileNewName')";

        if ($conn->query($sql) === TRUE) {
            session_start();
            $_SESSION['message'] = "<h5 class='text-center'> add successful </h5>";
            $_SESSION['messageType'] = "success";
            header("Location: categories.php");
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
                        <h2 class="text-light">Create categories</h2>
                        <a href="categories.php" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i> All categories
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
                                        <label class="form-label">categories Title
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter categories Title">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 mt-3">
                                            <label class="form-label">categories Image
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="file" class="form-control" name="image" placeholder="Enter Post Title">
                                        </div>

                                    </div>


                                    <div class="mt-3">
                                        <button type="submit" name="submit" class="btn btn-primary">Save categories</button>
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