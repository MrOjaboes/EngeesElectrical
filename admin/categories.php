<?php include "includes/connection.php"; ?> 

 
 
<?php include "includes/header.php";?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         

        <!-- Main content -->
        <section class="content">
          <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Added Categories</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-info" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                         
                    </div>
                </div>
                <div class="box-body">
				
				<?php

//$button = $_GET['submit'];

if(isset($_POST['go'])){ 
  
 $search = mysqli_real_escape_string($connect, $_POST['search']);
	 
	 $sql = "SELECT * FROM category WHERE  name LIKE '%$search%'";
	 $query = mysqli_query($connect,$sql)or die(mysqli_error($connect));
	 $foundno = mysqli_num_rows($query);
	 if($foundno > 0){
		 ?>
		 <div class="table-responsive" style="overflow-x:scroll;width:auto;">
				<table class="table table stripped">				 
				<tr>
				<th>S/N</th>
				<th>CAPTION</th>			 				 				 			 
				<th>PHOTO</th>			 				 				 			 
				<th>DATE ADDED</th>
				<th>DATE MODIFIED</th>
				</tr>
		 
		 <?php		 
		 		 
		//echo 'Number of result(s) found!  '.$foundno;
		 		$sn = 1;
            while($row = mysqli_fetch_assoc($query)){
				 $id = $row['id'];                
				$title = $row['name'];
				$image = $row['author'];
				$date = $row['date'];
				 
			
			     echo '
				<tr class="active">				 
				<td><a href="#">'.$sn .'</a></td>
				<td>'.$title .'</a></td>
				 	<td>'.$date .'</td>			
				 </tr>';				 
				$sn++;
			}
                	
?>
</table>
				</div>

<?php				
		
			 
	 }else{echo 'no result(s) found for   '.$search;
	 }	
 } 
 

?>
	
	 	
				<div class="panel panel-default">
            <div class="panel-heading"><h2 class="text-center">Manage Uploaded Categories</h2></div>
			
			<div style="float:center;">
			<form action="" method="POST" class="sidebar-form form-static">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Search Client...">
              <span class="input-group-btn">
                <button type="submit" name="go" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
			</div>
			
			</div>
			<div style="overflow-y:scroll;height:250px;" class="table-responsive">
            <table class="table table-hover">

                <tr class="active">
                    <th>S/N</th>
                    <th>Category Names</th>
                    <th>Author</th>
                    <th>Date Created</th>
                    <th colspan="3"></th>
                </tr>
				
                <?php
                     $sn = 1;
                $sql = "SELECT * FROM category ORDER BY id DESC ";
                $query = mysqli_query($connect, $sql);
                while($row = mysqli_fetch_array($query)){
                $id = $row['id'];
                $caption = $row['name'];
                $author = $row['author'];
                $date = $row['date'];
                $cdate = new DateTime($date);
                $newdate = $cdate-> format('l, j F Y');

                ?>

                <tbody>
                <tr>
                    <td><?php echo $sn; ?></td>
                    <td ><?php echo $caption;  ?></td>
                    <td ><?php echo $author;  ?></td>
                    <td ><?php echo $newdate;  ?></td>
                   
                    <td>
					<a href="edit_client.php?uid=<?php echo $id ?>"><button name="edit" title="update client" class="btn btn-success"><i class="fa fa-pencil"></i></button></a>
					<a href="client_details.php?cid=<?php echo $id ?>"><button title="client details" class="btn btn-info"><i class="fa fa-file"></i></button></a>
					<a href="delete_client.php?did=<?php echo $id ?>"><button name="delete" title="delete client" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                    </td>
                </tr>
                <?php  
				$sn++;
				}
				?>
                </tbody>
                



            </table>
</div>
        </div>
    </div>
                     </div>
					 </section>
                
             
             
<?php include_once "includes/footer.php";?>
