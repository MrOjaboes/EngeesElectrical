<?php
include "includes/connection.php";
include "includes/header.php";
?>
 
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
	 $sql = "SELECT * FROM slides WHERE  caption LIKE '%$search%'";
	 $query = mysqli_query($connect,$sql)or die(mysqli_error($connect));
	 $foundno = mysqli_num_rows($query);
	 if($foundno > 0){
		 ?>
		 <div class="table-responsive" style="overflow-x:scroll;width:auto;">
				<table class="table table stripped">				 
				<tr>
				<th>S/N</th>
				<th>NAME</th>
				<th>PHOTO</th>
				<th>DESCRIPTION</th>				 			 
				<th>DATE ADDED</th>
				<th>DATE MODIFIED</th>
				</tr>
		 
		 <?php		 
		 		 
		//echo 'Number of result(s) found!  '.$foundno;
		 		$sn = 1;
            while($row = mysqli_fetch_assoc($query)){
				  $id = $row['id'];
        $image = $row['image'];
        $name = $row['caption'];
        $description = $row['description'];
        $date = $row['date_added'];
        $date_modified = $row['date_updated'];
 
			
			     echo '
				<tr class="active">				 
				<td>'.$sn .'</td>
				<td>'.$name .'</td>
				<td><a href="../assets/images/slider/'.$image .'"><img src="../assets/images/slider/'.$image .'" height="100" width="100" class="img-thumbnail img-responsive"/></a></td>
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
           <div class="panel-heading"> <h2 class="text-info text-center">Manage Uploaded Sliders</h2></div>
								<div style="float:center;">
			<form action="" method="POST" class="sidebar-form form-static">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Search Client...">
              <span class="input-group-btn">
                <button type="submit" name="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
			</div>
			</div>
					
             <div style="overflow-y:scroll;height:200px;" class="table-responsive">             
            <table class="table table-hover">

                <tr class="active">
                    <th>S/N</th>                     
                    <th>Caption</th>                    
                    <th>Date Added</th>
                    <th colspan="3"></th>
                </tr>
                <?php
                 $sn = 1;
                $sql = "SELECT * FROM slides ORDER BY id DESC ";
                $query = mysqli_query($connect, $sql);
                while($row = mysqli_fetch_array($query)){
                    $id = $row['id'];                     
                    $caption = $row['caption'];
                    $date = $row['date_added'];
                    $image = $row['image'];
                    $cdate = new DateTime($date);
                    $newdate = $cdate-> format('l, j F Y');

                    ?>
                    <tr class="active">
                        <td><?php echo $sn; ?></td>
						<td><?php echo $caption ?></td>
                      <td><a href="<?php echo'../assets/images/slider/'.$image;?>"><img src="<?php echo'../assets/images/slider/'.$image;?>" height="100" width="100" class="img-thumbnail img-responsive"/></a></td>				
                        <td><?php echo $newdate ?></td>                 
  
                        <td>
						<a href="update_slider.php?uid=<?php echo $id; ?>"><button class="btn btn-success">Update </button></a>                
						<a href="slider_details.php?sid=<?php echo $id; ?>"><button class="btn btn-info">Details </button></a>                        
						<a href="delete_slider.php?did=<?php echo $id; ?>"> <button name="delete" class="btn btn-danger">Delete </button></a>
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
