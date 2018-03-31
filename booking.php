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


$insert_sql = "UPDATE orders SET booking_date = now(), status = '$status' WHERE id = $oid";
$result = $conn->query($insert_sql);
if ($conn->affected_rows != 0) {
   echo 1;
} else {
    echo 0;
}
?>