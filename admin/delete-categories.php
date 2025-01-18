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


 $id=$_GET['rn'];
 $query = "DELETE FROM createcategories WHERE id='$id'";
 $result = mysqli_query($conn, $query);

 if($result){

         $message = 'categories delete successful';
        $messageType = 'success';
        header("Location: categories.php");
    
 }else{

        $message = 'categories delete fail';
        $messageType = 'danger';
        header("Location: categories.php");
   
 }


  

?>