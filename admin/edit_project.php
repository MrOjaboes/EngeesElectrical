<?php
include "includes/header.php";

?>
<?php
$message = "<h2></h2>";
if(isset($_POST['submit'])){
    $ThisID =  $_GET['pid'];
    $name = mysqli_real_escape_string($connect, $_POST['caption']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $location = mysqli_real_escape_string($connect, $_POST['location']);
    $manager = mysqli_real_escape_string($connect, $_POST['manager']);
    $start = mysqli_real_escape_string($connect, $_POST['startDate']);
    $end = mysqli_real_escape_string($connect, $_POST['endDate']);
    $image = $_FILES["image"];

    if(!empty($name) && !empty($description) ){
        $image_name = $image["name"];
        //move image to Server
        $move = move_uploaded_file($image["tmp_name"], "../assets/images/slider/".$image_name);
        if($move){
            $image_url = "slider/".$image_name;
            // edit the database and send them back to the server
            $sql = "UPDATE project SET name='$name', images='$image_url', description='$description', location='$location', manager='$manager', start_date='$start', end_start='$end' WHERE id='$ThisID' ";
            $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            $message .= "Your Update was successful";

        }else{
            $message .= "Please Upload An Image";
        }
    }else{
        $message .= "Fields Cannot be Empty";
    }
}
?>

<?php

if(isset($_GET['pid'])){
$projectID = $_GET['pid'];
    $sql = "SELECT * FROM project WHERE id='$projectID' ";
    $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    while($row = mysqli_fetch_array($query)){
        $name = $row['name'];
        $description = $row['description'];
        $location = $row['location'];
        $manager = $row['manager'];
        $start = $row['start_date'];
        $end = $row['end_date'];
    }
}

?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Project page
                <small>Add a project</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#" class="active">Project</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add project</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div><?php echo $message ?></div>
                    <form method="post" action="" enctype="multipart/form-data" class="col-md-8">

                        <div class="form-group">
                            <input type="text" class="form-control" name="caption" value="<?php echo $name ?>" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="description" required><?php echo $description ?></textarea>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="location" value="<?php echo $location ?>" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="manager" value="<?php echo $manager ?>" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="startDate" value="<?php echo $start ?>" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="endDate" value="<?php echo $end ?>" required>
                        </div>

                        <div>
                            <label>Upload Slider Image: </label><input type="file" class="form-control" name="image" multiple >
                        </div>
                        <div>
                            <input name="thisID" type="hidden" value="<?php echo $projectID; ?>" />
                            <input type="submit" class="btn btn-primary" name="submit" value="Update">
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    Footer
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<?php
include_once "includes/footer.php";
