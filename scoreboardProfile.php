<?php
/* include data from init.php */ 
require "init.php";
$level = $_POST["LEVEL"]; /* declare variable to receive value with string key LEVEL  */
$username = $_POST["USERNAME"]; /* declare variable to receive value with string key USERNAME  */
$sql = "SET @row_number = 0;"; /* declare variable and set value to zero */
$sql2 = "SELECT * FROM (SELECT member.username,score.endTime,(@row_number:=@row_number+1) 
AS row_index FROM score INNER JOIN member ON score.userId = member.userId 
WHERE score.modeAndLevelId ='$level' ORDER BY `score`.`endTime` ASC ) AS A 
WHERE A.username ='$username' ORDER BY A.row_index ASC LIMIT 5;";
/*sql command to query best 5 placement in $level of $username */

/* send data from $sql to database ($con). */
mysqli_query($con, $sql);
/* Declare $res to send data from $sql2 to database ($con). */
$res = mysqli_query($con, $sql2);
/* if doesn't have data */
if (!mysqli_num_rows($res)) {
    echo ("FAILURE"); /* response failure to app */
} 
else 
{ /* fetch data as associative array to $row */    
    while ($row = mysqli_fetch_assoc($res)) {
        /* collect $row as array $data */
        $data[] = $row;
    }
    echo json_encode($data); /* response as json format to app */
}
/* close connection */
mysqli_close($con);
    
?>
