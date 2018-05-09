<?php ob_start();include "admin/conn.php";include "timeago.php";?>
<!DOCTYPE html>
<?php

$page_name = "Home of Cleaning";
if (isset($_SESSION["userdata"]) && $_SESSION["userdata"]["role"] == "Worker") {
    // echo $_SESSION["userdata"]["role"];
    $sessio_data = $_SESSION["userdata"];
    // include("mainheader.php");
    ?>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Profile</title>

  <!-- Bootstrap CSS -->
  <link href="admin/css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="admin/css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="admin/css/elegant-icons-style.css" rel="stylesheet" />
  <link href="admin/css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="admin/css/style.css" rel="stylesheet">
  <link href="js/calendar.css" rel="stylesheet">
  <link href="admin/css/style-responsive.css" rel="stylesheet" />
  <link href="js/fontawesome-stars-o.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
  <script src="js/jquery.barrating.min.js" type="text/javascript"></script>
  <!-- <script src="js/jquery-calendar.min.js"></script> -->
  <link rel="stylesheet" href="js/mini-event-calendar.css">
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous">
</script> -->
<script src="js/mini-event-calendar.js"></script>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
  <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->

    <!-- =======================================================
      Theme Name: NiceAdmin
      Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
      Author: BootstrapMade
      Author URL: https://bootstrapmade.com
    ======================================================= -->




    <!--main content start-->
    <section id="main-content" style="margin-right: 200px;">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <!--<h3 class="page-header"><i class="fa fa-user-md"></i> Profile</h3>-->


                    <ul class="nav navbar-nav pull-right">
                        <?php
if (isset($sessio_data["id"]) || isset($sessio_data['name']) || isset($sessio_data['email'])) {
        ?>
                            <li>
                                <a href="#">Welcome, <?php echo $sessio_data['name']; ?></a>
                            </li>
                            <li class="<?php setActiveClassMenu('logout.php');?>">
                                <a href="logout.php">Logout</a>
                            </li>
                            <?php
} else {
        ?>
                            <li class="<?php setActiveClassMenu('signup.php');?>">
                                <a href="signup.php">Signup</a>
                            </li>
                            <li class="<?php setActiveClassMenu('login.php');?>" >
                                <a href="login.php">Login</a>
                            </li>
                            <?php
}
    ?>
                    </ul>
                </div>
          </div>
        </div>

          <div class="row">
          <!-- profile-widget -->
          <div class="col-lg-12">
            <div class="profile-widget profile-widget-info">
              <div class="panel-body">
                  <div class="col-lg-2 col-sm-2">
                  <h4><?php echo $sessio_data['name']; ?></h4>
                  <div class="follow-ava">
                        <i class="fa fa-child fa-5x"></i>
                    <!--<img src="" alt="">-->
                  </div>
                  <h6>Worker</h6>
                </div>
                <div class="col-lg-7 col-xs-12 follow-info">
                  <h2 style="text-transform: capitalize">Hello, <b><?php echo $sessio_data['name']; ?></b> !</h2>
                  <p><?php echo $sessio_data['email']; ?></p>
                  <?php
$rating = "SELECT COALESCE(AVG(rating),0) AS rating FROM ratings WHERE worker_id = " . $sessio_data['id'];
    $rating_result = mysqli_query($conn, $rating);
    ?>
                  <input type="hidden" id="rate" name="rate" value="" />
                  <select class="rating" data-id="rate<?php echo $sessio_data['id']; ?>">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select><br/>
                            <?php
if (mysqli_num_rows($rating_result) > 0) {
        while ($rating_row = mysqli_fetch_assoc($rating_result)) {
            // echo json_encode($sessio_data['id'], JSON_HEX_TAG);
            // echo json_encode($rating_row['rating'], JSON_HEX_TAG);

            ?>

                                        <script type="text/javascript">
                                        {
                                            $(document).ready(function() {
                                                // alert(2);
                                                var $el = 0
                                                $rate = 0;
                                                $el = <?php echo json_encode($sessio_data['id'], JSON_HEX_TAG); ?>;
                                                $rate = <?php echo $rating_row['rating']; ?>;
                                                $("#rate").val($rate);
                                                // alert($rate);
                                                $("select[data-id*="+$el+"]").barrating('set', $rate);
                                                $("select[data-id*="+$el+"]").parent().find(".br-widget").attr("role", $rate);
                                            });
                                        }
                                        </script>
                                <?php
}
    }
    ?>
<!--                 <p><i class="fa fa-twitter">jenifertweet</i></p>-->
                  <h6>
                      <span><i class="icon_clock_alt"></i><?php echo date("h:i:sa"); ?></span>
                                    <span><i class="icon_calendar"></i><?php
echo date("Y/m/d") . "<br>";
    ?></span>
                                    <!--<span><i class="icon_pin_alt"></i>NY</span>-->
                                </h6>
                </div>
              
                <?php
$sql = "SELECT *, (SELECT name FROM signup WHERE id = user_id) AS user_name, (SELECT CASE WHEN gender = 'female' THEN 'Ms.' ELSE 'Mr.' END FROM signup WHERE id = user_id) AS user_prefix, (SELECT time FROM work_time WHERE id = work_time_id) AS work_time, (SELECT i_sname FROM inner_service WHERE id = inner_service_id) AS service FROM orders WHERE worker_id = " . $sessio_data['id'] . " AND status = 'PENDING'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        ?>
                <div class="col-lg-1 col-sm-1 follow-info notify_icons redbg">
                  <ul>
                    <li class="active text-center">
                      <div class="btn-group show-on-hover">
                      <?php
echo '<i class="fa fa-bell fa-2x btn btn-default dropdown-toggle" data-toggle="dropdown"> <span>' . mysqli_num_rows($result) . '</span></i> <span class="caret"></span>';
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
                                  <div><?php /*echo $row['user_prefix'];*/?> <?php echo $row['user_name']; ?> has requested you for <?php echo $row['service']; ?> Service for <br/>Date : <b><?php echo date_format(date_create($row['start_date']), "j M, Y"); ?></b> at <br/>Time : <b><?php echo $row['work_time']; ?></b></div>
                                  <small class="text-info"><?php echo time_ago($row['request_date']); ?></small>
                                </div>
                                <div class="col-lg-3 col-sm-2 text-center">
                                  <a id="yoid<?php echo $row['id']; ?>" class="btn btn-success btn-sm" href="#">ACCEPT</a>
                                  <a id="noid<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" href="#">REJECT</a>
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
                      <ul class="dropdown-menu text-left" role="menu">
                          <li><h5>Work Calendar</h5></li>
                          <li class="divider"></li>
                          <li class="notification-box">
                              <div class="row">
                                <div class="col-lg-12 col-sm-12 text-center">
                                  <div id="calendar"></div>
                                </div>
                              </div>
                          </li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- page start-->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading tab-bg-info">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a data-toggle="tab" href="#recent-activity">
                      <i class="fa fa-home fa-1x"></i>Daily Activity
                    </a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#profile">
                      <i class="fa fa-user fa-1x"></i>Profile
                    </a>
                  </li>
                  <li class="">
                    <a data-toggle="tab" href="#edit-profile">
                      <i class="fa fa-envelope fa-1x"></i>Edit Profile
                    </a>
                  </li>
                </ul>
              </header>
              <div class="panel-body">
                <div class="tab-content">
                  <div id="recent-activity" class="tab-pane active">
                    <div id="calendar"></div>
                    <div class="profile-activity">
                      <div id="tasks" class="text-center">
                        <!-- <div class="row taskTitle">
                          <h3><b>Tasks on <?php echo time_ago('2018-03-23'); ?></b></h3>
                        </div>
                        <div class="row taskRow">
                          <div class="col-md-4 text-left">
                              <big><b>Harshida</b></big><br/>
                              Ahmedabad<br/>
                              9090909090
                          </div>
                          <div class="col-md-4">
                              Time: <br/><big><b>8 to 9 AM</b></big>
                          </div>
                          <div class="col-md-4">
                              Service: <br/><big><b>Deep Cleaning</b></big>
                          </div>
                        </div> -->
                      </div>
                    <?php
$sql = "SELECT *, (SELECT phone FROM signup WHERE id = user_id) AS user_phone, (SELECT address FROM signup WHERE id = user_id) AS user_address, (SELECT name FROM signup WHERE id = user_id) AS user_name, (SELECT CASE WHEN gender = 'female' THEN 'Ms.' ELSE 'Mr.' END FROM signup WHERE id = user_id) AS user_prefix, (SELECT time FROM work_time WHERE id = work_time_id) AS work_time, (SELECT i_sname FROM inner_service WHERE id = inner_service_id) AS service FROM orders WHERE worker_id = " . $sessio_data['id'] . " AND status = 'ACCEPTED' ORDER BY work_time_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
                      <div class="act-time card">
                        Service: <?php echo $row['service']; ?><br/>
                        Customer: <?php /*echo $row['user_prefix'];*/?> <?php echo $row['user_name']; ?><br/>
                        Address: <?php echo $row['user_address']; ?><br/>
                        Phone: <?php echo $row['user_phone']; ?><br/><br/>
                        Timing: <?php echo $row['work_time']; ?>
                      </div>
                      <?php
}
    }
    ?>
                    </div>
                  </div>
                  <!-- profile -->
                  <div id="profile" class="tab-pane">
                    <section class="panel">

                      <div class="panel-body bio-graph-info">
                        <h1>Bio Graph</h1>
                        <div class="row">
                          <div class="bio-row">
                            <p><span> Name </span>: <?php echo $sessio_data['name']; ?> </p>
                          </div>
                          <div class="bio-row">
                            <p><span>Occupation </span>: UI Designer</p>
                          </div>
                          <div class="bio-row">
                            <p><span>Email </span>:<?php echo $sessio_data['email']; ?></p>
                          </div>
                          <div class="bio-row">
                            <p><span>Mobile </span>:  <?php
