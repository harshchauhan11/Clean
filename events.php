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


$insert_sql = "SELECT COUNT(*) AS tasks, date(start_date) AS booking_date FROM orders WHERE worker_id = $wid AND status = 'ACCEPTED' GROUP BY DATE(start_date);";
$result = $conn->query($insert_sql);
if (mysqli_num_rows($result) > 0) {
    $list = array();
    while($row = mysqli_fetch_assoc($result)) {
        
        // $d = new DateTime($row['booking_date']);
        // $list[] = array('title' => 'Event #1', 'date' => $d->format('Y-m-d'), 'link' => 'link url');
        $list[] = array('title' => "You have " . $row['tasks'] . " Tasks on " . $row['booking_date'], 'date' => $row['booking_date'], 'link' => 'tasks.php?wid='.$wid.'&date='.$row['booking_date']);
        // echo json_encode(array($arr));
    }
    echo json_encode($list);
}
?>