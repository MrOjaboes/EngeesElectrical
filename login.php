 <?php session_start();?>

<?php

$connect = mysqli_connect('localhost', 'root', '', 'cms');
if(isset($_POST['login'])){
$email = $_POST['email'];
$password = $_POST['password'];
$mdpassword = md5($password); 
         if($email && $mdpassword){
          $sql = "SELECT * FROM users WHERE Email ='$email'";
       $result = mysqli_query($connect,$sql)or die(mysqli_error($connect));
      $numrow = mysqli_num_rows($result);
      if($numrow !=0){
     while($row = mysqli_fetch_array($result)){
     $id = $row['User_id'];
	      $title = $row['Title'];
     $name = $row['Name'];
     $gender = $row['Gender'];
     $fname = $title . $name;
     $image = $row['Image'];
     $dbemail = $row['Email'];
     $name = $row['Name'];
     $title = $row['Title'];      
     $uname = $row['Username'];      
     $role = $row['User_role'];      
     $dbpassword = $row['Password'];
     $date = $row['DateAdded'];
     $date_modified = $row['DateModified'];
     
	 
	  
     $_SESSION['User_id'] = $id;    
     $_SESSION['Title'] = $title;    
     $_SESSION['Image'] = $image;
     $_SESSION['Username'] = $uname; 
     $_SESSION['User_role'] = $role; 
     $_SESSION['Password'] = $dbpassword; 
     $_SESSION['Name'] = $name;      
     $_SESSION['Email'] = $email;
     $_SESSION['DateAdded'] = $date;
     $_SESSION['DateModified'] = $date_modified;

    if($email == $dbemail){
		if(isset($_POST['remember'])){
				 setcookie('Email',$email, time()*60*60*7);
			 }
             if($mdpassword == $dbpassword){
				 if($role == "Admin"){
					      $id = $_SESSION['User_id'];
					 $activity = $_SESSION['Title'].' '.$_SESSION['Name'].  'Has just logged in....';
					 $sql = "INSERT INTO activities(User_id, Activity) VALUES('$id', '$activity')";
				$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
					header('location:admin/index.php');  
				 }
			                 
            else if($role == "Staff"){
				  $id = $_SESSION['User_id'];
					 $activity = $_SESSION['Title'].' '.$_SESSION['Name'].  'Has just logged in....';
					 $sql = "INSERT INTO activities(User_id, Activity) VALUES('$id', '$activity')";
				$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
				header('location:users/index.php');
 
			}else{
				
				$id = $_SESSION['User_id'];
					 $activity = $_SESSION['Title'].' '.$_SESSION['Name'].  'Has just logged in....';
					 $sql = "INSERT INTO activities(User_id, Activity) VALUES('$id', '$activity')";
				$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
				header('location:index.php');
				
			}
            
							}
							} 

							}

							}
							}
							}

 
?>


 <?php include('includes/header1.php');?>
<body style="background-image: url(./images/banner.JPG);
  background-position:absolute;color:gray;" class="hold-transition login-page" >
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>C M S</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
	   <div class="col-xs-1"></div>
	 	  <div class="col-xs-10">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" value="1"> Remember Me
            </label>
          </div>
        </div>
		 <div class="col-xs-1"></div>
        <div class="col-xs-4"></div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="login" class="btn btn-primary btn-flat">Sign In</button>
        </div>
		 <div class="col-xs-4"></div>
        <!-- /.col -->
      </div>
    </form>     
    <a href="register.php" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php include('includes/footer.php');?> 
 