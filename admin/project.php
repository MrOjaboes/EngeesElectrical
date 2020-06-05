<?php
include "includes/header.php";

?>
<?php
$message = "";
// Send the product for verification
if(isset($_GET['deletep'])){
    $message .= '<h3>Do You Really Want to Delete This Project With the ID of '. $_GET['deletep'] . ' <a href="http://admin.converseconstructions-ng.com/project.php?deleme='. $_GET['deletep'] .'"> Yes </a> OR <a href="http://admin.converseconstructions-ng.com/project.php"> No </a></h3> ';

}

if(isset($_GET['deleme'])){
    $productID_received = $_GET['deleme'];
    $sql2 = " SELECT * FROM project WHERE id ='$productID_received' LIMIT 1 ";
    $query = mysqli_query($connect, $sql2);
    while($row = mysqli_fetch_array($query)){
        $image_name = $row['images'];
    }

    $sql = "DELETE FROM project WHERE id ='$productID_received' LIMIT 1 ";
    $query2 = mysqli_query($connect, $sql) or die(mysqli_error($connect));

    $image_delete = "../assets/images/slider/".$image_name;
    if(file_exists($image_delete)){
        unlink($image_delete);
    }
    $message .= "Your file was Successfully Deleted";
    header("location: project.php");
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
            <?php echo $message ?>

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
                    <?php

                    //Upload slider image
                    if(isset($_POST["upload"])){
                        $caption = htmlspecialchars(trim($_POST["caption"]));
                        $description = htmlspecialchars(trim($_POST["description"]));
                        $location = htmlspecialchars(trim($_POST["location"]));
                        $manager = htmlspecialchars(trim($_POST["manager"]));
                        $startDate = htmlspecialchars(trim($_POST["startDate"]));
                        $endDate = htmlspecialchars(trim($_POST["endDate"]));
                        $image = $_FILES["image"];
                        if(!empty($caption) && !empty($description) ){
                            $image_name = $image["name"];
                            //move image to Server
                            $move = move_uploaded_file($image["tmp_name"], "../assets/images/slider/".$image_name);
                            if($move){
                                $image_url = "slider/".$image_name;
                                //INSERT TO DATABASE
                                $sql = "INSERT INTO project(name, description, location, manager, start_date, end_date, images) VALUES('$caption', '$description', '$location', '$manager', '$startDate', '$endDate', '$image_url')";
                                $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
                                echo "Image successfully uploaded";
                            }
                            else{
                                echo $image["error"];
                                echo "Error with image upload";
                            }
                        }
                    }
                    ?>
                    <form method="post" action="" enctype="multipart/form-data" class="col-md-8">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Project Name" name="caption" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Project Description" name="description" required></textarea>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Project Location" name="location" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Project Manager" name="manager" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Project Start Date" name="startDate" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Project End Date (Approximate)" name="endDate" required>
                        </div>

                        <div>
                            <label>Upload Slider Image: </label><input type="file" class="form-control" name="image" multiple required>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-primary" name="upload" value="Upload">
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

        <div>
            <h2>Uploaded Projects</h2>
            <table class="table table-hover">

                <tr class="active">
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Manager</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
                <?php

                $sql = "SELECT * FROM project ORDER BY id ASC ";
                $query = mysqli_query($connect, $sql);
                while($row = mysqli_fetch_array($query)){
                    $id = $row['id'];
                    $name = $row['name'];
                    $description = $row['description'];
                    $location = $row['location'];
                    $manager = $row['manager'];
                    $start = $row['start_date'];
                    $end = $row['end_date'];


                ?>
                    <tbody>
                <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $name  ?></td>
                    <td width="300"><?php echo $description ?></td>
                    <td><?php echo $location ?></td>
                    <td><?php echo $manager ?></td>
                    <td><?php echo $start ?></td>
                    <td><?php echo $end ?></td>

                    <td><a href="project.php?deletep=<?php echo $id ?>"><button name="delete" class="btn btn-danger">Delete </button> </a></td>
                    <td><a href="edit_project.php?pid=<?php echo $id ?>"><button name="edit" class="btn btn-info">Edit </button></a></td>
                </tr>
                    <?php } ?>
                    </tbody>



            </table>

        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<?php
include_once "includes/footer.php";
