<?php session_start(); ?>
<?php 
if(!isset($_SESSION['email'])){ 
	header('location: ./admin.php');
}else{ 
  ?>

<?php include "includes/connection.php";?>
<?php include "includes/functions.php";?>
<?php include "includes/header.php";?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-4 col-xs-6">
        <?php 
		  
	     $sql = " SELECT COUNT(*) AS total FROM users";	 
         $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	     $row = mysqli_fetch_assoc($query);
	     $num = $row['total'];
		
 
		?>
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <h3 class="text-center"><?php echo $num;?></h3>
              <p>Admins</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="users.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4 col-xs-6">
		<?php 
		  
	     $sql = "SELECT COUNT(*) AS total FROM products";	 
         $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	     $row = mysqli_fetch_assoc($query);
	     $num = $row['total'];
		
 
		?>
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 class="text-center"><?php echo $num;?></h3>
              <p>Products Available</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-briefcase"></i>
            </div>
            <a href="posts.php" class="small-box-footer">More Info<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
		<?php 
		  /*
	     $sql = " SELECT COUNT(*) AS total FROM client";	 
         $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	     $row = mysqli_fetch_assoc($query);
	     $num = $row['total'];
		
 */
		?>
          
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
		<?php 
		  
	     $sql = " SELECT COUNT(*) AS total FROM users";	 
         $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));
	     $row = mysqli_fetch_assoc($query);
	     $num = $row['total'];
		
 
		?>
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
          <h3 class="text-center"><?php echo $num; ?></h3>
              <p>Number of Slides</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once "includes/footer.php";?>
<?php }?>
