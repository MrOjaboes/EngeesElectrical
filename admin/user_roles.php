
<?php include "includes/connection.php"; ?>
<?php
$message ='';
if(isset($_POST["add"])){
    $caption = htmlspecialchars(trim($_POST["role"]));
    $type = htmlspecialchars(trim($_POST["type"]));
    
    if(!empty($caption) || !empty($type) ){
        
            //INSERT TO DATABASE
            $sql = "INSERT INTO roles(name, type) VALUES('$caption','$type')";
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
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6"> 
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
						<label>Role Name</label>
                            <input type="text" class="form-control" placeholder="Role Type" name="name" required>
                        </div>
                         
                        <label>Privillege</label>
                           <select class="form-control" name="privillege">
                               <option value="">CRUD</option>
                               <option value="">CREATE</option>
                           </select>       
                        </div>
                         
						 
						</br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-block btn-primary" name="add" value="Add New Role">
                             
                        </div>
                    </form>
</div>
<div class="col-md-3"></div>
</div>
 
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
include_once "includes/footer.php";?>
