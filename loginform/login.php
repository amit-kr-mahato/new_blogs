<?php
session_start();
$_SESSION['username']='amit';
$_SESSION['password']='12345';

if(isset($_POST['login'])){
   $username=$_POST['email']; 
   $password=$_POST['password']; 

   $user=$_SESSION['username'];
   $pass=$_SESSION['password'];

   if($username==$user&&$password==$pass){
    $_SESSION['loginuser']=true;
    header("location:dashboard.php");
   }
   else{
    echo "invalid";
   }
}
/*
include 'configure.php';


session_start();
$message = '';
$messageType = '';

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $messageType = $_SESSION['messageType'];
    unset($_SESSION['message'], $_SESSION['messageType']);
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if (empty($email)) {
        $message = 'Please enter the email';
        $messageType = 'danger';
    } elseif (empty($password)) {
        $message = 'Please enter the password';
        $messageType = 'danger';
    } else {
        $sql = "SELECT * FROM users WHERE email ='$email'";
        $result = mysqli_query($conn, $sql); 

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                header("Location: admin/dashboard.php");
                
            } else {
                $message = 'Invalid password';
                $messageType = 'danger';
            }
        } else {
            $message = 'account not found';
            $messageType = 'danger';
        }
    }
}

$conn->close();*/
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <?php /*if (!empty($message)): ?>
                    <div class="alert alert-<?= $messageType ?>" role="alert">
                        <?= $message ?>
                    </div>
                <?php endif; */?>
                <div class="card">
                    <div class="card-body p-4">
                        <h2>Login</h2>
                        <p>Enter your username and password for login.</p>
                        <form action="#" method="post">
                            <div class="form-group">
                                <label class="form-label" for="email">username 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg" name="email" placeholder="username" required>
                            </div>
                            <div class="form-group mt-4">
                                <label class="form-label" for="password">Password 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary btn-lg w-100 mt-4">Login</button>
                           
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