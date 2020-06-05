
<?php include "includes/connection.php";?>
 
<?php include "includes/session.php";?>

<?php session_start();?>
<?Php

function Redirect_to($location){
    header("location:".$location);
    exit;
}

function Login(){
    if(isset($_SESSION['email'])){
        return true;
    }
}
function Confirm_Login(){
    if(!Login()){
        Redirect_to("./admin.php");
    }
}
?>