<?php
/* Connect with init.php */ 
require "init.php";
/* Declare variables type POST */
$username = $_POST["USERNAME"]; /* declare variable to receive value with string key USERNAME  */
$score = $_POST["SCORE"]; /* declare variable to receive value with string key SCORE  */
$level = $_POST["LEVEL"]; /* declare variable to receive value with string key LEVEL  */
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
    $checkresult = mysqli_query($con, $checkScoreId); /* send $checkScoreId to database */
    $userId = $resultarray['userId']; /* declare $userId to get userId from $resultarray */

    /* If the user already has a score, create a new scoreID to store the new score value */
    if($checkResultArray = mysqli_fetch_assoc($checkresult)){
        $mostScoreId = $checkResultArray['scoreId']; /* declare $mostScoreId to get scoreId from $checkResultArray */
        $row = str_replace("SID","",$mostScoreId); /* declare $row to get scoreId from $checkResultArray and remove string SID */
        $idIncrease = $row+1; /* declare $idIncrease to get $row+1 */
        $getString = str_pad($idIncrease,13,0,STR_PAD_LEFT); /* declare $getString to get $idIncrease and add 0 to left side until 13 digits */
        $scoreId = "SID".$getString;  /* declare $scoreId to get string SID and $getString */
        $sql2 = "insert into score(scoreId,userId,modeAndLevelId,endTime) value('$scoreId','$userId','$level','$score');"; 
        /* declare $sql2 to insert data to score table */
    }
    /* If don't have any score data */
    else{
        $scoreId="SID0000000000001"; /* declare $scoreId to get string SID0000000000001 */
        $sql2 = "insert into score(scoreId,userId,modeAndLevelId,endTime) value('$scoreId','$userId','$level','$score');";
        /* declare $sql2 to insert data to score table */
        echo ("FIRST_SCORE"); /* response FIRST_SCORE to app */
    }
    /* If insert data success. */
    if(mysqli_query($con,$sql2)){/* send $sql2 to database */
        echo("SUCCESS"); /* response SUCCESS to app */

    }
    /* If insert data failure. */
    else{
        echo("FAILURE"); /* response FAILURE to app */
    }
}
/* Close connection with database. */
mysqli_close($con);
    
?>