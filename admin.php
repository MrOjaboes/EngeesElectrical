<?php session_start();?>

<?php include("includes/connection.php");?>
<?php include("includes/session.php");?>
 
<?php
 
if(isset($_POST['login'])){
  $message ='';
$email = $_POST['email'];
$password = $_POST['password'];
$mdpassword = md5($password); 
         if($email && $mdpassword){
          $sql = "SELECT * FROM users WHERE email ='$email'";
       $result = mysqli_query($connect,$sql)or die(mysqli_error($connect));
      $numrow = mysqli_num_rows($result);
      if($numrow !=0){
     while($row = mysqli_fetch_array($result)){
     $id = $row['id'];	      
     $name = $row['fname'];      
     $image = $row['image'];
     $dbemail = $row['email'];           
     $uname = $row['username'];      
     $role = $row['role'];      
     $dbpassword = $row['password'];
     $date = $row['date'];
     
	 
	  
     $_SESSION['id'] = $id;       
     $_SESSION['image'] = $image;
     $_SESSION['username'] = $uname; 
     $_SESSION['role'] = $role; 
     $_SESSION['password'] = $dbpassword; 
     $_SESSION['fname'] = $name;      
     $_SESSION['email'] = $email;
     $_SESSION['date'] = $date;
      
    if($email == $dbemail){
		if(isset($_POST['remember'])){
				 setcookie('Email',$email, time()*60*60*7);
			 }
             if($mdpassword == $dbpassword){
				 if($role == "Admin"){
					      $id = $_SESSION['id'];
					 $activity = $_SESSION['username'].  'Has just logged in....';
					 $sql = "INSERT INTO activities(user_id, content) VALUES('$id', '$activity')";
				$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
					header('location:admin/index.php');  
				 }
			                 
            else if($role == "Staff"){
				  $id = $_SESSION['id'];
					 $activity = $_SESSION['username'].  'Has just logged in....';
					 $sql = "INSERT INTO activities(user_id, content) VALUES('$id', '$activity')";
				$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
				header('location:users/index.php');
 
			}else{
				
				$id = $_SESSION['id'];
					 $activity = $_SESSION['username'].  'Has just logged in....';
					 $sql = "INSERT INTO activities(user_id, content) VALUES('$id', '$activity')";
				$query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
				header('location:blog.php');
				
			}
            
							}else{
                $message .='password do not match!';
              }
							}else{
                $message .='Email do not match!';
              } 

							}

							}
							}
							}

 
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>CMS</title>
    <script src="includes/js/jquery-3.3.1.js"></script>
    <script src="includes/js/bootstrap.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="includes/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <link href="includes/publicstyle.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <div style="margin-top:-70px;"></div>
    <!-- Fixed navbar -->
    <div style="height:10px;background:#27AAE1;"></div>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><em><b>CONVERSE</b></em></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
             
          </ul>
<div class="nav navbar-right">
         
</div>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="line" style="height:10px;background:#27AAE1;"></div>
    <div style="padding-top:50px;"></div>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="row"> 
      <div class="col-md-4"></div>
      <div class="col-md-4">
      <div> <?php echo $message;?></div> 
      <h2>Welcome Back!</h2>
      
      <form action="" method="post">
      <div class="form-group">
              <label for="email" class="fieldInfo">Email</label>
              <div class="input-group">
              <span class="input-group-addon">
              <span class="glyphicon glyphicon-envelope text-info"></span>             
              </span>
              <input type="email" class="form-control input-lg" id="email" name="email" placeholder="Email" required>
                </div>
                </div>
                 

              <br>
              <div class="form-group">
              <label for="password" class="fieldInfo">Password</label>
              <div class="input-group">
              <span class="input-group-addon">
              <span class="glyphicon glyphicon-lock  text-info"></span>             
              </span>
              <input type="password" class="form-control input-lg" id="password" name="password" placeholder="Password" required>
                </div>
                </div>
                
              <br>
                   <div class="form-group">
              <input type="submit" name="login" value="Login" class="btn btn-lg btn-block btn-primary">
                </div>
          </form>
</div>
<div class="col-md-4"></div>
      </div>
</div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
