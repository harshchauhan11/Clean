<?php
include("admin/conn.php");
include("timeago.php");
// $time_id = $_POST["time_id"];
// $uid = $_POST['uid'];
$wid = $_GET['wid'];
$date = $_GET['date'];
// $inner_id = $_POST['inner_id'];
// $amount = $_POST['amount'];

/*
echo $uid . "<br>";
echo $wid . "<br>";
echo $time_id . "<br>";
echo $inner_id . "<br>";
echo $amount . "<br>";
*/


$insert_sql = "SELECT *, (SELECT phone FROM signup WHERE id = user_id) AS user_phone, (SELECT address FROM signup WHERE id = user_id) AS user_address, (SELECT name FROM signup WHERE id = user_id) AS user_name, (SELECT time FROM work_time WHERE id = work_time_id) AS work_time, (SELECT i_sname FROM inner_service WHERE id = inner_service_id) AS service FROM orders WHERE worker_id = $wid AND status = 'ACCEPTED' AND DATE(booking_date) = '$date';";
$result = $conn->query($insert_sql);
if (mysqli_num_rows($result) > 0) {
    echo '<div class="row taskTitle">';
    echo '<h3><b>Tasks on ' . time_ago($date) . '</b></h3>';
    echo '</div>';
    while($row = mysqli_fetch_assoc($result)) {
        ?>
                        <div class="row taskRow">
                          <div class="col-md-4 text-left">
                              <big><b><?php echo $row['user_name']; ?></b></big><br/>
                              <?php echo $row['user_address']; ?><br/>
                              <?php echo $row['user_phone']; ?>
                          </div>
                          <div class="col-md-4">
                              Time: <br/><big><b><?php echo $row['work_time']; ?></b></big>
                          </div>
                          <div class="col-md-4">
                              Service: <br/><big><b><?php echo $row['service']; ?></b></big>
                          </div>
                        </div>
                    <!-- <div class="row workerTab">
                        <div class="col-md-2 col-md-offset-1 text-right">
                            <?php echo $row['user_name']; ?>
                        </div>
                        <div class="col-md-4">
                            <?php echo $row['work_time']; ?>
                        </div>
                    </div> -->
        <?php
    }
}
?>