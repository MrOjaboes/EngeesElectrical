<?php include "includes/connection.php"; 

include("includes/functions.php");
confirm_Login();
?>
 



 <?php
 $message = '';
if(isset($_POST['update'])){       
    $newpost = mysqli_real_escape_string($connect, $_POST['post']);
    $newtitle = mysqli_real_escape_string($connect, $_POST['title']);
    $newcategory = mysqli_real_escape_string($connect, $_POST['category']);
    $newimage = $_FILES["newimage"];
    $newauthor = 'Admin';
    if(!empty($newpost) || !empty($newtitle) || !empty($newcategory) ){
          //move image to Server
          
                $image_name = $newimage["name"];		
                $move = move_uploaded_file($newimage["tmp_name"], "../assets/posts/".$image_name);
        if($move){
            $dbid =$_GET['uid'];
            // edit the database and send them back to the server
            $sql = "UPDATE products SET post='$newpost', title='$newtitle', image='$image_name', category='$newcategory', author='$newauthor' WHERE id='$dbid' ";
            $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
             if($query){
                 $message .='<h6 class="alert alert-success">Post Updated Successfully!</h6>';
				 header("Refresh:1, url=posts.php");
			 }
        }
           
    
	}	
}
?>
 <?php include "includes/header.php";?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Post's Details</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                         <button type="button" class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                <div class="row">
                    <div><?php echo $message;?></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-8"> 
                           
<?php 
if(isset($_GET['uid'])){
    $id = $_GET['uid'];
    $sql = "SELECT * FROM products WHERE id='$id' ";
    $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    while($row = mysqli_fetch_array($query)){
          $dbid = $row['id'] ;           
        $dbimage = $row['image'];
        $title = $row['title'];
        $description = $row['post'];
        $category = $row['category'];
    }
}
?>

                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                        <label>Post Title</label>
                            <input type="text" class="form-control" value="<?php echo $title;?>" name="title" required>
                        </div>
 
                        <div class="form-group">
                        <label>Existing Category</label>: <?php echo $category;?><br>
                        <label>Post Category</label>
                            <select name="category" class="form-control" required>
                            <?php
                     $sn = 1;
                $sql = "SELECT * FROM category ORDER BY id DESC ";
                $query = mysqli_query($connect, $sql);
                while($row = mysqli_fetch_array($query)){
                 $caption = $row['name'];                

                ?>
                               <option><?Php echo $caption;?></option>
                <?php }?>
                            </select>
                               </div>

                        <div class="form-group">
                        <label>Post Description</label>
                            <textarea cols="10" rows="10" class="form-control" required name="post" required><?php echo $description;?></textarea>
                        </div>
						<div id="image_display"></div>
                        <div class="form-group">						
                            <label>Existing Image: </label><img src="<?php echo'../assets/posts/'.$dbimage;?>" height="100" width="100" class="img-rounded img-responsive"/>				
                      <br>
                            <label>New Image</label>
                            <input type="file" name="newimage" id="images">
                        </div>
															
                        <div class="form-group">

                            <button type="submit" class="btn btn-block btn-success" name="update" >Update Post</button>

                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
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
include_once "includes/footer.php";
