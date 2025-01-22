<?php
require('../configure.php');
session_start();

// Fetch the post to edit
$id = $_GET['rn'];
$select = "SELECT * FROM posts WHERE id='$id'";
$query = mysqli_query($conn, $select);
$total = mysqli_fetch_array($query);

// Fetch categories
$queryCategories = "SELECT * FROM createcategories";
$resultCategories = mysqli_query($conn, $queryCategories);
$totalCategories = mysqli_num_rows($resultCategories);

// Handle form submission
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $image = $_FILES["image"];

    if ($image['name']) {
        $imageName = time() . "_" . basename($image['name']);
        $upload_folder_path = "images/post/";
        $target_file =  $upload_folder_path . $imageName;

        if (move_uploaded_file($image['tmp_name'], $target_file)) {
            // Delete old image
            if (file_exists($upload_folder_path . $total['image'])) {
                unlink($upload_folder_path . $total['image']);
            }

            // Update the post
            $queryUpdate = "UPDATE posts SET title='$title', image='$imageName', description='$description', status='$status' WHERE id='$id'";
            $resultUpdate = mysqli_query($conn, $queryUpdate);

            if ($resultUpdate) {
                $message = "Post updated successfully";
                $messageType = "success";
                header("Location: index-post.php");
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
        $queryUpdate = "UPDATE posts SET title='$title', description='$description', status='$status' WHERE id='$id'";
        $resultUpdate = mysqli_query($conn, $queryUpdate);

        if ($resultUpdate) {
            $message = "Post updated successfully";
            $messageType = "success";
            header("Location: index-post.php");
            exit();
        } else {
            $message = "Error updating post: " . mysqli_error($conn);
            $messageType = "danger";
        }
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Post - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background-color: aquamarine;">

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-3">
                <?php include 'layouts/sidebar.php'; ?>
            </div>
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Edit Post</h2>
                    <div>
                        <a href="create-post.php" class="btn btn-success">
                            <i class="bi bi-plus"></i> Add New
                        </a>
                        <a href="index-post.php" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i> All Posts
                        </a>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="card">
                        <div class="card-body">
                            <?php if (isset($message)): ?>
                                <div class="alert alert-<?= $messageType; ?>">
                                    <?= $message; ?>
                                </div>
                            <?php endif; ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="form-label">Post Title
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($total['title']); ?>" placeholder="Enter Post Title" required>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 mt-3">
                                        <label class="form-label">Post Image
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="file" class="form-control" name="image" placeholder="Upload Post Image">
                                        <img width=100 height=100 src="images/post/<?php echo htmlspecialchars($total['image']); ?>" />
                                    </div>
                                    <div class="form-group col-md-6 mt-3">
                                        <label class="form-label">Category
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select" name="category" aria-label="Default select example">
                                            <option selected>Select Category</option>
                                            <?php if ($totalCategories != 0) {
                                                while ($data = mysqli_fetch_assoc($resultCategories)) {
                                                    $selected = ($data['id'] == $total['category_id']) ? 'selected' : '';
                                                    echo "<option value='" . $data['id'] . "' $selected>" . $data['title'] . "</option>";
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label">Post Details
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" name="description" rows="10" placeholder="Enter Post details" required><?php echo htmlspecialchars($total['description']); ?></textarea>
                                </div>
                                <div class="mt-3">
                                    <label class="form-label">Status
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="status" aria-label="Default select example" required>
                                        <option selected>Select status</option>
                                        <option value="1" <?= $total['status'] == 1 ? 'selected' : '' ?>>publish</option>
                                        <option value="0" <?= $total['status'] == 0 ? 'selected' : '' ?>>draft</option>
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