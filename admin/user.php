<?php 
include("includes/connection.php");
include("includes/session.php");
?>

<?php
    
	if(isset($_POST["upload"])){
		$fname = htmlspecialchars(trim($_POST["fname"]));
        $uname = htmlspecialchars(trim($_POST["uname"]));
        $email = htmlspecialchars(trim($_POST["email"]));
        $role = htmlspecialchars(trim($_POST["role"]));
        $password = htmlspecialchars(trim($_POST["password"]));
        $cpassword = htmlspecialchars(trim($_POST["cpassword"]));      
        $image = $_FILES["image"];
        
		if(!empty($fname) || !empty($uname) || !empty($email) || !empty($role) || !empty($password) || !empty($cpassword) || !empty($image) ){
			$image_name = $image["name"];
			//move image to Server
			$move = move_uploaded_file($image["tmp_name"], "./assets/users/".$image_name);
			if($move){
                $emailVal= "SELECT * FROM users WHERE email ='$email'";
                $emailquery = mysqli_query($connect, $emailVal) or die(mysqli_error($connect));
                $count = mysqli_num_rows($emailquery);
                if($count > 0){
                    $_SESSION['ErrorMesssage'] = "Email already taken";
                    header("Referesh:1, url=user.php");
                }
                
				 if(strlen($password) < 4){
                     $_SESSION['ErrorMesssage'] = "Passsword Strength is weak";
                     header("Referesh:1, url=user.php");
                    }
                  
                  if($password == $cpassword){
                    $activity = 'Added a new post....';
                    $sql = "INSERT INTO activities(user_id,content) VALUES('Admin', '$activity')";
                    $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
                     $encpassword = md5($password);
                    //INSERT TO DATABASE
                    $sql = "INSERT INTO users(fname,username,email,role,image,password) 
                    VALUES('$fname','$uname','$email','$role','$image_name','$encpassword')";
                    $query1 = mysqli_query($connect, $sql) or die(mysqli_error($connect));
                    if($query1){
                        $_SESSION['SuccessMessage'] ='User successfully Created';
                        header("Refresh:1, url=users.php");
                    }
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
				
                    <h3 class="box-title"><?php 
                    echo message(); 
                    echo SuccessMessage();
                    ?></h3>

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
                        <label>Full Name</label>
                            <input type="text" class="form-control" placeholder="Full name..." name="fname" required>
                        </div>

                        <div class="form-group">
                        <label>User Name</label>
                            <input type="text" class="form-control" placeholder="Username" name="uname" required>
                        </div>

                        <div class="form-group">
                        <label>User Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
 
                        <div class="form-group">
                        <label>User's Role  </label>
                            <select name="role" class="form-control" required>
                             
                               <option>Admin</option>
                               <option>Staff</option>
              
                            </select>
                               </div>

                         
						<div id="image_display"></div>
                        <div>						
                            <label>Upload Profile Photo: </label><input type="file" class="box-body" name="image" id="images" required>
                        </div>
                            
                        
                        <div class="form-group">
                        <label>Password</label>
                            <input type="password" class="form-control" placeholder="Email" name="password" required>
                        </div>

                        <div class="form-group">
                        <label>Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" required>
                        </div>


                        <div class="form-group">

                            <button type="submit" class="btn btn-block btn-success" name="upload" >Add New Admin</button>

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
