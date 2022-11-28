<?php
/* include data from init.php */
require "init.php";

/* Declare variables type POST */
$oldUsername = $_POST["OLD_USERNAME"];
$newUsername = $_POST["NEW_USERNAME"];
if($con === false){ /* if can't connect to database */
    die("ERROR: Could not connect.".mysqli_connect_error()); /* response error to app */
}


/* Declare $sql Select username from member table and give username equal $newusername */
$sql = "select `username` from `member` where `username` = '$newUsername' ";

/* Declare $result to send data from $sql to database ($con). */
$result = mysqli_query($con,$sql);
/* If have newUsername match with username in database */
if(mysqli_num_rows($result)>0){
    echo("EXIST") ; /* response EXIST to app */
}
/* If don't have data in database. */
else {
    echo("ABLE"); /* response ABLE to app */
    $sql2 ="UPDATE member SET username = '$newUsername' where username = '$oldUsername'; "; 
    /* declare $sql2 to update data to member table */
    /* If update data success */
    if(mysqli_query($con,$sql2) == TRUE){
        echo("SUCCESS");
        /* response SUCCESS to app */
    }
    else{
        echo("FAILURE");
        /* response FAILURE to app */
    }
    $result2 = mysqli_query($con,$sql2);
}
/* Close connection with database. */
mysqli_close($con);
?>