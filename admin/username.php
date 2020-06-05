
<?php
$message = "<h2></h2>";
$connect = mysqli_connect('localhost', 'root', '', 'pml');
if(isset($_GET['uid'])){
    $id = $_GET['uid'];
    $sql = "SELECT * FROM users WHERE User_id ='$id'";                     
	$query = mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($query)){
		$dbid = $row['User_id']; 
        $uname = $row['Username'];   
		 
    }
}


if(isset($_POST['submit'])){        
    $newname = mysqli_real_escape_string($connect, $_POST['uname']); 
	$dbid = $_GET['uid'];
    if(!empty($newname)){
         
            // edit the database and send them back to the server
            $sql = "UPDATE users SET Username ='$newname' WHERE User_id ='$dbid' ";
            $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));             
            if($query){
				$_SESSION["Username"] = $newname;
		 header("location:profile.php?pid=$dbid");
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
                    <h3 class="box-title">Update Profile</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-info" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                         <button type="button" class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">                     
                    <form method="post" action=""  class="col-md-8">  
						
						<div class="form-group">
						<label>User Name </label>
                            <input type="text" class="form-control" name="uname" value="<?php echo $uname; ?>" >
                        </div>
			 
							 
                        <div class="form-group">                             
                            <button type="submit" class="btn btn-success" name="submit">Change</button>
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
