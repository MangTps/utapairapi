<?php
//Connect with init.php.
require "init.php";

//Declare variables type POST.
$username = $_POST["USERNAME"];
$password = $_POST["PASSWORD"];
$blind = $_POST["BLIND"];

//Declare $sql Select all data from member table and give username equal $username.
$sql = "select * from member where username = '$username'";

//Declare $result to send data from $sql to database ($con).
$result = mysqli_query($con,$sql);

//If have the same username in database.
if(mysqli_num_rows($result)>0){
    echo("EXIST");
    //$status = "exist";
}

//If don't have the same username in database.
else{
    //Declare $checkuid select all data from member table  and sort data by userId descending and than select one data.
    $checkuid = "Select * From member ORDER BY userId DESC LIMIT 1";
    $checkresult = mysqli_query($con,$checkuid);
    
    // If in database have data
    if(mysqli_num_rows($checkresult)>0){
        if($row = mysqli_fetch_assoc($checkresult)){
            $uid = $row['userId'];
            $get_number = str_replace("UID","",$uid);
            $id_increase = $get_number+1;
            $get_string = str_pad($id_increase,5,0,STR_PAD_LEFT);
            $id = "UID".$get_string;
            $sql = "insert into member(userId,username,password,blindness) value('$id','$username','$password','$blind');";
        }
    }
    // If in database don't have data.
    else{
        $id="UID00001";
        $sql = "insert into member(userId,username,password,blindness) value('$id','$username','$password','$blind');";
    }
    
    //If add data success.
    if(mysqli_query($con,$sql)){
        echo("SUCCESS");
        //$status = "success";
    }
    //If add data failure.
    else{
        echo("FAILURE");
        //$status = "failure";
    }
}

//Close connection with database.
mysqli_close($con);

?>