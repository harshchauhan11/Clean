<?php
include("admin/conn.php");
$time_id = $_POST["time_id"];
$uid = $_POST['uid'];
$wid = $_POST['wid'];
$inner_id = $_POST['inner_id'];
$amount = $_POST['amount'];
$start_date = $_POST['start_date'];

/*
echo $uid . "<br>";
echo $wid . "<br>";
echo $time_id . "<br>";
echo $inner_id . "<br>";
echo $amount . "<br>";
*/
// echo $start_date;


$insert_sql = "INSERT INTO orders (user_id, worker_id, work_time_id, inner_service_id, amount, request_date, status, start_date)"
        . " VALUES ('$uid', '$wid', '$time_id', '$inner_id', '$amount', now(), 'PENDING', '$start_date')";
$result = $conn->query($insert_sql);
if ($conn->affected_rows != 0) {
    
   
    //header("location: summary.php?orderid=".$orders_id);
            
   echo 1;
} else {
    echo 0;
}

?>