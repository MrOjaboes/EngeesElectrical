<?php
 $connect = mysqli_connect('localhost', 'root', '', 'pml');
 $sql = "SELECT * FROM slider WHERE  Caption LIKE '%$search%'";
 $query = mysqli_query($connect,$sql)or die(mysqli_error($connect));
	  

?>