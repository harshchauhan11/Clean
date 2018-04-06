<?php
include("admin/conn.php");
$rid = $_POST["rid"];
$status = $_POST["status"];
/*
echo $uid . "<br>";
echo $wid . "<br>";
echo $time_id . "<br>";
echo $inner_id . "<br>";
echo $amount . "<br>";
*/


$update_requests_table = "UPDATE requests SET status = '$status' WHERE id = $rid";
$result = $conn->query($update_requests_table);

if($result) {
        echo 1;
} else {
    echo 0;
}
?>