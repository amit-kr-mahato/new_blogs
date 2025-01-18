<?php
require('../configure.php');
session_start();

 
// if (!isset($_SESSION['id'])) {
//     // Redirect to the login/register page
//     header("Location: ../login.php"); 
// }


$query = "SELECT COUNT(id) AS NumberOfcategory FROM createcategories";
$result = $conn->query($query);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $count = $row['NumberOfcategory'];



    }

}

?>
<?php

$query = "SELECT COUNT(id) AS NumberOfpost FROM posts";
$result = $conn->query($query);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $post = $row['NumberOfpost'];



    }

}


?>


<?php

$query = "SELECT COUNT(id) AS NumberOfUsers FROM users";
$result = $conn->query($query);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $user = $row['NumberOfUsers'];



    }

}


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Admin</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background-color: rgb(3, 68, 68);">

    <div class="container mt-5 ">
        <div class="row">
            <div class="col-lg-3">
                <?php
                include 'layouts/sidebar.php';
                ?>
                <div class="col-lg-9">
                    <h2 class="text-light">Dashboard</h2>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card bg-primary">
                                <div class="card-body text-light">
                                    <h4>Posts</h4>
                                    <p class="mb-0"><?php echo $post ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning">
                                <div class="card-body">
                                    <h4>Category</h4>
                                    <p class="mb-0"><?php echo $count ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success">
                                <div class="card-body">
                                    <h4>Comments</h4>
                                    <p class="mb-0">Comments</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-5">
                            <div class="card bg-warning">
                                <div class="card-body">
                                    <h4>users</h4>
                                    <p class="mb-0"><?php echo $user ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>