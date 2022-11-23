<?php

require "init.php";
$level = $_POST["LEVEL"];
$username = $_POST["USERNAME"];

$sql = "SET @row_number = 0;";
$sql2 = "SELECT * FROM (SELECT member.username,score.endTime,(@row_number:=@row_number+1) 
As row_index FROM score INNER JOIN member ON score.userId = member.userId 
WHERE score.modeAndLevelId ='$level' ORDER BY score.endTime LIMIT 50) 
As A WHERE A.username ='$username' LIMIT 1;";

//Declare $result to send data from $sql to database ($con).
$result = mysqli_query($con, $sql);

if (!mysqli_num_rows($result)) {
    echo ("FAILURE");
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
mysqli_close($con);
    
?>