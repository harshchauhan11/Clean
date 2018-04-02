<?php
include("admin/conn.php");
$uid = $_POST['uid'];
$wid = $_POST['wid'];
$rating = $_POST['rate'];


// echo $uid . "<br>";
// echo $wid . "<br>";
// echo $rating . "<br>";


$insert_sql = "INSERT INTO ratings (user_id, worker_id, rating, time)"
        . " VALUES ($uid, $wid, $rating, now()) ON DUPLICATE KEY UPDATE rating = $rating";
$result = $conn->query($insert_sql);
// echo $result;
if ($result) {
   echo 1;
} else {
    echo 0;
}
?>