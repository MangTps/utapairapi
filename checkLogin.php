<?php
/* include data from init.php */
require "init.php";

/* Declare variables type POST */
$username = $_POST["USERNAME"];
$password = $_POST["PASSWORD"];

/* Declare $sql Select username from member table  and give username equal $username password equal $password. */
$sql = "select username from member where username = '$username' and password = '$password' ";

/* Declare $result to send data from $sql to database ($con). */
$result = mysqli_query($con,$sql);

/* If don't have data in database */
if(!mysqli_num_rows($result)>0){
    echo("FAILURE") ; /* response FAILURE to app */
}

/* If have data in database. */
else{
    $row = mysqli_fetch_assoc($result); /* fetch data as associative array to $row */
    echo("SUCCESS"); /* response SUCCESS to app */
}

/* Close connection with database. */
mysqli_close($con);
?>