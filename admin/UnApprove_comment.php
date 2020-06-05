<?php 
include("includes/connection.php");
include("includes/session.php");
?>


<?php
$message = '';
if(isset($_GET['uaid'])){       
    $idFromUrl = $_GET['uaid'];

           // edit the database and send them back to the server
           $sql = "UPDATE comments SET status='OFF' WHERE id='$idFromUrl'";
           $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            if($query){
               $_SESSION['SuccessMessage'] ='Comment Approved Successfully!';
                header("Refresh:1, url=comments.php");
            }
      
   
   	
}

?>