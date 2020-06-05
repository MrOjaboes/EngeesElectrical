<?php include("includes/connection.php");?>
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
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
<div class="nav navbar-right">
          <form class="navbar-form">
            <input type="text" name="search" class="form-control" placeholder="Search Post........">
            <button class="btn btn-primary" type="submit" name="Searchbutton"><span class="glyphicon glyphicon-search"></button>
             </form>
</div>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="line" style="height:10px;background:#27AAE1;"></div>
    <div style="padding-top:70px;"></div>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="row">
     
      <div class="col-sm-8">
      <?php
				if(isset($_GET['Searchbutton'])){
         //default query when searchbutton is active
  $search = mysqli_real_escape_string($connect, $_GET['search']);  
	 $sql = "SELECT * FROM products WHERE  title LIKE '%$search%' OR date LIKE '%$search%' OR category LIKE '%$search%' OR post LIKE '%$search%'";
        //Query when post is active
  } 
   //Query when category is active
  elseif(isset($_GET['category'])){
   $categorySearch = $_GET['category'];
   $sql = "SELECT * FROM products WHERE  category ='$categorySearch'ORDER BY date DESC";
  
  }
   //for pagination i.e blog.php?page=1
  elseif(isset($_GET['page'])){
    $page = $_GET['page'];
    
    if($page == 0 || $page < 1){
      $showPostFrom = 0;
    }else{
      $showPostFrom = ($page * 3)-3;
    }
    $sql="SELECT * FROM products ORDER BY id DESC LIMIT $showPostFrom,3";
        } //default query blog.php
        else{ $sql="SELECT * FROM products ORDER BY id DESC LIMIT 0,3";}
                $query = mysqli_query($connect, $sql);
                while($row = mysqli_fetch_array($query)){
                    $id = $row['id'];
                    $description = $row['post'];
                    $title = $row['title'];   
                    $image = $row['image'];                  
                    $date = $row['date'];
                    $category = $row['category'];
                    //$cdate = strtotime('l j F Y'; $date);
                    //date('l j F Y');
                    ?>
                     
        <div id="blog-post" class="thumbnail">
        <a href="<?php echo'./assets/posts/'.$image;?>"><img src="<?php echo'./assets/posts/'.$image;?>"  class="img-rounded img-responsive"/></a></td>				
                        
         
        <div class="caption">
         <h1 id="heading"> <?php echo htmlentities($title)?></h1>
         <p class="description">Category : <?php echo htmlentities($category)?> Published On : <?php echo htmlentities($date)?>
         <?php 
		  
                        $UnApproved = " SELECT COUNT(*)  FROM comments WHERE post_id ='$id' AND status='ON'";	 
                          $QueryUnApproved = mysqli_query($connect, $UnApproved) or die(mysqli_error($connect));
                        $rows = mysqli_fetch_array($QueryUnApproved);
                        $UnApprovedComment = array_shift($rows);
                       if($UnApprovedComment > 0){

                       
                   
                     ?>
                        <span class="label label-success pull-right"><?php echo $UnApprovedComment;?></span>
                       <?php }?>


         
         </p>
         <p class="post"><?php
         if(strlen($description) > 150){$description = substr($description,0,150).'.....';}
         echo htmlentities($description)?></p>
   
        </div>
        <a class="btn btn-lg btn-info" href="full_post.php?id=<?php echo $id;?>" role="button">View More&raquo;</a>
        
                </div>
        <?php }?>
        <nav>
  <ul class="pagination pull-left pagination-lg">
    <?php
    if(isset($page)){    
     if($page > 1){
       ?>
       <li><a href="blog.php?page=<?php echo $page-1;?>">&laquo;</a></li>
       <?php
     }
     }  ?>
    
    
        <?php
        
        $PaginationCount = " SELECT COUNT(*)  FROM products";	 
                          $QueryUnApproved = mysqli_query($connect, $PaginationCount) or die(mysqli_error($connect));
                        $rows = mysqli_fetch_array($QueryUnApproved);
                        $TotalPaginationCount = array_shift($rows);
                       //if($UnApprovedComment > 0){
                         $postPerPage = $TotalPaginationCount/3;
                         $postPerPage = ceil($postPerPage);
                         for($i=1;$i<=$postPerPage;$i++){
                           if(isset($page)){

                           
if($i == $page){


                         
?>

    <li class="active"><a href="blog.php?page=<?php echo $i;?>"><?php echo $i;?></a>
<?php 
}else{?>
  <li><a href="blog.php?page=<?php echo $i;?>"><?php echo $i;?></a>
<?php
} 
}
} ?></li>
 <?php
     if($page +1<= $postPerPage){
       ?>
       <li><a href="blog.php?page=<?php echo $page+1;?>">&raquo;</a></li>
       <?php
     
    }
    ?>
  </ul>
</nav>

      </div>
              
      <div class="col-sm-offset-1 col-sm-3">
      <h2 class="text-center">About Me</h2>
      <img src="img/image.PNG" class="img-responsive img-circle imageicon">
      <p> hfdjhfkjkfddsssssssssssssssssssssssssssujfmhjffjfjfjff
      ifdjfjffjjfhjfdijffjhkreuriowolwieeufhrlfirefrireiriruikieiee
      jfjfjjiirrkirurrkkeirerijrfieoiueeuurfrrjrrrrriurjrhfhjehjueukeie</p> 
      <div class="panel panel-primary">
      <div class="panel-heading">
      <h2 class="panel-title">Categories</h2>
      </div>
      <div class="panel-body background">
      <ul>
      <?php
                     $sn = 1;
                $sql = "SELECT * FROM category ORDER BY date DESC ";
                $query = mysqli_query($connect, $sql);
                while($row = mysqli_fetch_array($query)){
                 $caption = $row['name'];                
                
                ?>
                               
                   
            <li id="heading"><a href="blog.php?category=<?php echo $caption;?>"><?Php echo $caption;?></a></li>
                <?php }?>
      </ul>
             
      </div>
            <div class="panel-footer">
            </div>
      </div>


      <div class="panel panel-primary">
      <div class="panel-heading">
      <h2 class="panel-title">Recent Posts</h2>
      </div>
      <div class="panel-body background">
      
      <?php
                     $sn = 1;
                $sql = "SELECT * FROM products ORDER BY date DESC ";
                $query = mysqli_query($connect, $sql);
                while($row = mysqli_fetch_array($query)){
                 $caption = $row['title'];  
                 $image = $row['image']; 
                 $date = $row['date'];                   
                 $cdate = new DateTime($date);
                 $newdate = $cdate-> format('l, j F Y');
                           
                
                ?>
                  <div>
                  <a href="<?php echo'./assets/posts/'.$image;?>" target="_blank"><img style="margin-top:10px;margin-left:10px;" src="<?php echo'./assets/posts/'.$image;?>" height="70" width="70" class="img-rounded img-responsive pull-left"/></a>				
                  <p style="margin-left:90px;" id="heading"><a href="blog.php?post=<?php echo $caption;?>"><?Php echo $caption;?></a></p>
                  <p style="margin-left:90px;" class="description"><?Php echo $newdate;?></p>
                     <hr>
               
                  </div>             
                   
                         <?php }?>
       
             
      </div>
            <div class="panel-footer">
            </div>
      </div>

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
