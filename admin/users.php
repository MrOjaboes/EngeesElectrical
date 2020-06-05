<?php include "includes/connection.php"; ?>
<?php include "includes/session.php"; ?>


<?php require_once "includes/header.php";?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">		
			
                <div class="box-header with-border">			
                    
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

if(isset($_POST['submit'])){ 
  $search = mysqli_real_escape_string($connect, $_POST['search']);
	 
	 $sql = "SELECT * FROM products WHERE  title LIKE '%$search%' OR description LIKE '%$search%'";
	 $query = mysqli_query($connect,$sql)or die(mysqli_error($connect));
	 $foundno = mysqli_num_rows($query);
	 if($foundno > 0){
		 ?>
		 <div class="table-responsive" style="overflow:scroll;height:250px;width:auto;">
				<table class="table table-stripped table-hover">				 
				<tr>
				<th>S/N</th>
                <th>Title</th>
                <th>Caption</th>
				<th>Description</th>				 			 
				<th>Date added</th>
				<th colspan="4"> </th>
				</tr>
		 
		 <?php
		//echo 'Number of result(s) found!  '.$foundno;
		 		$sn = 1;
            while($row = mysqli_fetch_assoc($query)){
				 $id = $row['id'];
                $description = $row['post'];
				$title = $row['title'];
				$image = $row['image'];
				$date = $row['date'];
				//$date_modified = $row['DateModified'];
				
				
				echo '
				<tr class="active">				 
				<td><a href="#">'.$sn .'</a></td>
				<td>'.$title .'</td>
			    <td><a href="../assets/products/'.$image .'"><img src="../assets/products/'.$image .'" height="100" width="100" class="img-thumbnail img-responsive"/></a></td>
				<td>'.$description .'</td> 			     			
				<td>'.$date .'</td>			
				<td>'.$date_modified .'</td>				
				</tr>';
				$sn++;
			}
                	
?>
</table>
				</div>

<?php				
		
			 
	 }else{echo 'no result(s) found for   '.$search;
		 	
			}	
 } 
 

?>
	
			
                 <div class="panel panel-default">    
           <div class="panel-heading"> <h2 class="text-info text-center">Manage Uploaded Users</h2></div>
								<div style="float:center;">
			<form action="" method="POST" class="sidebar-form form-static">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Search Product...">
              <span class="input-group-btn">
                <button type="submit" name="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
			</div>
			</div>
            <div><?php echo SuccessMessage() ;?></div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="user.php" class="btn btn-info btn-lg">New User</a>
			<div style="overflow-y:scroll;height:350px;" class="table-responsive">
            <table class="table table-hover table-stripped">
                <tr>
                <th>S/N</th>
                <th>Names</th>
                <th>Email</th>
				<th>Photo</th>				 			 
				<th>Date added</th>
				<th colspan="4"> </th>
                </tr>
				 
                <?php
				$sn = 1;
                  $sql2="SELECT * FROM users ORDER BY id DESC";
                $query = mysqli_query($connect, $sql2);
                while($row = mysqli_fetch_array($query)){
                    $id = $row['id'];
                    $fname = $row['fname'];
                    $uname = $row['username'];                    
                    $date = $row['date'];
                    $image = $row['image'];
                    $email = $row['email'];
                    $cdate = new DateTime($date);
                    $newdate = $cdate-> format('l, j F Y');
                    ?>
					
                    <tr>
                        <td><?php echo $sn ?></td>
                        <td><?php echo $fname;  ?></td>
                        <td><?php echo $email;  ?></td>
                        <td><a href="<?php echo'./assets/users/'.$image;?>"><img src="<?php echo'./assets/users/'.$image;?>" height="100" width="100" class="img-rounded img-responsive"/></a></td>                                               
                        <td><?php echo $newdate ?></td>

                        <td>
						   <a href="delete_user.php?did=<?php echo $id ?>"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>
						</td>
                    </tr>
                <?php  
				$sn++;
				}
				?>



            </table>

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
