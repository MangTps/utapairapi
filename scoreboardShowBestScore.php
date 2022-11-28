<?php
/* include data from init.php */ 
require "init.php";
$level = $_POST["LEVEL"]; /* declare variable to receive value with string key LEVEL  */
$username = $_POST["USERNAME"]; /* declare variable to receive value with string key USERNAME  */

$sql = "SET @row_number = 0;"; /* declare variable and set value to zero */
$sql2 = "SELECT * FROM (SELECT member.username,score.endTime,(@row_number:=@row_number+1) 
As row_index FROM score INNER JOIN member ON score.userId = member.userId 
WHERE score.modeAndLevelId ='$level' ORDER BY score.endTime LIMIT 50) 
As A WHERE A.username ='$username' ORDER BY A.endTime LIMIT 1;"; 
/* if user is on top 50 in $level then pass his best placement data to the app */

/* send $sql to database */ 
mysqli_query($con, $sql);
//Declare $result to send data from $sql2 to database ($con).
$result = mysqli_query($con, $sql2);

/* if doesn't have data */
if (!mysqli_num_rows($result)) {
    echo ("FAILURE"); /* response failure to app */
} 
else 
{   /* fetch data as associative array to $row */
    while ($row = mysqli_fetch_assoc($result)) {
        /* collect $row as array $data */
        $data[] = $row; 
    }
    echo json_encode($data); /* response as json format to app */
}
/* close connection */
mysqli_close($con);
    
?>
