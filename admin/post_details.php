<?php include "includes/connection.php"; ?>
                <?php
			  if(isset($_GET['id'])){
			$id = $_GET['id'];
			$sql2 = " SELECT * FROM products WHERE id ='$id' LIMIT 1 ";
			$query = mysqli_query($connect, $sql2) or die(mysqli_error($connect));
			while($row = mysqli_fetch_array($query)){		
				$dbid = $row['id'];
                $author = $row['author'];
                $category = $row['category'];
                $post = $row['post'];
				$title = $row['title'];
				$image = $row['image'];
				$date = $row['date'];
                //$date_modified = $row['DateModified'];
                $cdate = new DateTime($date); //strtotime('l j F Y'; $date);
                $mydate = $cdate->format('l, j F Y');
       
				 
    }	
    
}
                    //$cdate = strtotime('l j F Y'; $date);
                    //date('l j F Y');
                    ?>


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
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button> 
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-6">
                    <div><a href="<?php echo'../assets/posts/'.$image;?>" target="_blank"><img src="<?php echo'../assets/posts/'.$image;?>"  class="img-rounded img-responsive"/></a></div>				
                      
                    </div>
                    <div class="col-md-6"> 
                     <div style="overflow-y:scroll;height:350px;" class="table-responsive">
             
            <table class="table table-hover">

                <tr>
                <td><label for="">Post Title</label></td>
                <td><?php echo $title;?></td>
                </tr>  
                
                <tr>
                <td><label for="">Post Category</label></td>
                <td><?php echo $category;?></td>
                </tr>  

                <tr>
                <td><label for="">Posted By </label></td>
                <td><?php echo $author;?></td>
                </tr> 

                <tr>
                <td><label for="">Posted On</label></td>
                <td><?php echo $mydate;?></td>
                </tr>  
  
 
 
            </table>

        </div>
        </div>
        
        </div>
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10"><p class="lead"><?php echo htmlentities($post);?></p></div>
        <div class="col-md-1"></div>
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
