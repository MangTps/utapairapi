<?php
/* include data from init.php */ 
require "init.php";

/* Declare variables type POST */
$username = $_POST["USERNAME"];
$password = $_POST["PASSWORD"];
$blind = $_POST["BLIND"];

/* Declare $sql Select all data from member table and give username equal $username. */
$sql = "select * from member where username = '$username'";

/* Declare $result to send data from $sql to database ($con). */
$result = mysqli_query($con,$sql);

/* If have the same username in database. */
if(mysqli_num_rows($result)>0){
    echo("EXIST"); /* response exist to app */
}

/* If don't have the same username in database. */
else{
    /* Declare $checkuid select all data from member table  and sort data by userId descending and than select one data. */
    $checkuid = "Select * From member ORDER BY userId DESC LIMIT 1"; /* select last userId */
    $checkresult = mysqli_query($con,$checkuid); /* send $checkuid to database */
    
    /* If in database have data */
    if(mysqli_num_rows($checkresult)>0){ /* if have data */
        if($row = mysqli_fetch_assoc($checkresult)){ /* fetch data as associative array to $row */
            $uid = $row['userId']; /* declare $uid to receive value of userId from $row */
            $get_number = str_replace("UID","",$uid); /* declare $get_number to receive value of userId from $row and remove string UID */
            $id_increase = $get_number+1; /* declare $id_increase to receive value of $get_number+1 */
            $get_string = str_pad($id_increase,5,0,STR_PAD_LEFT); /* declare $get_string to receive value of $id_increase and add 0 to left side until 5 digits */
            $id = "UID".$get_string; /* declare $id to receive value of string UID and $get_string */
            $sql = "insert into member(userId,username,password,blindness) value('$id','$username','$password','$blind');"; /* declare $sql to insert data to member table */
        }
    }
    /* If in database don't have data. */
    else{
        $id="UID00001"; /* declare $id to receive value of string UID00001 */
        $sql = "insert into member(userId,username,password,blindness) value('$id','$username','$password','$blind');"; /* declare $sql to insert data to member table */
    }
    
    /* If add data success. */
    if(mysqli_query($con,$sql)){
        echo("SUCCESS"); /* response success to app */
    }
    /* If add data failure. */
    else{
        echo("FAILURE"); /* response failure to app */
    }
}

//Close connection with database.
mysqli_close($con);

?>