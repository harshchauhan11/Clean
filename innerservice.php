<?php
//session_start();
require_once('admin/conn.php');
$outer = "";
if (isset($_GET['o']))
    $outer = $_GET['o'];
    if (isset($_GET['i']))
    $outer = $_GET['i'];

  ?>

<!doctype html>
        <?php 
        $page_name="Inner Service";

        $qsql = "SELECT * FROM outer_service where id=" . $outer . ";";
        $qresult = mysqli_query($conn, $qsql);
        if (mysqli_num_rows($qresult) > 0) {
            while ($qrow = mysqli_fetch_assoc($qresult)) {
                $page_name=$qrow['sname'];
            }
        }

        include("mainheader.php"); ?>
        <div class="main">

        <!-- Begin #services-section -->
        <section id="services" class="services-section section-global-wrapper2">
            <div class="container">
                <div class="row">
                    <div class="services-header nomarg">
                    <span><small>Service</small></span>
                    <h1 class="services-header-title2"><?php echo $page_name; ?></h1>
                        <!-- <h3 class="services-header-title">Our Services</h3> -->
                        <!-- <p class="services-header-body"><em> Things we provide in your home </em>  </p><hr> -->
                    </div>
                </div>
                 <div class="row services-row services-row-head services-row-1">
                    <?php
                //echo $outer;
                $sql = "SELECT * FROM inner_service where outerid=" . $outer . ";";
                $result = mysqli_query($conn, $sql);
                //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if (mysqli_num_rows($result) > 0) {
                    //echo "hey";
                    echo "<div class='row services-row services-row-head services-row-1'>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        //while ($row = mysqli_fetch_array($result)) {
                        ?>

                        <!-- Begin Services Row 1 -->

                              
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="services-group services-group2 wow animated fadeInLeft" data-wow-offset="40">
                                <h3 class="services-title innertitle"><?php echo $row['i_sname']; ?></h3>
                                <img src='admin\<?php echo $row['path']; ?>' /><br/>
                                <a class="btn btn-block btn-select" href= "service_booking.php?inner_id=<?php echo $row['id']; ?>">SELECT</a>
                            </div>
                        </div>
                        <?php
                    }
                    
                }
                ?>  
                                 
                <!-- End Serivces Row 1 -->


            </div>      
        </section>
        <!-- End #services-section -->

<?php include("mainfooter.php"); ?>




        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script>
            new WOW().init();
        </script>

