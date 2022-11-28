<?php
/* include data from init.php */ 
require "init.php";
$level = $_POST["LEVEL"]; /* declare variable to receive value with string key LEVEL  */

$sql = "SELECT member.username,score.endTime FROM score
        INNER JOIN member ON score.userId = member.userId 
        WHERE score.modeAndLevelId ='$level' 
        ORDER BY score.endTime 
        LIMIT 50 "; /* sql command to query top 50 score and endtime in $level */

/* Declare $res to send data from $sql to database ($con). */
$res = mysqli_query($con, $sql);
/* if doesn't have data */
if (!mysqli_num_rows($res)) {
    echo ("FAILURE"); /* response failure to app */
} 
else 
    {
         /* fetch data as associative array to $row */
         while ($row = mysqli_fetch_assoc($res)) {
        /* collect $row as array $data */
        $data[] = $row;
    }
    echo json_encode($data); /* response as json format to app */
}
mysqli_close($con); /* close connection */
    
?>