echo $sessio_data['phone']; ?></p>
                          </div>
                          <div class="bio-row">
                            <p><span>Qualification </span>:<?php echo $sessio_data['que']; ?></p>
                          </div>
                            <div class="bio-row">
                            <p><span>Age </span>:<?php echo $sessio_data['age']; ?></p>
                          </div>
                            <div class="bio-row">
                            <p><span>Address </span>:<?php echo $sessio_data['address']; ?></p>
                          </div>

                        </div>
                      </div>
                    </section>
                    <section>
                      <div class="row">
                      </div>
                    </section>
                  </div>
                  <!-- edit-profile -->
                  <div id="edit-profile" class="tab-pane">
                    <section class="panel">
                      <div class="panel-body bio-graph-info">
                        <h1> Profile Info</h1>
                        <form class="form-horizontal" role="form">
                          <div class="form-group">
                            <label class="col-lg-2 control-label">First Name</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="f-name" placeholder=" ">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Last Name</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="l-name" placeholder=" ">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">About Me</label>
                            <div class="col-lg-10">
                              <textarea name="" id="" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Country</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="c-name" placeholder=" ">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Birthday</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="b-day" placeholder=" ">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Occupation</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="occupation" placeholder=" ">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="email" placeholder=" ">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Mobile</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="mobile" placeholder=" ">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Website URL</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="url" placeholder="http://www.demowebsite.com ">
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                              <button type="submit" class="btn btn-primary">Save</button>
                              <button type="button" class="btn btn-danger">Cancel</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>

        <!-- page end-->
      </section>
    </section>
    <!--main content end-->
    <div class="text-right">
      <div class="credits">
          <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
          -->
