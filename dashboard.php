<?php ob_start();include "admin/conn.php"; include("timeago.php"); ?>
<?php

$page_name = "Dashboard";
if(isset($_SESSION["userdata"])) {
    $sessio_data = $_SESSION["userdata"];
    $uid = $sessio_data['id'];
include "mainheader.php";

?>
<!-- <link href="admin/css/elegant-icons-style.css" rel="stylesheet" /> -->
  <link href="admin/css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles -->
  <!-- <link href="admin/css/style.css" rel="stylesheet"> -->
  <!-- <link href="admin/css/style-responsive.css" rel="stylesheet" /> -->

<div class="container">
    <div class="row">
        <div class="col col-lg-12 middleHeader">
            <div class="col col-lg-4 col-lg-offset-4 col-xs-12 middleHeader">
                <h1 class="text-center">Your Dashboard</h1>
            </div>
            <div class="col-lg-4">
                <div class="profile-widget profile-widget-info">
                    <div class="panel-body">
                        <div class="col-lg-1 col-sm-1 col-centered follow-info notify_icons">
                            <ul>
                                <li class="active text-center">
                                    <div class="btn-group show-on-hover">
                                        <i class="fa fa-comments fa-2x btn btn-default dropdown-toggle" data-toggle="dropdown"> </i> <span class="caret"></span>
                                        <ul class="dropdown-menu text-left" role="menu">
                                        <li><a href="#">Comments</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                        </ul>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <?php
                                $sql = "SELECT *, (SELECT name FROM signup WHERE id = worker_id) AS user_name, (SELECT CASE WHEN gender = 'female' THEN 'Ms.' ELSE 'Mr.' END FROM signup WHERE id = worker_id) AS user_prefix, (SELECT time FROM work_time WHERE id = work_time_id) AS work_time, (SELECT i_sname FROM inner_service WHERE id = inner_service_id) AS service FROM orders WHERE user_id = ".$sessio_data['id']." AND (status = 'REJECTED' OR status = 'ACCEPTED')";
                                $result = mysqli_query($conn, $sql);
                        
                                if (mysqli_num_rows($result) > 0) {
                                ?>
                        <div class="col-lg-1 col-sm-1 follow-info notify_icons redbg">
                            <ul>
                                <li class="active text-center">
                                <div class="btn-group show-on-hover">
                                <?php
                                    echo '<i class="fa fa-bell fa-2x btn btn-default dropdown-toggle" data-toggle="dropdown"> <span>'.mysqli_num_rows($result).'</span></i> <span class="caret"></span>';
                                    echo '<ul class="dropdown-menu text-left" role="menu">';
                                    echo '<li><h5>Notifications</h5></li>';
                                    echo '<li class="divider"></li>';
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <li class="notification-box gray-box2">
                                        <div class="row">
                                            <div class="col-lg-2 col-sm-3 text-center">
                                            <img src="image/home.png" width="40px" class="w-50 rounded-circle">
                                            </div>    
                                            <div class="col-lg-7 col-sm-6 auto-wrap">
                                            <strong class="text-danger">New Service Request</strong>
                                            <div><?php echo $row['user_prefix']; ?> <?php echo $row['user_name']; ?> has <?php echo $row['status']; ?> your request for <?php echo $row['service']; ?> Service at <?php echo $row['work_time']; ?></div>
                                            <small class="text-info"><?php echo time_ago(strtotime( $row['request_date'] )); ?></small>
                                            </div>
                                            <div class="col-lg-3 col-sm-2 text-center">
                                                <!-- <a id="yoid<?php echo $row['id']; ?>" class="btn btn-success btn-sm" href="#">ACCEPT</a>
                                                <a id="noid<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" href="#">REJECT</a> -->
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                    }
                                    echo '</ul>';
                                    ?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <?php
                                } else {
                                echo '<div class="col-lg-1 col-sm-1 follow-info notify_icons">
                                        <ul>
                                            <li class="active text-center">
                                                <div class="btn-group show-on-hover">';
                                echo '<i class="fa fa-bell fa-2x btn btn-default dropdown-toggle" data-toggle="dropdown"> </i> <span class="caret"></span>';
                                echo '</div>
                                            </li>
                                        </ul>
                                    </div>';
                                }
                                ?>
                            
                        <div class="col-lg-1 col-sm-1 follow-info notify_icons">
                            <ul>
                                <li class="active text-center">
                                    <i class="fa fa-tachometer fa-2x"> </i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-lg-12 middleSection"><br/>
            <ul class="list-group">
            <?php
                //$sql = "SELECT o.*,s.* FROM orders o INNER JOIN signup s ON s.id = o.user_id WHERE o.user_id = $uid";
                $sql = "SELECT *, (SELECT i_sname FROM inner_service i WHERE i.id = o.inner_service_id) AS inner_service FROM orders o INNER JOIN signup s ON s.id = o.worker_id INNER JOIN work_time t ON t.id = o.work_time_id WHERE user_id = 96 AND status='ACCEPTED' ORDER BY work_time_id";
                $result = mysqli_query($conn, $sql);
                //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if (mysqli_num_rows($result) > 0) {
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        //while ($row = mysqli_fetch_array($result)) {
                        if($row['gender'] == 'female')
                            $worker_pic = "image/worker_female2.png";
                        if($row['gender'] == 'male')
                            $worker_pic = "image/worker_male.png";
                        ?>
                        <li class="list-group-item row">
                            <div class="col col-lg-12 col-xs-12 daterow">
                                <?php echo date('d F Y', strtotime($row['booking_date'])) .', '. time_ago(strtotime($row['booking_date'])); ?>
                            </div>
                            <div class="col col-lg-1 col-xs-2">
                                <img src="<?php echo $worker_pic; ?>" width="70px" class="worker_pic" />
                            </div>
                            <div class="col col-lg-4 col-xs-10">
                                <?php echo $row['worker_id'] . ' : <b class="worker_name">' . $row['name']; ?></b><br/>
                                <span class="light"><?php echo $row['email'] . '<br/>Service Area: ' . $row['area']; ?></span>
                            </div>
                            <div class="col col-lg-3 col-xs-6 text-center">
                                Service : <b><?php echo $row['inner_service']; ?></b>
                            </div>
                            <div class="col col-lg-4 col-xs-6 text-right">
                                Time : <b><?php echo $row['time']; ?></b>
                            </div>
                        </li>
                        <?php
                    }
                }
            ?>
            </ul>
        </div>
    </div>
</div>

<?php
} else {
    header("Location: index.php");
}
?>