<?php

require "init.php";
$level = $_POST["LEVEL"];
$username = $_POST["USERNAME"];
$a = 0;
$sql = "   
         SELECT S.row_index,S.endTime (SELECT a:=a+1 AS row_index FROM score ORDER BY endtime ,
         member.username,score.endTime FROM score INNER JOIN member ON score.userId = member.userId 
         WHERE score.modeAndLevelId ='$level' ORDER BY score.endTime ) AS S WHERE S.username = '$username'
         ORDER BY S.endTime;";

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