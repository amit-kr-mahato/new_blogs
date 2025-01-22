<?php
require('../configure.php');
session_start();

$id = $_GET['rn'];
$select = "SELECT * FROM createcategories WHERE id='$id'";
$query = mysqli_query($conn, $select);
$row = mysqli_fetch_array($query);


if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $image = $_FILES["image"];

    if ($image['name']) {
        $imageName = time() . "_" . basename($image['name']);
        $upload_folder_path = "images/categories/";
        $target_file =  $upload_folder_path . $imageName;

        if (move_uploaded_file($image['tmp_name'], $target_file)) {
            // Delete old image
            if (file_exists($upload_folder_path . $row['image'])) {
                unlink($upload_folder_path . $row['image']);
            }

            // Update the post
            $queryUpdate = "UPDATE createcategories SET title='$title', image='$imageName' WHERE id='$id'";
            $resultUpdate = mysqli_query($conn, $queryUpdate);

            if ($resultUpdate) {
                $message = "Post updated successfully";
                $messageType = "success";
                header("Location: categories.php");
                exit();
            } else {
                $message = "Error updating post: " . mysqli_error($conn);
                $messageType = "danger";
            }
        } else {
            $message = "Error uploading image.";
            $messageType = "danger";
        }
    } else {
        // If no new image is uploaded, just update other fields
        $queryUpdate = "UPDATE createcategories SET title='$title' WHERE id='$id'";
        $resultUpdate = mysqli_query($conn, $queryUpdate);

        if ($resultUpdate) {
            $message = "Post updated successfully";
            $messageType = "success";
            header("Location: categories.php");
            exit();
        } else {
            $message = "Error updating post: " . mysqli_error($conn);
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
                                        <input type="text" class="form-control" name="title" value="<?php echo $row['title'] ?>" placeholder="Enter categories Title">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 mt-3">
                                            <label class="form-label">categories Image
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="file" class="form-control" name="image" value="<?php echo $row['image'] ?>" placeholder="Enter Post Title">
                                            <img width=200 height=200 src="images/categories/<?php echo $row['image'] ?>" />
                                        </div>

                                    </div>


                                    <div class="mt-3">
                                        <button type="submit" name="submit" class="btn btn-primary">update categories</button>
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