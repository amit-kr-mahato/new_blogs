<?php
require "../configure.php";
session_start();
$message = '';
$messageType = '';

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $messageType = $_SESSION['messageType'];
    //unset($_SESSION['message'], $_SESSION['messageType']);
}

$rn=$_GET['rn'];
$query =" DELETE FROM posts WHERE id='$rn'";
$result = mysqli_query($conn, $query);
if($result){
    $message="delete successfully";
    $messageType="success";
    header("Location: index-post.php");
}else{
    $message="delete unsuccessfully";
    $messageType="danger";
    header("Location: index-post.php");
}

?>