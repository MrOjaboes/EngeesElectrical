
<?php
$message = "<h2></h2>";
$connect = mysqli_connect('localhost', 'root', '', 'pml');
if(isset($_GET['uid'])){
    $projectID = $_GET['uid'];
       $sql = "SELECT * FROM client WHERE id='$projectID' ";
    $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    while($row = mysqli_fetch_array($query)){
        $id = $row['User_id'];
        $dbimage = $row['Image'];
        $uname = $row['Username'];
           $_SESSION['Image'] = $dbimage;
           $_SESSION['Username'] = $uname;
    }
}


if(isset($_POST['submit'])){
     
    $newimage = $_FILES["newimage"];

    if(!empty($newimage) ){
        $image_name = $newimage["name"];
        //move image to Server	 
		$move = move_uploaded_file($newimage["tmp_name"], "../assets/images/users/".$image_name);
          $image_url = $uname.'/'. $image_name;
		        
			 if($newimage != null){
				 $image = $dbimage;
			}else{
				$newimage = $image_name;
			}
             
            // edit the database and send them back to the server
            $sql = "UPDATE users SET Image='$image_name' WHERE User_id='$id' ";
            $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));             
            if($query){
		 header("location:profile.php");
			 }
        } 
    } 

?>

 
<?php include "includes/header.php";?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Profile page
                <small>Update Profile</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="profile.php" class="active">Profile</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Profile Photo</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-info" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                         <button type="button" class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div><?php echo $message ?></div>
                    <form method="post" action="" enctype="multipart/form-data" class="col-md-8">

                         
							<div id="image_display"></div>
						 
						  <div class="form-group">
						 <label>Upload Photo</label>  
						   <input type="file" id="images" name="newimage" value="<?php echo $_SESSION['Image']; ?>"  />
						  </div>
						</br>
						</br>
						</br>
                        <div class="form-group">                             
                            <button type="submit" class="btn btn-success" name="submit">Upload</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
                 
            </div>
            <!-- /.box -->

        </section>

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<?php
include_once "includes/footer.php";
