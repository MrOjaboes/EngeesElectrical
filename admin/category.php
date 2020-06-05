
<?php include "includes/connection.php"; ?>
<?php
$message ='';
if(isset($_POST["add"])){
    $caption = htmlspecialchars(trim($_POST["caption"]));
    
    if(!empty($caption)){
        
            //INSERT TO DATABASE
            $sql = "INSERT INTO category(name, author) VALUES('$caption','Admin')";
            $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            if($query){
                $message .='<p class="alert alert-success">Category successfully uploaded</p>';
           
            }
             
        
         
    }
}

                    
?>

<?php include "includes/header.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Client Page
                <small>Add Clents</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#" class="active">Clients</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php echo $message ?>

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
                    
                    <form method="post" action="" enctype="multipart/form-data" class="col-md-8">
                        <div class="form-group">
						<label>Category Type</label>
                            <input type="text" class="form-control" placeholder="Name" name="caption" required>
                        </div>
                         
						</br>
						</br>
						</br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-block btn-primary" name="add" value="Add New Category">
                             
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
