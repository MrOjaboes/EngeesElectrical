 
 
<?php include "includes/header.php";?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Search page
                <small>Search User</small>
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
                    <h3 class="box-title">Search Result</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-info" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                         
                    </div>
                </div>
                <div class="box-body"> 
<?php

//$button = $_GET['submit'];

if(!isset($_GET['submit'])){
	echo 'you did not submit a key word';
}else{
 $connect = mysqli_connect('localhost', 'root', '', 'pml');
 $search = mysqli_real_escape_string($connect, $_GET['search']);
	 
	 $sql = "SELECT * FROM users WHERE  Fname LIKE '%$search%' OR Username LIKE '%$search%' OR Email LIKE '%$search%' OR Role LIKE '%$search%'";
	 $query = mysqli_query($connect,$sql)or die(mysqli_error($connect));
	 $foundno = mysqli_num_rows($query);
	 if($foundno >0){
		//echo 'Number of result(s) found!  '.$foundno;
		 		
            while($row = mysqli_fetch_assoc($query)){
				$id = $row['User_id']; 				 
				$name = $row['Fname']; 				 
				$uname = $row['Username']; 				 
				$email = $row['Email'];
				$role = $row['Role'];				 
				$date = $row['DateAdded'];
				$date_modified = $row['DateModified'];
			}
                echo '
				<div style="overflow-x:scroll;width:auto;">
				<table class="table table stripped">				
				<thead>
				<tr>
				<th>S/N</th>
				<th>FULL NAME</th>
				<th>USERNAME</th>
				<th>EMAIL</th>
				<th>ROLE</th>
				<th>DATE ADDED</th>
				<th>DATE MODIFIED</th>
				</tr>
				</thead>
				 
				<tr class="active">				 
				<td>'.$id .'</td>
				<td>'.$name .'</td>
				<td>'.$uname .'<td/> 
				<td>'.$email .'<td/>
				<td>'.$role .'<td/>			
				<td>'.$date .'<td/>			
				<td>'.$date_modified .'<td/>				
				</tr>				 
				</table>
				</div>';			
		
			 
	 }else{echo 'no result(s) found for'.$search;
		 	
			}	
 }
 

?>
</div>
                <!-- /.box-body -->
                 
            </div>
            <!-- /.box -->

        </section>

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<?php include_once "includes/footer.php";?>
