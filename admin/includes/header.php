<?php @session_start();?>
 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>C M S | Admin Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/font-awesome.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  	<link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.min.css">
  <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->




</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C M S </b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>C M S</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->	  
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
 <span style="margin:20px;font-size:25px !important;"><?php echo '<b class="label label-default"> Welcome ' . $_SESSION['Title'].' ' . $_SESSION['email'].'</b>';?></span>
	                  
      <div class="navbar-custom-menu">
	  
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
           
          <!-- Notifications: style can be found in dropdown.less -->
 
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo'../assets/images/'.$_SESSION['Image']; ?>" class="user-image" alt="">
              <span class="hidden-xs"><?php echo $_SESSION['Username'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
               <img src="<?php echo'../assets/images/'.$_SESSION['Image']; ?>" class="img-circle" alt="">

                <p>
                 <?php echo $_SESSION['Username'];?> - Web Developer
                  <small>Member since Nov. 2017</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
				<a href="profile.php?pid=<?php echo $_SESSION['User_id'];?>"><button class="btn btn-default btn-flat">Profile </button></a>
                   
                </div>
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">		 
          <img src="<?php echo'../assets/images/'.$_SESSION['Image']; ?>" class="img-circle" alt="">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['Username'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="search.php" method="POST" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> </i>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Users</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="user.php"><i class="fa fa-user"></i>Add New Admin</a></li>
            <li><a href="users.php"><i class="fa fa-user"></i>Manage Admins</a></li>
            
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Posts</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="post.php"><i class="fa fa-circle-o"></i>Add New Post</a></li>
            <li><a href="posts.php"><i class="fa fa-circle-o"></i>Manage Posts</a></li>
            
          </ul>
        </li>
		
		 <li class="treeview">
          <a href="#">
            <i class="fa fa-gears"></i>
            <span>Settings</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
		  <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Profile</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">		  
            <li><a href="profile.php?pid=<?php echo $_SESSION['User_id'];?>"><i class="fa fa-files-o"></i>View Profile</a></li>
            <li><a href="update.php?eid=<?php echo $_SESSION['User_id'];?>"><i class="fa fa-pencil"></i>Update Profile</a></li>
            
          </ul>
        </li>
            <li><a href="profile_photo.php?phid=<?php echo $_SESSION['User_id'];?>"><i class="fa fa-pencil"></i>Change Profile Photo</a></li>
            <li><a href="username.php?uid=<?php echo $_SESSION['User_id'];?>"><i class="fa fa-pencil"></i>Change Username</a></li>
            <li><a href="password.php?paid=<?php echo $_SESSION['User_id'];?>"><i class="fa fa-pencil"></i>Change Password</a></li>
            
          </ul>
        </li>
        <li class="treeview">
          <a href="comments.php">
          <?php 
		  
      $sql = " SELECT COUNT(*) AS total FROM comments";	 
        $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
      $row = mysqli_fetch_assoc($query);
      $num = $row['total']; 
      if($num > 0){

       
   ?>
        
            <i class="fa fa-comment"></i>Comments<span class="label label-warning pull-right">  <?php echo $num;?></span> </i>
      <?php }?>
          </a>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Categories</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="category.php"><i class="fa fa-circle-o"></i>Add New category</a></li>
            <li><a href="categories.php"><i class="fa fa-circle-o"></i>Manage categories</a></li>
            
          </ul>
        </li>
          

        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Sliders</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="slider.php"><i class="fa fa-circle-o"></i>Add Slide</a></li>
            <li><a href="sliders.php"><i class="fa fa-circle-o"></i>Manage Slides</a></li>
            
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Services</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="service.php"><i class="fa fa-circle-o"></i>Add Service</a></li>
            <li><a href="services.php"><i class="fa fa-circle-o"></i>Manage Services</a></li>
            
          </ul>
        </li>
        <li class="treeview">
          <a href="aboutUs.php">
            <i class="fa fa-dashboard"></i> <span>About Us</span> </i>
          </a>
        </li>

        <li class="treeview">
          <a href="contact.php">
            <i class="fa fa-dashboard"></i> <span>Contact Us</span> </i>
          </a>
        </li>
		
   

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

 