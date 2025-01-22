<?php
require('../configure.php');
session_start();

$message = '';
$messageType = '';

// Check for session messages
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $messageType = $_SESSION['messageType'];
    unset($_SESSION['message'], $_SESSION['messageType']);
}

// Handle form submission
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $categories = $_POST['category'];
    $status = $_POST['status'];
    $image = $_FILES["image"];

    // Validate form fields
    if (empty($title) || empty($description) || empty($categories) || empty($status) || empty($image['name'])) {
        $message = 'Please fill in all fields.';
        $messageType = 'danger';
    } else {
        // Handle image upload
        $imageName = time() . "_" . basename($image['name']);
        $upload_folder_path = "images/post/";
        $target_file =  $upload_folder_path . $imageName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($image['tmp_name'], $target_file)) {
            // Prepare SQL statement
            $sqli = "INSERT INTO posts (title, image, description, category_id, status) VALUES ('$title', '$imageName','$description' ,'$categories','$status')";
            $result = mysqli_query($conn, $sqli);

            // Execute the statement
            if ($result) {
                $_SESSION['message'] = "<h5 class='text-center'>Post added successfully</h5>";
                $_SESSION['messageType'] = "success";
                header("Location: create-post.php");
                exit;
            } else {
                $message = "Error: ";
                $messageType = "danger";
            }
        } else {
            $message = "Error uploading image.";
            $messageType = "danger";
        }
    }
}

// Fetch categories for the dropdown
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

    <div class="container my-4">
        <div class="row">
            <div class="col-lg-3">
                <?php include 'layouts/sidebar.php'; ?>
          
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
                                    <input type="text" class="form-control" name="title" placeholder="Enter Post Title" required>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mt-3">
                                        <label class="form-label">Post Image
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="file" class="form-control" name="image" required>
                                    </div>
                                    <div class="form-group col-md-6 mt-3">
                                        <label class="form-label">Category
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select" name="category" aria-label="Default select example" required>
                                            <option value="" disabled selected>Select Category</option>
                                            <?php if ($total != 0) {
                                                while ($data = mysqli_fetch_assoc($result)) {
                                                    echo "<option value='" . $data['id'] . "'>" . $data['title'] . "</option>";
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Post Details
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" name="description" rows="10" placeholder="Enter Post details" required></textarea>
                                </div>
                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label">Status
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="status" aria-label="Default select example" required>
                                        <option value="" disabled selected>Select status</option>
                                        <option value="1">Publish</option>
                                        <option value="0">Draft</option>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>