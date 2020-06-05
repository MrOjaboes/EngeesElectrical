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
				 
			 
                <div><?php echo SuccessMessage() ;?></div>
            <h2 class="text-center">Un-Approved Comments</h2>
			<div style="overflow-y:scroll;height:350px;" class="table-responsive">
            <table class="table table-hover table-stripped">
                <tr>
                <th>S/N</th>
                <th>Commentor's Name</th>
                <th>Commentor's Email</th>
				<th>Comments</th>				 			 
				<th>Date Posted</th>
				<th colspan="4"> </th>
                </tr>
				 
                <?php
				$sn = 1;
                  $sql2="SELECT * FROM comments WHERE status='OFF' ORDER BY id DESC";
                $query = mysqli_query($connect, $sql2);
                while($row = mysqli_fetch_array($query)){
                    $id = $row['id'];
                    $post = $row['post'];
                    $name = $row['name'];                    
                    $date = $row['date_posted'];
                    $email = $row['email'];
                    $cdate = new DateTime($date);   				  
                    $mydate = $cdate->format('l, j F Y');
                                   
            
                     
                    ?>
					
                    <tr>
                        <td><?php echo $sn ?></td>
                        <td><?php echo $name;  ?></td>                         
                        <td><?php echo $email;  ?></td>    
                        <td><?php echo $post;  ?></td>                                           
                        <td><?php echo $mydate ?></td>

                        <td>
						<a href="approve_comment.php?aid=<?php echo $id ?>"> <button class="btn btn-warning"><i class="fa fa-comment"></i> </button></a>
                        <a href="comment_details.php?id=<?php echo $id ?>"><button class="btn btn-info"><i class="fa fa-file"></i> </button></a>
                         <a href="delete_comment.php?did=<?php echo $id ?>"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>
						</td>
                    </tr>
                <?php  
				$sn++;
				}
				?>



            </table>

        </div>


        <hr>
        <h2 class="text-center">Approved Comments</h2>
        <div style="overflow-y:scroll;height:350px;" class="table-responsive">
            <table class="table table-hover table-stripped">
                <tr>
                <th>S/N</th>
                <th>Commentor's Name</th>
                <th>Approved By</th>				 				 			 
				<th>Date Approved</th>
				<th colspan="4"> </th>
                </tr>
				 
                <?php
				$sn = 1;
                  $sql2="SELECT * FROM comments WHERE status='ON' ORDER BY id DESC";
                $query = mysqli_query($connect, $sql2);
                while($row = mysqli_fetch_array($query)){
                    $id = $row['id'];
                    $post = $row['post'];
                    $name = $row['name'];                    
                    $date = $row['date_posted'];
                    $email = $row['email'];
                    $cdate = new DateTime($date);   				  
                    $mydate = $cdate->format('l, j F Y');
                                   
            
                     
                    ?>
					
                    <tr>
                        <td><?php echo $sn ?></td>
                        <td><?php echo $name;  ?></td>                         
                        <td><?php echo $email;  ?></td>    
                        <td><?php echo $post;  ?></td>                                           
                        <td><?php echo $mydate ?></td>

                        <td>
						<a href="UnApprove_comment.php?uaid=<?php echo $id ?>"> <button class="btn btn-success"><i class="fa fa-pencil"></i> </button></a>
                        <a href="comment_details.php?id=<?php echo $id ?>"><button class="btn btn-info"><i class="fa fa-file"></i> </button></a>
                         <a href="delete_comment.php?did=<?php echo $id ?>"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>
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
