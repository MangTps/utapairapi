<?php
//Declare variables
$host = "us-cdbr-east-06.cleardb.net";
$user_name = "ba1992da29a591";
$user_password = "645eb6c1";
$db_name = "heroku_6b963b71382aa57";

// Connecting to database in phpmyadmin
$con = mysqli_connect($host,$user_name,$user_password,$db_name) or die ("database connection error");

?>
