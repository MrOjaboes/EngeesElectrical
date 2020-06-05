<?php include "includes/connection.php"; ?>
<?php
                    $message ='';
                    //Upload slider image
                    if(isset($_POST["upload"])){
                        $caption = htmlspecialchars(trim($_POST["caption"]));                         
                        $description = htmlspecialchars(trim($_POST["description"]));
                        $image = $_FILES["image"];
                        if(!empty($caption) && !empty($description) ){
                            $image_name = $image["name"];
                            //move image to Server
                            $move = move_uploaded_file($image["tmp_name"], "../assets/images/slider/".$image_name);
                            if($move){
                                	 //$id = $_SESSION['User_id'];  
					 $activity = 'Has just Added a news Slider Image....';
					 $sql1 = "INSERT INTO activities(user_id, content) VALUES('Admin', '$activity')";
				     $query = mysqli_query($connect, $sql1) or die(mysqli_error($connect));
                                //INSERT TO DATABASE
                                $sql = "INSERT INTO slides(caption, description, image, user_id) VALUES('$caption','$description', '$image_name', 'Admin')";
                                $query1 = mysqli_query($connect, $sql) or die(mysqli_error($connect));
                                if($query1){
                                    $message .= '<h4 class="alert alert-success">Slide successfully uploaded</h4>';
                           header('Referesh:1, url=slides.php');
                                }
                                }
                            else{
                                echo $image["error"];
                                $message .="Error with image upload";
                            }
                        }
                    }
                    ?>



 <?php  include "includes/header.php"; ?>
 
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                     
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                <div class="row">
                <?php echo $message;?>
                <div class="col-md-2"></div>
                <div class="col-md-8"> 
                   
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                        <label for="description">Slide Caption</label>
                            <input type="text" class="form-control" placeholder="Slide Caption" name="caption" required>
                        </div>
                        <div class="form-group">
                        <label for="description">Slide Description</label>
                            <textarea cols="20" rows="10" class="form-control" placeholder="Slide Description" name="description" required></textarea>
                        </div>
                        <div id="image_display"></div>
                        <div>						
                            <label>Upload Slider's Image: </label><input type="file"  name="image" id="images" required>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-block btn-success" name="upload" value="Add New Slide">

                        </div>
                    </form>
                    </div>
                    <div class="col-md-2"></div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
         
    </div>
    <!-- /.content-wrapper -->


<?php
include_once "includes/footer.php";?>
