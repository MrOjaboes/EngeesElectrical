<?php include "includes/connection.php"; ?>


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
				<table class="table table stripped">				 
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
           <div class="panel-heading"> <h2 class="text-info text-center">Manage Uploaded Posts</h2></div>
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
			<div><?php echo message ;?></div>
			<div style="overflow-y:scroll;height:350px;" class="table-responsive">
            <table class="table table-hover table-stripped">
                <tr>
                <th>S/N</th>
                <th>Title</th>
                <th>Caption</th>
				<th>Description</th>				 			 
				<th>Date added</th>
                <th>Comments</th>
				<th colspan="4"> </th>
                </tr>
				 
                <?php
				$sn = 1;
                  $sql2="SELECT * FROM products ORDER BY id DESC";
                $query = mysqli_query($connect, $sql2);
                while($row = mysqli_fetch_array($query)){
                    $id = $row['id'];
                    $description = $row['post'];
                    $title = $row['title'];                    
                    $date = $row['date'];
                    $image = $row['image'];
                    $cdate = new DateTime($date);
                    $newdate = $cdate-> format('l, j F Y');
                    ?>
					
                    <tr>
                        <td><?php echo $sn ?></td>
                        <td><?php echo $title;  ?></td>
                        <td><a href="<?php echo'../assets/posts/'.$image;?>"><img src="<?php echo'../assets/posts/'.$image;?>" height="100" width="100" class="img-rounded img-responsive"/></a></td>				
                      
                        <td><?php 
                        if(strlen($description) > 15){$description = substr($description,0,15).'....';}
                        echo $description;  ?></td>                                             
                        <td><?php echo $newdate ?></td>
                        <td>
                         
                        <?php 
		  
                        $UnApproved = " SELECT COUNT(*)  FROM comments WHERE post_id ='$id' AND status='OFF'";	 
                          $QueryUnApproved = mysqli_query($connect, $UnApproved) or die(mysqli_error($connect));
                        $rows = mysqli_fetch_array($QueryUnApproved);
                        $UnApprovedComment = array_shift($rows);
                       if($UnApprovedComment > 0){

                       
                   
                     ?>
                        <span class="label label-warning pull-left"><?php echo $UnApprovedComment;?></span>
                       <?php }?>


                       <?php 
		  
                        $Approved = " SELECT COUNT(*)  FROM comments WHERE post_id ='$id' AND status='ON'";	 
                            $QueryApproved = mysqli_query($connect, $Approved) or die(mysqli_error($connect));
                        $Numrows = mysqli_fetch_array($QueryApproved);
                        $ApprovedComment = array_shift($Numrows);
                        if($ApprovedComment > 0){                        
                    
                    ?>
                        <span class="label label-success pull-right"><?php echo $ApprovedComment;?></span>
                        <?php }?>

                        </td>
                        <td>
						<a href="update_post.php?uid=<?php echo $id ?>"> <button class="btn btn-success"><i class="fa fa-pencil"></i> </button></a>
                        <a href="post_details.php?id=<?php echo $id ?>"><button class="btn btn-info"><i class="fa fa-file"></i> </button></a>
                        <a href="../full_post.php?id=<?php echo $id ?>"target="_blank"><button class="btn btn-secondary"><i class="fa fa-print"></i> </button></a>                       
                        <a href="delete_post.php?did=<?php echo $id ?>"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>
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
