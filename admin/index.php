<?php
include('conn.php');
//session_start();
if ($_SESSION['islogin'] == NULL) {
header('Location:login.php');}?>
     <?php include("header.php"); ?>
	 <?php include("sidebar.php"); ?>

             
             <?php
//require_once('admin/o_service.php');
error_reporting(0);
if ($_post['submit']) {
    
}
?>
<?php
if (isset($_FILES['upload'])) {
    $errors = array();
    $file_name = $_FILES['upload']['name'];
    $file_size = $_FILES['upload']['size'];
    $file_tmp = $_FILES['upload']['tmp_name'];
    $file_type = $_FILES['upload']['type'];
    //$file_path="service_imge/".$file_name;
    $file_ext = strtolower(end(explode('.', $_FILES['upload']['name'])));
    $file_path = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file_name) . date('mdYhis', time()) . "." . $file_ext;

    //echo strtolower(end(explode('.',$_FILES['upload']['name'])));
    //echo $file_path . ", " . $file_name . "," . $file_size . "," . $file_type;

    $expensions = array("jpeg", "jpg", "png");
    $dir = 'service_image/';

    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, $dir . $file_path);
        echo "Success";
    } else {
        print_r($errors);
    }
} else {
    echo "Image not selected.";
}
//$value1 = $_FILES['upload']['name'];

$value2 = $_POST['o_sname'];
$value3 = $_POST['i_sname'];
$value4 = $dir . $file_path;
$value6 = $_POST['rate'];
$value7 = $_POST['info'];

$sql = "INSERT INTO inner_service (i_sname,path,outerid,rate,info) VALUES ( '$value3', '$value4','$value2' , '$value6' , '$value7'  )";
 if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            ?>
            <script>
                {
                    alert("Thank you for add service");

                }
                window.location.assign("index.php")
            </script>
            <?php
        } else {
            echo "Error: " . $sql . "" . mysqli_error($conn);
            ?>
            <script>
                {
                  //  alert("Sorry, try again.");
                }
                //window.location.assign("index.php")
            </script> 
<?php
        }
    
    ?>
<br/>
<?php echo $value1; ?><br/>
<?php echo $value2; ?><br/>


<!DOCTYPE html>

        <!-- container section start -->
           
        <section id="container" class="">


            <!--main content start-->
            <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
            <ol class="breadcrumb">
<!--                <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>-->
              <li><i class="fa fa-laptop"></i>Dashboard</li>
            </ol>
          </div>
        </div>
        <?php
        $sql = "SELECT count(1) FROM orders";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$total = $row[0];

        ?>
                <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box blue-bg">
              <i class="fa fa-calendar"></i>
              <div class="count"><?php echo " " . $total;  ?></div>
              <div class="title">Order</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

           <?php
        $sql = "SELECT count(1) FROM `signup` WHERE role='user'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$total = $row[0];
 

        ?>
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box brown-bg">
              <i class="fa fa-female"></i>
              <div class="count"><?php echo " " . $total;   ?></div>
              <div class="title">Nuber Of User</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->
 <?php
        $sql = "SELECT count(1) FROM `signup` WHERE role='worker'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$total = $row[0];
 

        ?>
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box dark-bg">
              <i class="fa fa-won"></i>
              <div class="count"><?php echo " " . $total;   ?></div>
              <div class="title">NUMBER OF WORKER</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->
        <?php
        $sql = "SELECT count(1) FROM feedback";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$total = $row[0];

        ?>

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box green-bg">
              <i class="fa fa-thumbs-o-up"></i>
              <div class="count"><?php echo " " . $total;   ?></div>
              <div class="title">FEEDBACK</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

        </div>
        <!--/.row-->

      </section>
                 <div class="row">

          <div class="col-lg-9 col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><i class="fa fa-flag-o red"></i><strong>Registered Users</strong></h2>
                <div class="panel-actions">
                  <a href="index.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                  <a href="index.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="index.html#" class="btn-close"><i class="fa fa-times"></i></a>
                </div>
              </div>
              <div class="panel-body">
                <table class="table bootstrap-datatable countries">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Area</th>
                      <th>Phone</th>
                    </tr>
                  </thead>
                   <?php
                            $sql = "select * from signup WHERE role='user' ORDER BY `name` ASC limit 10";
                            
                            $result = mysqli_query($conn, $sql);
//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    //while ($row = mysqli_fetch_array($result)) {
                                    ?>
                           
                  <tbody>
                    <tr>
                        <td><img src="img/India.png" style="height:18px; margin-top:-2px;"></td>
                      <td><option value= "<?php echo $row['name']; ?>"><?php echo $row['name']; ?></td>
                        <td><option value= "<?php echo $row['email']; ?>"><?php echo $row['email']; ?></td>
                            <td><option value= "<?php echo $row['area']; ?>"><?php echo $row['area']; ?></td>
                                <td><option value= "<?php echo $row['phone']; ?>"><?php echo $row['phone']; ?></td>
                            <?php }} ?>
                      
                    </tr>
                      </tbody>
                </table>
              </div>

            </div>

          </div>

          <div class="col-md-6 portlets">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="pull-left">Quick Add Service</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>
                <div class="clearfix"></div>
              </div>
