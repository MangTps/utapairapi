<?php

require "init.php";
$level = $_POST["LEVEL"];
$username = $_POST["USERNAME"];

$sql = "SELECT S.row_index,S.endTime FROM (SELECT ROW_NUMBER() OVER(ORDER BY score.endTime ) AS row_index , 
member.username,score.endTime FROM score INNER JOIN member ON score.userId = member.userId 
WHERE score.modeAndLevelId ='$level' ORDER BY score.endTime) AS S WHERE S.username = '$username'
ORDER BY S.endTime LIMIT 1";

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