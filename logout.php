<?php session_start()?>   
 <?php
 $connect = mysqli_connect('localhost', 'root', 'mysql', 'cms');
   $id = $_SESSION['user_id'];
 $activity = $_SESSION['email'].' '.'Has just logged out....';
 $sql = "INSERT INTO activities(user_id, content) VALUES('$id', '$activity')";
$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));

 session_destroy();
 $message='<h3>Good Bye </h3>';
 if(@$message){
header("Refresh:1; url=admin.php");
 }
 
 ?>
  