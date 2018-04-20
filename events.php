<?php
include("admin/conn.php");
// $time_id = $_POST["time_id"];
// $uid = $_POST['uid'];
$wid = $_POST['wid'];
// $inner_id = $_POST['inner_id'];
// $amount = $_POST['amount'];

/*
echo $uid . "<br>";
echo $wid . "<br>";
echo $time_id . "<br>";
echo $inner_id . "<br>";
echo $amount . "<br>";
*/


$insert_sql = "SELECT * FROM orders WHERE worker_id = $wid AND status = 'ACCEPTED';";
$result = $conn->query($insert_sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $list = array();
        $d = new DateTime($row['booking_date']);
        // $d->format('Y-m-d')
        $list[] = array('title' => 'Event #1', 'date' => $d->format('Y-m-d'), 'link' => 'link url');
        // echo json_encode(array($arr));
        echo json_encode($list);
    }
}
?>