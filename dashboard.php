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
  <link href="js/fontawesome-stars-o.css" rel="stylesheet">
  <script src="js/jquery.barrating.min.js"></script>
  <script type="text/javascript">
//    $(function() {
    $(document).ready(function() {
        if($(".note_count").html() == "")
            $(".note_count").hide();
        // $(".note_count").slideUp();
        // $(".note_count").html("2");
        $(".notification-box").hover(function(e) {
            $element = $(this);
            // alert($(this).data("state"));
            if($(this).data("state") == "ns") {
                // alert($element.attr("class"));
                var $rid = $(this).data("id"),
                    $uid = <?php echo $uid; ?>,
                    $state = 'seen';
                $.post("notifications.php", {rid: $rid, uid: $uid, status: $state}, function(result) {
                    var data = jQuery.parseJSON( result );
                    // alert("result = "+result);
                    // alert("result = "+data.status);
                    // alert("result = "+result.count);
                    if(data.status) {
                        $element.removeClass("gray-box").addClass("white-box");
                        if(data.count > 0) {
                            $(".note_count").html(data.count);
                            // $(".note_count").slideUp();
                        } else if(data.count == 0) {
                            $(".note_count").slideUp();
                        }
                    }
                });
            } else {
                // alert("s");
            }
        });

      $('.rating').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: -1,
        onSelect: function(value, text, event) {
            var el = this,
                el_id = el.$elem.attr('data-id').replace("rate",""),
                $uid = <?php echo $uid ?>;
            // alert(el.$elem.attr);
            // alert(value);
            if (typeof(event) !== 'undefined') {
                
                $.post("ratings.php", {uid: $uid, wid: el_id, rate: value}, function(result) {
                    // alert("result = "+result);
                    if(result.trim() == 1) {
                        // SUCCESS
                        // $(this).attr("id").indexOf("y")>=0?alert("You successfully accepted Service Request !"):alert("You has rejected Service Request !");
                        location.reload();
                    } else if(result.trim() == 0) {
                        // FAILURE
                        // alert("Something went wrong ! Service has not been booked !");
                        location.reload();
                    }
                });
            }
        }
      });
      function rateIt(el, rating) {
        // alert(el + ', ' + rating);
    // alert($("select[data-id*="+el+"]").attr("data-id"));
    // $("select[data-id*="+el+"]").barrating('set', 4);
  };
    //   $('.rating').barrating('set', 4);
   });
   
  </script>
  <!-- Custom styles -->
  <!-- <link href="admin/css/style.css" rel="stylesheet"> -->
  <!-- <link href="admin/css/style-responsive.css" rel="stylesheet" /> -->

