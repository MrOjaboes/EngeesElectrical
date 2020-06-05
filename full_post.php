<?php include("includes/connection.php");?>
<?php include("includes/session.php");?>
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
          <form  action="blog.php" class="navbar-form">
            <input type="text" name="search" class="form-control" placeholder="Search Post........">
            <button class="btn btn-primary" type="submit" name="Searchbutton"><span class="glyphicon glyphicon-search"></button>
             </form>
</div>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="line" style="height:10px;background:#27AAE1;"></div>
    <div style="padding-top:50px;"></div>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="row">
     
      <div class="col-sm-8">
      <div><?php echo SuccessMessage();?></div>
      <?php
				if(isset($_GET['Searchbutton'])){
         
  $search = mysqli_real_escape_string($connect, $_GET['search']);  
	 $sql = "SELECT * FROM products WHERE  title LIKE '%$search%' OR date LIKE '%$search%' OR category LIKE '%$search%' OR post LIKE '%$search%'";
        }else{ 
            $idFromUrl = $_GET['id'];
            $sql="SELECT * FROM products WHERE id='$idFromUrl'";}
                $query = mysqli_query($connect, $sql);
                while($row = mysqli_fetch_array($query)){
                    $post_id = $row['id'];
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
         <p class="description">Category : <?php echo htmlentities($category)?> Published On : <?php echo htmlentities($date)?></p>
         <p class="post"><?php
        // if(strlen($description) > 150){$description = substr($description,0,150).'.....';}
         echo htmlentities($description)?></p>
   
        </div>
         
                </div>
        <?php }?>
        

            
<span class="fieldInfo">Comments</span>
<br><br>
<?php
			 
            $idFromUrl = $_GET['id'];
            $sql="SELECT * FROM comments WHERE post_id='$idFromUrl'AND status='ON'";
                $query = mysqli_query($connect, $sql);
                while($row = mysqli_fetch_array($query)){
                    $post_id = $row['id'];
                    $content = $row['post'];
                    $commentor = $row['name'];                                   
                    $date = $row['date'];
                    //$category = $row['category'];
                    $cdate = new DateTime($date);
                    $newdate = $cdate-> format('l, j F Y');
                    ?>
                     
        <div class="caption">
            <img src="./img/image.PNG" height="100" width="100">
         <h5 id="heading"> <?php echo htmlentities($commentor);?></h5>
         <p class="description">Published On : <?php echo htmlentities($newdate);?></p>
         <p class="post"><?php echo htmlentities($content);?>
         </p>
   
        </div>
        <?php } ?>
                     

<span class="fieldInfo">Share Your Thought About This Post</span>
<br><br>

        <?php
    $message ='';
	if(isset($_POST["go"])){
		$name = htmlspecialchars(trim($_POST["name"]));
        $post = htmlspecialchars(trim($_POST["post"]));
        $email = htmlspecialchars(trim($_POST["email"]));	 
		if(!empty($name) || !empty($post) || !empty($email) ){			   
				//INSERT TO DATABASE
				$sql1 = "INSERT INTO comments(name,email,post,status,post_id) VALUES('$name','$email','$post','OFF','$post_id')";
                $query1 = mysqli_query($connect, $sql1) or die(mysqli_error($connect));
                if($query1){
                    $_SESSION['SuccessMessage'] ='Comment successfully Inserted';
				
                }	 
			else{
				 
				$message .= "Unable to insert comment";
			}
        
    }
}

                    ?>

          <form action="" method="post">
              <div class="form-group">
          <label class="fieldInfo">Name</label>
              <input type="text" class="form-control" name="name" placeholder="Name" required>
                </div>
              <br>
              <div class="form-group">
              <label class="fieldInfo">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
              <br>
              <div class="form-group">
              <label class="fieldInfo">Post </label>
                            <textarea class="form-control" required placeholder="Post...." name="post" required></textarea>
                        </div>
                        <br>
                        <div class="form-group">
              <input type="submit" name="go" value="Comment" class="btn btn-block btn-primary">
                </div>
          </form>


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
      <div class="panel-body">
      
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