<!--         // <a href="https://bootstrapmade.com/">Free Bootstrap Templates</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>-->
    </div>
  </section>
  <!-- container section end -->
  <!-- javascripts -->
  <!-- <script src="admin/js/jquery.js"></script> -->
  <script src="admin/js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="admin/js/jquery.scrollTo.min.js"></script>
  <script src="admin/js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- jquery knob -->
  <!-- <script src="admin/ssets/jquery-knob/js/jquery.knob.js"></script> -->
  <!--custome script for all page-->
  <script src="admin/js/scripts.js"></script>

  <script>
    //knob
    // $(".knob").knob();
  </script>
<script>
    var $events = [];
    $(document).ready(function() {
      var $wid = <?php echo $sessio_data['id']; ?>;
      // alert(new Date().toISOString().substr(0,10));
      var currentTime = new Date();
      var currentOffset = currentTime.getTimezoneOffset();
      var ISTOffset = 330;
      var ISTTime = new Date(currentTime.getTime() + (ISTOffset + currentOffset)*60000);
      var date = ISTTime.getDate(),
          month = ((ISTTime.getMonth().length+1) === 1) ? (ISTTime.getMonth()+1) : '0' + (ISTTime.getMonth()+1),
          year = ISTTime.getFullYear();
      var todayDate = (year + "-" + month + "-" + date);

      $.get("tasks.php", {wid: $wid, date: todayDate}, function(result) {
        $("#tasks").html(result.trim());
      });


      $('a#calLink').click(function(e) {
        e.preventDefault();
        // alert($(this).attr("href"));
      });

      // var $date = moment('2018-03-01 00:00:00', 'YYYY-MM-DD hh:mm:ss').unix();
      // alert(new Date('2018.03.01').getTime() / 1000);
      $.post("events.php", {wid: $wid}, function(result) {
        // let $events = result.trim();
        populateCalendar(result.trim());
      });
      // alert($events);

      var populateCalendar = function($events) {
        var events = JSON.parse($events);
        //   var events = [
        //   {
        //     "title": "Event Title 1",
        //     "date": new Date('2018-04-21'),
        //     "link": "jqueryscript.net"
        //   },
        //   {
        //     "title": "Event Title 2",
        //     "date": 1519852600000,
        //     "link": "jqueryscript.net"
        //   }
        // ];
        // alert(events);
        $('#calendar').MEC({
          events: events,
          color: 'blue'
        });
      }

      

      var $r = $("#rate").val();
      $('.rating').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: $r,
        readonly: true
    });
        $("[id*=oid").click(function(e) {
            $element = $(this).attr("id");
            // alert("oid = " + $element.replace("yoid",""));
            // alert($element);
            var $oid = $(this).attr("id").indexOf("y")>=0?$(this).attr("id").replace("yoid",""):$(this).attr("id").replace("noid","");
            var $status = $(this).attr("id").indexOf("y")>=0?'ACCEPTED':'REJECTED';
            // alert($status);
            // alert($oid);

            $.post("booking.php", {oid: $oid, status: $status}, function(result) {

                if(result.trim() == 1) {
                  // alert("result = "+result);
                  // alert($element);
                    // SUCCESS
                    // $(this).attr("id").indexOf("y")>=0?alert("You successfully accepted Service Request !"):alert("You has rejected Service Request !");
                    if($element.indexOf("y")>=0)
                      alert("You successfully accepted Service Request !")
                    else
                      alert("You has rejected Service Request !")
                    location.reload();
                } else if(result.trim() == 0) {
                    // FAILURE
                    alert("Something went wrong ! Service has not been booked !");
                    location.reload();
                }
            });
        });
    })
</script>

</body>

</html>

<?php
} else {
    header("Location: index.php");
}
?>