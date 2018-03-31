<?php ob_start(); include("admin/conn.php");?>
<?php 

$page_name="Home of Cleaning";
include("mainheader.php");

?>
    
        <!-- Begin #carousel-section -->
        <section id="carousel-section" class="section-global-wrapper"> 
            <div class="container-fluid-kamn">
                <div class="row">
                    <div id="carousel-1" class="carousel slide" data-ride="carousel">

                        <!-- Indicators -->
                        <ol class="carousel-indicators visible-lg">
                            <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                            <!--<li data-target="#carousel-1" data-slide-to="1"></li>-->
                            <!--<li data-target="#carousel-1" data-slide-to="2"></li>-->
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <!-- Begin Slide 1 -->
                            <div class="item active">
                                <img src="image/1.jpg"   height="400" width="800" alt="Image of first carousel">
                                <div class="carousel-caption">
                                    <!--<h3 class="carousel-title hidden-xs" style="height: 250px;">EASY TO CUSTOMIZE</h3>-->
                                <!--<p class="carousel-body">BEAUTIFUL \ CLEAN \ MINIMAL</p>-->
                            </div>
<!--                                <div class="carousel-caption">
                                    <h3 class="carousel-title hidden-xs">Office BOOTSTRAP TEMPLATE</h3>
                                    <p class="carousel-body">RESPONSIVE \ MULTI PAGE</p>
                                </div>
                            </div>-->
                            <!-- End Slide 1 -->
       <!--Begin Slide 2--> 
<!--                            <div class="item">
                                <img src="image/boy-watering-plants-14764459.jpg" height="400" alt="Image of second carousel">
                                <div class="carousel-caption">
                                    <h3 class="carousel-title hidden-xs"  style="height: 250px;">EASY TO CUSTOMIZE</h3>
                                    <p class="carousel-body">BEAUTIFUL \ CLEAN \ MINIMAL</p>
                                    
                                </div>
                                <div class="carousel-caption">
                                    <h3 class="carousel-title hidden-xs">Office BOOTSTRAP TEMPLATE</h3>
                                    <p class="carousel-body">RESPONSIVE \ MULTI PAGE</p>
                                </div>
                            </div>
                             End Slide 2 -->

<!--                             Begin Slide 3 -->
<!--                            <div class="item">
                                <img src="image/5425467e-8388-4bd2-acd5-3c65c0a8641a (1).jpg" height="400" alt="Image of third carousel">
                                <div class="carousel-caption">
                                    <h3 class="carousel-title hidden-xs">MULTI-PURPOSE TEMPLATE</h3>
                                    <p class="carousel-body">PORTFOLIO \ CORPORATE \ CREATIVE</p>
                                </div>
                            </div>
                             End Slide 3 
                        </div>-->

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-1" data-slide="prev">
<!--                            <span class="glyphicon glyphicon-chevron-left"></span>-->
                        </a>
                        <a class="right carousel-control" href="#carousel-1" data-slide="next">
<!--                            <span class="glyphicon glyphicon-chevron-right"></span>-->
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- End #carousel-section -->


        <!-- Begin #services-section -->
        <section id="services" class="services-section section-global-wrapper">
            <div class="container">
                <div class="row">
                    <div class="services-header">
                        <h1 class="services-header-title">Our Services</h1>
                        <p class="services-header-body">Things we provide in your home</p>
                    </div>
                </div>
                            <div class="row services-row services-row-head services-row-1">

            <?php
                $sql = "select * from outer_service";
                $result = mysqli_query($conn, $sql);
                //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        //while ($row = mysqli_fetch_array($result)) {
                        ?>

                        <!-- Begin Services Row 1 -->
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 " style="margin-bottom: 30px">
                                <div class="services-group wow animated fadeInLeft" data-wow-offset="40">
                                    
                                    <img src='admin/<?php echo $row['path']; ?>' height='210' width='250'/>
                                    <h4 class="services-title"><?php echo $row['sname']; ?></h4>

                                    <p class="services-more"><a href="innerservice.php?o=<?php echo $row['id']; ?>">Find Out More</a></p>
                                    
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
