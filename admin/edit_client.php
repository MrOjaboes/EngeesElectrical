
<?php
$message = "<h2></h2>";
$connect = mysqli_connect('localhost', 'root', '', 'pml');
if(isset($_GET['uid'])){
    $projectID = $_GET['uid'];
       $sql = "SELECT * FROM client WHERE id='$projectID' ";
    $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    while($row = mysqli_fetch_array($query)){
        $caption = $row['caption'];
        $dbimage = $row['image'];
        
    }
}


if(isset($_POST['submit'])){
    $ThisID =  $_GET['uid'];
    $caption = mysqli_real_escape_string($connect, $_POST['caption']);
    $newimage = $_FILES["newimage"];

    if(!empty($caption) ){
        $image_name = $newimage["name"];
        //move image to Server
		$image_url = "client/".$image_name;
		$move = move_uploaded_file($newimage["tmp_name"], "../assets/images/client/".$image_name);        
			 if($newimage != null){
				 $image = $dbimage;
			}else{
				$newimage = $image_name;
			}
             
            // edit the database and send them back to the server
            $sql = "UPDATE client SET caption='$caption', image='$image_name' WHERE id='$ThisID' ";
            $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));             
            if($query){
		 header("location:clients.php");
			 }
        } 
    } 

?>

<?php

 

?>
<?php
include "includes/header.php";?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Client page
                <small>Update Client</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#" class="active">Client</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Client</h3>

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

                        <div class="form-group">
                            <input type="text" class="form-control" name="caption" value="<?php echo $caption ?>" >
                        </div> 
						
							<div id="image_display"></div>
						 
						  <div class="form-group">
						 <label>Client Logo</label>  
						   <input type="file" id="images" name="newimage" value="<?php echo $dbimage; ?>"  />
						  </div>
						</br>
						</br>
						</br>
                        <div class="form-group">
                            <input name="thisID" type="hidden" value="<?php echo $projectID; ?>" />
                            <button type="submit" class="btn btn-success" name="submit">Update</button>
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
