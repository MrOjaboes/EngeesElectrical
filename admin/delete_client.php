<?php
$connect = mysqli_connect('localhost', 'root', '', 'pml');
$message ='Are you sure you want to delete the following client\'s details?';
if(isset($_GET['did'])){
	$id = $_GET['did'];
	$sql2 = " SELECT * FROM client WHERE id ='$id' LIMIT 1 ";
    $query = mysqli_query($connect, $sql2) or die(mysqli_error($connect));
    while($row = mysqli_fetch_array($query)){
		
        $id = $row['id'];
        $image = $row['image'];
        $name = $row['caption'];
        $date = $row['DateAdded'];
        $date_modified = $row['DateModified'];
 
		 
    }	
    
}

if(isset($_POST['delete'])){
           $dbid = $id;    
            $sql = "DELETE FROM client WHERE id = '$dbid' ";
            $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$image_delete = "../assets/images/client/".$image;
    if(file_exists($image_delete)){
        unlink($image_delete);
    }			
			 if($query){
				 header("location:clients.php");
} 
} 
  
 ?>


<?php require_once "includes/header.php";?> 
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           
            <h1>
                Client Uploaded page
                <small> Client's Details </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="clients.php" class="active">Clients</a></li>
            </ol>
        </section>

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
                    <h4 class="text-center"><b class="alert alert-danger"><?php echo $message;?></b></h4>
                     <div style="overflow-y:scroll;height:350px;" class="table-response">
            <h2 class="text-info text-center">Manage Client's Details</h2>
            <table class="table table-hover">

                <tr class="active">
                    <th>S/N</th>                                       
                    <th>Caption</th>                     
                    <th>Image</th>                     
                    <th>Date Added</th>
                    <th>Date Modified</th>
                    <th colspan="3"> </th>
                </tr>

                    <tr class="active">
					
                        <td><?php echo $id; ?></td>                         
                        <td><?php echo $name;  ?></td>
                        <td><a href="<?php echo '../assets/images/client/'.$image; ?>"><img src="<?php echo '../assets/images/client/'.$image; ?>"  height="100" width="100" class="img-thumbnail img-responsive" ></a></td>
                        <td><?php echo $date ?></td> 
                        <td><?php echo $date_modified ?></td> 

                        <td>
						<a href="edit_client.php?uid=<?php echo $id ?>"> <button class="btn btn-success">Update </button></a>
                        <a href="delete_client.php?did=<?php echo $id ?>"><button class="btn btn-danger">Delete </button></a>
						</td>                        
                    </tr>
 
            </table>
                <div class="col-md-4 col-sm-4 col-xs-4"></div>
			<div class="col-md-4 col-sm-4 col-xs-4">
			<form action="" method="POST">
			<div class="form-group">
			 		<button class="btn btn-danger" type="submit" name="delete">YES </button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <a href="clients.php" class="btn btn-info">NO</a>
						 </div>
						 </form>
						 </div>
						 <div class="col-md-4 col-sm-4 col-xs-4"></div>
        </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
        
    </div>
    <!-- /.content-wrapper -->

<?php require_once "includes/footer.php";?>
