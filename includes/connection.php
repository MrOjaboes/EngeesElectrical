<?php
/**
 * Created by PhpStorm.
 * User: Mr Heart
 * Date: 5/10/2016
 * Time: 2:02 AM
 */


$host = "localhost";
$user = "root";
$pass = "mysql";
$db = "cms";


$connect = mysqli_connect($host, $user, $pass, $db) or die(mysqli_error($connect));