<div class="container">
    <div class="row middleHeader">
        <div class="col col-lg-12">
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
                                        <i class="fa fa-comments fa-2x" data-toggle="dropdown"> </i> <span class="caret"></span>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <?php
                                // $sql = "SELECT *, (SELECT name FROM signup WHERE id = worker_id) AS user_name, (SELECT CASE WHEN gender = 'female' THEN 'Ms.' ELSE 'Mr.' END FROM signup WHERE id = worker_id) AS user_prefix, (SELECT time FROM work_time WHERE id = work_time_id) AS work_time, (SELECT i_sname FROM inner_service WHERE id = inner_service_id) AS service FROM orders WHERE user_id = ".$sessio_data['id']." AND (status = 'REJECTED' OR status = 'ACCEPTED') ORDER BY booking_date DESC";
                                $sql = "SELECT r.*, (SELECT name FROM signup WHERE id = worker_id) AS user_name, (SELECT CASE WHEN gender = 'female' THEN 'Ms.' ELSE 'Mr.' END FROM signup WHERE id = worker_id) AS user_prefix, (SELECT time FROM work_time WHERE id = work_time_id) AS work_time, (SELECT i_sname FROM inner_service WHERE id = inner_service_id) AS service, inner_service_id, booking_date, start_date, o.status AS order_status FROM requests r INNER JOIN orders o ON o.id = r.order_id WHERE r.reqTo = ".$sessio_data['id']." AND (o.status = 'REJECTED' OR o.status = 'ACCEPTED') ORDER BY start_date DESC";
                                $result = mysqli_query($conn, $sql);
                                // echo $notif_result;
                                
                                if (mysqli_num_rows($result) > 0) {
                                ?>
                        <div class="col-lg-1 col-sm-1 follow-info notify_icons redbg">
                            <ul>
                                <li class="active text-center">
                                <div class="btn-group show-on-hover">
                                <?php
                                    $notif = "SELECT * FROM requests WHERE status = 'not_seen' AND reqTo = ".$sessio_data['id'];
                                    // $notif = "SELECT * FROM requests";
                                    // echo $notif;
                                    $notif_result = mysqli_query($conn, $notif);
                                    // echo mysqli_num_rows($notif_result);
                                    // if(mysqli_num_rows($notif_result) > 0) {
                                    //     echo 'hey';
                                    //     while($notif_row = mysqli_fetch_assoc($notif_result)) {
                                    //         echo $notif_row['id'];
                                    //     }
                                    // }

                                    echo '<i class="fa fa-bell fa-2x btn btn-default dropdown-toggle" data-toggle="dropdown"> ';
                                    echo '<span class="note_count">';
                                    if(mysqli_num_rows($notif_result) > 0)
                                        echo mysqli_num_rows($notif_result);
                                    echo '</span>';
                                    
                                    echo '</i> <span class="caret"></span>';
                                    echo '<ul class="dropdown-menu text-left" role="menu">';
                                    echo '<li><h5>Notifications</h5></li>';
                                    echo '<li class="divider"></li>';
                                    echo '<div class="note-container">';
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    
                                    <li class="notification-box <?php if($row['status'] == "not_seen") echo "gray-box"; else echo "white-box"; ?>" data-state="<?php if($row['status'] == "not_seen") echo "ns"; else echo "s"; ?>" data-id="<?php echo $row['id']; ?>">
                                        <div class="row">
                                            <div class="col-lg-2 col-sm-3 text-center">
                                            <img src="image/home.png" width="40px" class="w-50 rounded-circle">
                                            </div>    
                                            <div class="col-lg-7 col-sm-6 auto-wrap">
                                            <!-- <strong class="text-danger">New Service Request</strong> -->
                                            <div><?php echo $row['user_prefix']; ?> <?php echo $row['user_name']; ?> has <?php echo $row['order_status']; ?> your request for <?php echo $row['service']; ?> Service booked for <br/>Date : <b><?php echo date_format(date_create($row['start_date']), "j M, Y"); ?></b> at <br/>Time : <b><?php echo $row['work_time']; ?></b></div>
                                            <small class="text-info"><?php echo time_ago($row['booking_date'] ); ?></small>
                                            </div>
                                            <div class="col-lg-3 col-sm-2 text-center">
                                                <?php if($row['order_status'] == "REJECTED") { ?>
                                                    <a class="btn btn-success btn-sm" href="service_booking.php?inner_id=<?php echo $row['inner_service_id']; ?>">BOOK AGAIN</a>
                                                <?php } ?>
                                                <!-- <a id="noid<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" href="#">REJECT</a> -->
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                    }
                                    echo '</div>';
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
            <?php
                //$sql = "SELECT o.*,s.* FROM orders o INNER JOIN signup s ON s.id = o.user_id WHERE o.user_id = $uid";
                $sql = "SELECT *, (SELECT i_sname FROM inner_service i WHERE i.id = o.inner_service_id) AS inner_service FROM orders o INNER JOIN signup s ON s.id = o.worker_id INNER JOIN work_time t ON t.id = o.work_time_id WHERE user_id = ".$sessio_data['id']." AND status='PENDING' ORDER BY request_date DESC";
                $result = mysqli_query($conn, $sql);
                
                echo '<ul class="list-group">';
                //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if (mysqli_num_rows($result) > 0) {
                    echo '<h3 class="dash_title">Your Service Requests</h3>';
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        if($row['gender'] == 'female')
                            $worker_pic = "image/worker_female2.png";
                        if($row['gender'] == 'male')
                            $worker_pic = "image/worker_male.png";

                        $rating = "SELECT AVG(rating) AS rating FROM ratings WHERE worker_id = " . $row['worker_id'];
                        $rating_result = mysqli_query($conn, $rating);
                        // echo '<li class="list-group-item row">';
                        //     echo '<div class="col col-lg-12 col-xs-12 text-center">';
                        //         echo '<h2>You don\'t have<br/>any service<br/>booked<br/>yet.</h2>';
                        //         echo '<a class="btn btn-primary nomarg btn-lg" href="index.php#services">BOOK YOUR SERVICE</a><br/><br/>';
                        //     echo '</div>';
                        // echo '</li>';
                        ?>
                        <li class="list-group-item row">
                            <div class="col col-lg-12 col-xs-12 daterow <?php echo $i==0?'daterow-round':''; ?>">
                                <?php echo 'Request Sent : ' . /*date('d F Y', strtotime($row['booking_date'])) .', '. */time_ago($row['request_date']); ?>
                            </div>
                            <div class="col col-lg-1 col-xs-2">
                                <img src="<?php echo $worker_pic; ?>" width="70px" class="worker_pic" />
                            </div>
                            <div class="col col-lg-4 col-xs-10">
                                <?php echo $row['worker_id'] . ' : <b class="worker_name">' . $row['name']; ?></b><br/>
                                <span class="light"><?php echo $row['email']; ?><br/>
                                <select class="rating" data-id="rate<?php echo $row['worker_id']; ?>">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                <?php 
                                if (mysqli_num_rows($rating_result) > 0) {
                                    while($rating_row = mysqli_fetch_assoc($rating_result)) {
                                        // echo json_encode($row['worker_id'], JSON_HEX_TAG);
                                        // echo json_encode($rating_row['rating'], JSON_HEX_TAG);

                                ?>
                                        
                                        <script type="text/javascript">
                                        {
                                            
                                            // alert($el + "," + $rate);
                                            $(document).ready(function() {
                                                // alert(2);
                                                var $el = 0
                                                $rate = 0;
                                                $el = <?php echo json_encode($row['worker_id'], JSON_HEX_TAG); ?>;
                                                $rate = <?php echo $rating_row['rating']; ?>;
                                                $("select[data-id*="+$el+"]").barrating('set', $rate);
                                                $("select[data-id*="+$el+"]").barrating('readonly', true);
                                            });
                                            // $("select[data-id*="+$el+"]").barrating({
                                            //     theme: 'fontawesome-stars-o',
                                            //     initialRating: $rate
                                            // });
                                            // $("select[data-id*="+$el+"]").barrating('set', $rate);
                                            // $('.rating').barrating('set', 4);
                                            // rateIt($el, $rate);
                                            
                                        }
                                        </script>
                                <?php
                                    }
                                }
                                ?>
                                
                                
                                Service Area: <?php echo $row['area']; ?></span>
                            </div>
                            <div class="col col-lg-3 col-xs-6 text-right">
                                Service : <b><?php echo '<a href="service_booking.php?inner_id='.$row['inner_service_id'].'">' . $row['inner_service'] . "</a>"; ?></b><br/>
                                Time : <b><?php echo $row['time']; ?></b>
                            </div>
                            <div class="col col-lg-4 col-xs-6 text-right">
                                STATUS<br/><big class="red"><b>PENDING</b></big>
                            </div>
                        </li>
                        <?php
                    }
                    echo '<br/>';
                }

                //$sql = "SELECT o.*,s.* FROM orders o INNER JOIN signup s ON s.id = o.user_id WHERE o.user_id = $uid";
                $sql = "SELECT *, (SELECT i_sname FROM inner_service i WHERE i.id = o.inner_service_id) AS inner_service FROM orders o INNER JOIN signup s ON s.id = o.worker_id INNER JOIN work_time t ON t.id = o.work_time_id WHERE user_id = ".$sessio_data['id']." AND status='ACCEPTED' ORDER BY start_date DESC";
                $result = mysqli_query($conn, $sql);
                
                echo '<ul class="list-group">';
                //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if (mysqli_num_rows($result) > 0) {
                    echo '<h3 class="dash_title">Your Booked Services</h3>';
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        //while ($row = mysqli_fetch_array($result)) {
                        if($row['gender'] == 'female')
                            $worker_pic = "image/worker_female2.png";
                        if($row['gender'] == 'male')
                            $worker_pic = "image/worker_male.png";

                        $rating = "SELECT AVG(rating) AS rating FROM ratings WHERE worker_id = " . $row['worker_id'];
                        $rating_result = mysqli_query($conn, $rating);
                        
                        ?>
                        <li class="list-group-item row">
                            <div class="col col-lg-12 col-xs-12 daterow <?php echo $i==0?'daterow-round':''; ?>">
                                <?php echo 'Booking Date : ' . /*date('d F Y', strtotime($row['booking_date'])) .', '. */time_ago($row['start_date']); ?>
                            </div>
                            <div class="col col-lg-1 col-xs-2">
                                <img src="<?php echo $worker_pic; ?>" width="70px" class="worker_pic" />
                            </div>
                            <div class="col col-lg-4 col-xs-10">
                                <?php echo $row['worker_id'] . ' : <b class="worker_name">' . $row['name']; ?></b><br/>
                                <span class="light"><?php echo $row['email']; ?><br/>
                                <select class="rating" data-id="rate<?php echo $row['worker_id']; ?>">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                <?php 
                                if (mysqli_num_rows($rating_result) > 0) {
                                    while($rating_row = mysqli_fetch_assoc($rating_result)) {
                                        // echo json_encode($row['worker_id'], JSON_HEX_TAG);
                                        // echo json_encode($rating_row['rating'], JSON_HEX_TAG);

                                ?>
                                        
                                        <script type="text/javascript">
                                        {
                                            
                                            // alert($el + "," + $rate);
                                            $(document).ready(function() {
                                                // alert(2);
                                                var $el = 0
                                                $rate = 0;
                                                $el = <?php echo json_encode($row['worker_id'], JSON_HEX_TAG); ?>;
                                                $rate = <?php echo $rating_row['rating']; ?>;
                                                $("select[data-id*="+$el+"]").barrating('set', $rate);
                                            });
                                            // $("select[data-id*="+$el+"]").barrating({
                                            //     theme: 'fontawesome-stars-o',
                                            //     initialRating: $rate
                                            // });
                                            // $("select[data-id*="+$el+"]").barrating('set', $rate);
                                            // $('.rating').barrating('set', 4);
                                            // rateIt($el, $rate);
                                            
                                        }
                                        </script>
                                <?php
                                    }
                                }
                                ?>
                                
                                
                                Service Area: <?php echo $row['area']; ?></span>
                            </div>
                            <div class="col col-lg-3 col-xs-6 text-center">
                                Service<br/><b><?php echo '<a href="service_booking.php?inner_id='.$row['inner_service_id'].'">' . $row['inner_service'] . "</a>"; ?></b>
                            </div>
                            <div class="col col-lg-4 col-xs-6 text-right">
                                Time<br/><b><?php echo $row['time']; ?></b>
                            </div>
                        </li>
                        <?php
                        $i = $i + 1;
                    }
                } else {
                    echo '<li class="list-group-item row">';
                    echo '<div class="col col-lg-4 col-xs-4 leftPic"></div>';
                    echo '<div class="col col-lg-4 col-xs-4 text-center">';
                    echo '<h2>You don\'t have<br/>any service<br/>booked<br/>yet.</h2>';
                    echo '<a class="btn btn-primary nomarg btn-lg" href="index.php#services">BOOK YOUR SERVICE</a><br/><br/>';
                    echo '</div>';
                    echo '<div class="col col-lg-4 col-xs-4 rightPic"></div>';
                    echo '</li>';
                }
                echo "</ul>";
            ?>
            
        </div>
    </div>
</div>
<script>
    
    $(document).ready(function() {
        
    })
</script>

<?php
} else {
    header("Location: index.php");
}
?>