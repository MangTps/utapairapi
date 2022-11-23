<?php

require "init.php";
$level = $_POST["LEVEL"];
$username = $_POST["USERNAME"];
$sql = "SET @row_number = 0;";
$sql2 = "SELECT member.username,score.endTime,(@row_number:=@row_number+1) AS row_index 
 FROM score INNER JOIN member ON score.userId = member.userId WHERE score.modeAndLevelId ='$level' 
 AND member.username = '$username' ORDER BY `score`.`endTime` ASC;";

//Declare $result to send data from $sql to database ($con).
mysqli_query($con, $sql);
$res = mysqli_query($con, $sql2);

if (!mysqli_num_rows($res)) {
    echo ("FAILURE");
} else {
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
mysqli_close($con);
    
?>