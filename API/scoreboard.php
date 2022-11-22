<?php

require "init.php";
$level = $_POST["LEVEL"];

$sql = "SELECT member.username,score.endTime FROM score
        INNER JOIN member ON score.userId = member.userId 
        WHERE score.modeAndLevelId ='$level' 
        ORDER BY score.endTime 
        LIMIT 50 ";

//Declare $result to send data from $sql to database ($con).
$res = mysqli_query($con, $sql);

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