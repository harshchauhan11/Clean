<?php
include("admin/conn.php");
$rid = $_POST["rid"];
$uid = $_POST["uid"];
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
    $get_notif = "SELECT COUNT(*) FROM requests WHERE status = 'not_seen' AND reqTo = " . $uid;
    $get_result = $conn->query($get_notif);
    $row = $get_result->fetch_row();
    // echo $row[0];
    
    echo json_encode(array('status' => true, 'count' => $row[0]));
} else {
    echo json_encode(array('status' => false, 'count' => 0));
}
?>