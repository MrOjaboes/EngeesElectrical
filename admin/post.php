<?php session_start();?>

<?php include "includes/connection.php"; ?>

<?php 
if(!isset($_SESSION['email'])){ 
	header('location : ./admin.php');
}else{ 
  ?>


<?php
    $message ='';
	if(isset($_POST["upload"])){
		$title = htmlspecialchars(trim($_POST["title"]));
        $post = htmlspecialchars(trim($_POST["post"]));
        $category = htmlspecialchars(trim($_POST["category"]));
        
		$image = $_FILES["image"];
		if(!empty($title) || !empty($post) || !empty($category) ){
			$image_name = $image["name"];
			//move image to Server
			$move = move_uploaded_file($image["tmp_name"], "../assets/posts/".$image_name);
			if($move){
				   
				// $name = $_SESSION['Name'];

				  $activity = 'Added a new post....';
				$sql = "INSERT INTO activities(user_id,content) VALUES('Admin', '$activity')";
				$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
                 
				//INSERT TO DATABASE
				$sql = "INSERT INTO products(title,category,image,author,post) VALUES('$title','$category','$image_name','Admin','$post')";
                $query1 = mysqli_query($connect, $sql) or die(mysqli_error($connect));
                if($query1){
                    $message .='<p class="alert alert-success">Post successfully uploaded</p>';
				
                }
				 
			}
			else{
				echo $image["error"];
				$message .= "Error with image upload";
			}
		}
	}
                    ?>
					
					
                    <?php include "includes/header.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
			 
                <div class="box-header with-border">
				
                    <h3 class="box-title"><?php echo $message; ?></h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8"> 
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                        <label>Post Title</label>
                            <input type="text" class="form-control" placeholder="Post Title" name="title" required>
                        </div>
 
                        <div class="form-group">
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
                            <textarea cols="20" rows="10" class="form-control" required placeholder="Product Description" name="post" required></textarea>
                        </div>
						<div id="image_display"></div>
                        <div>						
                            <label>Upload Post Image: </label><input type="file" class="box-body" name="image" id="images" required>
                        </div>
															
                        <div class="form-group">

                            <button type="submit" class="btn btn-block btn-success" name="upload" >Add New Post</button>

                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
                </div>

				
		
                <!-- /.box-body -->
                <div class="box-footer">
                    
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
         
    </div>
    <!-- /.content-wrapper -->

<?php require_once "includes/footer.php";?>
                <?php }?>