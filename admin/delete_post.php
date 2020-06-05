<?php include "includes/connection.php"; ?>

<?php
   
$message ='';
 
if(isset($_GET['did'])){
           $dbid = $_GET['did'];    
            $sql = "DELETE FROM products WHERE id = '$dbid' ";
            $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$image_delete = "../assets/posts/".$image;
    if(file_exists($image_delete)){
        unlink($image_delete);
    }			
			 if($query){ 
                $message .='<h4 class="alert alert-success">Post Deleted Successfully</h4>'; 
				 header("Referesh:1,url=posts.php");
} 
} 
  
 ?>
 