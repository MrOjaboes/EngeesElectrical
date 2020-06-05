<?php 
@session_start();
$connect = mysqli_connect('localhost', 'root', '', 'cms');
	if(isset($_GET['pid'])){
	   $id = $_GET['pid'];				 
		 $sql2="SELECT * FROM users WHERE User_id ='$id' ";
			$query = mysqli_query($connect, $sql2);
			while($row = mysqli_fetch_array($query)){
	 		 $dbid = $row['User_id'];
     $email = $row['Email'];
     $image = $row['Image'];
     $title = $row['Title'];
     $name = $row['Name'];
     $gender = $row['Gender'];
     $fname = $title . $name;
     $role = $row['User_role'];
     $uname = $row['Username'];      
     $dbpassword = $row['Password'];
     $date = $row['DateAdded'];
     $date_modified = $row['DateModified'];
	 $date1 = new DateTime($date); //strtotime('l j F Y'; $date);
     $mydate1 = $date1->format('l, j F Y');
     $date2 = new DateTime($date_modified); //strtotime('l j F Y'; $date);
     $mydate2 = $date2->format('l, j F Y');
      
			}			
			
			if($gender == "male"){
         $uid = $_SESSION['User_id'];
		 $activity = $_SESSION['Title'].' '.$_SESSION['Name'].  'Viewed his Profile....';
		 $sql = "INSERT INTO activities(User_id, Activity) VALUES('$uid', '$activity')";
	     $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	   }else if($gender == "female"){
		   $uid = $_SESSION['User_id'];
		 $activity = $_SESSION['Title'].' '.$_SESSION['Name'].  'Viewed her Profile....';
		 $sql = "INSERT INTO activities(User_id, Activity) VALUES('$uid', '$activity')";
	     $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	   }
	   }

	
?>
 
<?php include('includes/header.php');?>
    <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           
            <h1>
                Profile page
                <small>Users </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="profile.php?pid=<?php echo $_SESSION['User_id'];?>" class="active">Profile</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
<section class="col-lg-2 connectedSortable"></section>
        <!-- Left col -->
        <section class="col-lg-8 connectedSortable">
            <!-- Default box -->
            <div class="box">		
			
                <div class="box-header with-border">				
                    <h3 class="box-title">User's Details</h3>
                    
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                         <button type="button" class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    
<table class="table table-striped ">
 


<tbody  class="">
<tr class="active">
   <tr><td></td><td><a href="<?php echo '../assets/images/'.$image; ?>"><img src="<?php echo'../assets/images/'.$image; ?>"  height="100" width="100" class="img-thumbnail img-responsive" ></a></td><td></td></tr>
    
   <tr>
   <td><strong>Name</strong></td>
   <td><?php echo $fname;?></td>
   </tr>
   <tr>
   <td><strong>User name</strong></td>
   <td><?php echo $uname;?></td>
   </tr>
   <tr>
   <td><strong>Email</strong></td>
   <td><?php echo $email;?></td>
   </tr>
   <tr>
   <td><strong>Gender</strong></td>
   <td><?php echo $gender;?></td>
   </tr>
   <tr>
   <td><strong>Role</strong></td>
   <td><?php echo $role;?></td>
   </tr>
   <tr>
   <td><strong>Enrolled On :</strong></td>
   <td><?php echo $mydate1;?></td>
	</tr>
	<tr>
	<td><strong>Modified On :</strong></td>
    <td><?php echo $mydate2;?></td>
	</tr>
	  
	
	</tr>
	</tbody>
</table> 
 
 </div>
               
                
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
		<section class="col-lg-2 connectedSortable"></section>
        <!-- /.content -->
        
    </div>
    <!-- /.content-wrapper -->

<?php require_once "includes/footer.php";?>
