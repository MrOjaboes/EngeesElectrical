<?php
include "includes/header.php";
$connect = mysqli_connect('localhost', 'root', '', 'pml');
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                About Us
                <small>Content</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#" class="active">About Us</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">About Us</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                       <button type="button" class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <?php
                    $sql = "SELECT * FROM about_us";
                    $query = mysqli_query($connect, $sql) or die(mysqli_error($conect));
                    $row = mysqli_fetch_array($query);
                    $content = $row["content"];
                    $mission = $row['mission'];
                    $vision = $row['vision'];

                    //Update About Us
                    if(isset($_POST["update"])){
                        $content = htmlspecialchars(trim($_POST["content"]));
                        $mission = htmlspecialchars(trim($_POST["mission"]));
                        $vision = htmlspecialchars(trim($_POST["vision"]));                         
                        if(!empty($content) && !empty($mission) && !empty($vision)){
                            
                                $sql = "UPDATE about_us SET content='$content', mission='$mission', vision='$vision'";
                                $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
                                echo '<p class="alert-success">About us content was successfully updated</p>';
								header('Referesh:1; url=index.php');
                            }else{
                                echo '<h3 class="alert-danger">Could not move your file to the database</h3>';
                            }

                        } 
                    
                    ?>
					<div class="container">
					<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8"> 
                    <form method="post" action=""  enctype="multipart/form-data">
                        <div>
                            <label>Content</label>
                            <textarea name="content" class="form-control" col="10" rows="5" ><?php echo $content; ?></textarea>
                        </div>
                        <div>
                            <label>Mission</label>
                            <textarea name="mission" col="10" rows="5" class="form-control"><?php echo $mission; ?></textarea>
                        </div>
                        <div>
                            <label>Vision</label>
                            <textarea name="vision" col="10" rows="5" class="form-control"><?php echo $vision; ?></textarea>
                        </div>
                         </br>
                         </br>
                         </br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update" value="Update">
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <p style="float:right;">Footer</p>
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