<div class="panel-body">
                <div class="padd">

                  <div class="form quick-post">
                    <!-- Edit profile form (not working)-->
                    <form class="form-horizontal" action="index.php" method="POST" enctype="multipart/form-data">
                      <!-- Title -->
                      <div class="form-group">
                        <label class="control-label col-lg-2" for="title">Outer Service</label>
                        <select class="form-control" style="width:470px;" name='o_sname'>
                            <?php
                            $sql = "select * from outer_service";
                            $result = mysqli_query($conn, $sql);
//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    //while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <option value= "<?php echo $row['id']; ?>"><?php echo $row['sname']; ?></option>

                                    <?php
                                }
                            }
                            ?>  
                        </select>

                      </div>
                      <!-- Content -->
                      <div class="form-group">
                        <label class="control-label col-lg-2" for="content">Image</label>
                        <div class="col-lg-10">
                              <input type="file"  name="upload" style="width:auto;"  placeholder="image" value="uploadnow"  id="exampleInputFile"  accept="service_image/" required="required"/>
                        </div>
                      </div>
                      <!-- Cateogry -->
                      <div class="form-group">
                        <label class="control-label col-lg-2">Inner service name</label>
                        <div class="col-lg-10">
                          <input type="text" id="i_sname" name="i_sname" placeholder="" style="width:450px;" class="form-control" required="required">
                        </div>
                      </div>
                      <!-- Tags -->
                      <div class="form-group">
                        <label class="control-label col-lg-2" for="tags">Service Rate</label>
                        <div class="col-lg-10">
                           <input type="text" id="rate" name="rate" placeholder="" style="width:450px;" class="form-control" required="required">
                        </div>
                      </div>
                        <div class="form-group">
                        <label class="control-label col-lg-2" for="tags">Information</label>
                        <div class="col-lg-10">
                           <input type="text" id="info" name="info" placeholder="" style="width:450px;" class="form-control" required="required">
                        </div>
                      </div>

                      <!-- Buttons -->
                      <div class="form-group">
                        <!-- Buttons -->
                        <div class="col-lg-offset-2 col-lg-9">
                            <button type="submit" class="btn btn-success" value="submit" name="Publish">Publish</button>
                        </div>
                      </div>
                    </form>
                  </div>


                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                </div>
              </div>
            </div>

          </div>

        </div>                
            </section>
            <!-- container section start -->

            
            <!-- javascripts -->
            <script src="js/jquery.js"></script>
            <script src="js/jquery-ui-1.10.4.min.js"></script>
            <script src="js/jquery-1.8.3.min.js"></script>
            <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
            <!-- bootstrap -->
            <script src="js/bootstrap.min.js"></script>
            <!-- nice scroll -->
            <script src="js/jquery.scrollTo.min.js"></script>
            <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
            <!-- charts scripts -->
            <script src="assets/jquery-knob/js/jquery.knob.js"></script>
            <script src="js/jquery.sparkline.js" type="text/javascript"></script>
            <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
            <script src="js/owl.carousel.js"></script>
            <!-- jQuery full calendar -->
            <<script src="js/fullcalendar.min.js"></script>
            <!-- Full Google Calendar - Calendar -->
            <script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
            <!--script for this page only-->
            <script src="js/calendar-custom.js"></script>
            <script src="js/jquery.rateit.min.js"></script>
            <!-- custom select -->
            <script src="js/jquery.customSelect.min.js"></script>
            <script src="assets/chart-master/Chart.js"></script>

            <!--custome script for all page-->
            <script src="js/scripts.js"></script>
            <!-- custom script for this page-->
            <script src="js/sparkline-chart.js"></script>
            <script src="js/easy-pie-chart.js"></script>
            <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
            <script src="js/jquery-jvectormap-world-mill-en.js"></script>
            <script src="js/xcharts.min.js"></script>
            <script src="js/jquery.autosize.min.js"></script>
            <script src="js/jquery.placeholder.min.js"></script>
            <script src="js/gdp-data.js"></script>
            <script src="js/morris.min.js"></script>
            <script src="js/sparklines.js"></script>
            <script src="js/charts.js"></script>
            <script src="js/jquery.slimscroll.min.js"></script>
            <script>
                //knob
                $(function () {
                    $(".knob").knob({
                        'draw': function () {
                            $(this.i).val(this.cv + '%')
                        }
                    })
                });

                //carousel
                $(document).ready(function () {
                    $("#owl-slider").owlCarousel({
                        navigation: true,
                        slideSpeed: 300,
                        paginationSpeed: 400,
                        singleItem: true

                    });
                });

                //custom select box

                $(function () {
                    $('select.styled').customSelect();
                });

                /* ---------- Map ---------- */
                $(function () {
                    $('#map').vectorMap({
                        map: 'world_mill_en',
                        series: {
                            regions: [{
                                    values: gdpData,
                                    scale: ['#000', '#000'],
                                    normalizeFunction: 'polynomial'
                                }]
                        },
                        backgroundColor: '#eef3f7',
                        onLabelShow: function (e, el, code) {
                            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
                        }
                    });
                });
            </script>

    </body>

</html>
