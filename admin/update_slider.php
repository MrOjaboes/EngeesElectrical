
<?php

$connect = mysqli_connect('localhost', 'root', '', 'pml');
if(isset($_GET['uid'])){
    $id = $_GET['uid'];
    $sql = "SELECT * FROM slider WHERE id='$id' ";
    $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    while($row = mysqli_fetch_array($query)){
          $dbid = $row['id'] ;           
        $dbimage = $row['Image'];
        $caption = $row['Caption'];
        $description = $row['Description'];
    }
}




 
if(isset($_POST['submit'])){       
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $caption = mysqli_real_escape_string($connect, $_POST['caption']);
    $newimage = $_FILES["newimage"];

    if(!empty($description) ){
        $image_name = $newimage["name"];
        //move image to Server
        $move = move_uploaded_file($newimage["tmp_name"], "../assets/images/slider/".$image_name);        
            $image_url = "slider/".$image_name;
			 if($newimage != null){
				 $dbimage = $image_name;
			}else{
				$newimage = $image_name;
			}
            // edit the database and send them back to the server
            $sql = "UPDATE slider SET  image='$image_name', description='$description', caption='$caption'  WHERE id='$dbid' ";
            $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
             if($query){
				 header("location:sliders.php");
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
                Slider page
                <small>Update slider</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="sliders.php" class="active">Sliders</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Slider's Details</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-info" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                         <button type="button" class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">                    
                    <form method="post" action="" enctype="multipart/form-data" class="col-md-8">

                         
                        <div class="form-group">
                            <input type="text" class="form-control" name="caption" value="<?php echo $caption ?>" >
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="description" ><?php echo $description ?></textarea>
                        </div>

                        <div id="image_display"></div>
						 
						  <div class="form-group">
						 <label>Slider Image</label>  
						   <input type="file" id="images" name="newimage"  />
						  </div>
                        <div>
                            
                            <input type="submit" class="btn btn-primary" name="submit" value="Update">
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
                  
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<?php
include_once "includes/footer.php";
