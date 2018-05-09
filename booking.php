<?php
include("admin/conn.php");
$oid = $_POST["oid"];
$status = $_POST["status"];
// $time_id = $_POST["time_id"];
// $uid = $_POST['uid'];
// $wid = $_POST['wid'];
// $inner_id = $_POST['inner_id'];
// $amount = $_POST['amount'];

/*
echo $uid . "<br>";
echo $wid . "<br>";
echo $time_id . "<br>";
echo $inner_id . "<br>";
echo $amount . "<br>";
*/
// UPDATE order with ACCEPTED / REJECTED.


$update_orders_table = "UPDATE orders SET booking_date = now(), status = '$status' WHERE id = $oid";
$result = $conn->query($update_orders_table);
// if ($conn->affected_rows != 0) {
if($result) {
    $insert_notification = "INSERT INTO requests (reqFrom, reqTo, type, comment, status, date, order_id) SELECT worker_id, user_id, 'request','$status', 'not_seen', now(), id FROM orders WHERE id = $oid";
    $result2 = $conn->query($insert_notification);
    if ($result2)
        echo 1;
} else {
    echo 0;
}
?>