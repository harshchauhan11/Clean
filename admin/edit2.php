<?php
include('conn.php');
$id = $_POST["time_id"];
$time = $_POST['time'];

//echo "ID = " . $id . ", Time = " . $time;


$update_sql = "UPDATE work_time SET time='$time' WHERE id = '$id'";
$result = $conn->query($update_sql);
if ($conn->affected_rows != 0) {
    echo 1;
} else {
    echo 0;
}
?>