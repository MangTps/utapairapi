<?php
// Connect with init.php.
require "init.php";

//Declare variables type GET
$oldUsername = $_POST["OLD_USERNAME"];
$newUsername = $_POST["NEW_USERNAME"];
if($con === false){
    die("ERROR: Could not connect.".mysqli_connect_error());
}


//Declare $sql Select username from member table and give username equal $newusername 
$sql = "select `username` from `member` where `username` = '$newUsername' ";

//Declare $result to send data from $sql to database ($con).
$result = mysqli_query($con,$sql);
//If have newUsername match with username in database
if(mysqli_num_rows($result)>0){
    echo("EXIST") ;
    //$status = "exist";
}

//If don't have data in database.
else {
    echo("ABLE");
    $sql2 ="UPDATE member SET username = '$newUsername' where username = '$oldUsername'; ";
    // If update data success
    if(mysqli_query($con,$sql2) == TRUE){
        echo("SUCCESS");
        //$status = "success"
    }
    // If update data failure
    else{
        echo("FAILURE");
        //$status = "failure"
    }
    $result2 = mysqli_query($con,$sql2);
}
// echo json_encode(array("response"=>$status));
//Close connection with database.
mysqli_close($con);
?>