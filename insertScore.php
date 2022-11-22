<?php
/* Connect with init.php */ 
require "init.php";
/* Declare variables type POST */
$username = $_POST["USERNAME"];
$score = $_POST["SCORE"];
$level = $_POST["LEVEL"];
/* Declare $sql Select all data from member table and give username equal $username */
$sql = "SELECT userId from member where username = '$username'";

/* Declare $result to send data from $sql to database ($con) */
$result = mysqli_query($con, $sql);
$resultarray = mysqli_fetch_assoc($result);
/* If can't find the same username in database */
if (mysqli_num_rows($result)!=1) {
    echo ("CANT_FIND_THIS_USER");
} 
/* If can find the same username in database */
else {
    $checkScoreId = "Select * From score ORDER BY scoreId DESC LIMIT 1";
    /* Declare $checkresult to send data from $checkScoreId to database ($con) */
    $checkresult = mysqli_query($con, $checkScoreId);
    $userId = $resultarray['userId'];

    /* If the user already has a score, create a new scoreID to store the new score value */
    if($checkResultArray = mysqli_fetch_assoc($checkresult)){
        $mostScoreId = $checkResultArray['scoreId']; 
        $row = str_replace("SID","",$mostScoreId); 
        $idIncrease = $row+1;
        $getString = str_pad($idIncrease,13,0,STR_PAD_LEFT); 
        $scoreId = "SID".$getString; 
        $sql2 = "insert into score(scoreId,userId,modeAndLevelId,endTime) value('$scoreId','$userId','$level','$score');";
    }
    /* If the user has a score for the first time */
    else{
        $scoreId="SID0000000000001";
        $sql2 = "insert into score(scoreId,userId,modeAndLevelId,endTime) value('$scoreId','$userId','$level','$score');";
        echo ("FIRST_SCORE");
    }
    //If add data success.
    if(mysqli_query($con,$sql2)){
        echo("SUCCESS");
        //$status = "success";
    }
    //If add data failure.
    else{
        echo("FAILURE");
        //$status = "failure";
    }
}
/* Close connection with database. */
mysqli_close($con);
    
?>