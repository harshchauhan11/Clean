<?php include("conn.php"); ?>
<?php include("header.php"); ?>
<?php include("sidebar.php"); ?>
 <?php
 if (isset($_POST["submit"])) {
        $value2 = $_POST['time'];
              
        $sql = "INSERT INTO work_time (time) VALUES ( '$value2')";

        if (mysqli_query($conn, $sql)) {
            echo "New record added";
            ?>
<!--            <script>
                {
                    alert("Thank you");

                }
                window.location.assign("working_time.php")
            </script>-->
            <?php
        } else {
            echo "Error: " . $sql . "" . mysqli_error($conn);
            ?>
           
            <?php
        }
    }
    ?>

<section id="container" class="">

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!--overview start-->
             <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                      <h3 class="page-header"><i class="fa fa-table"></i> Add Working Time</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
                         <li><i class="fa fa-table"></i>Add Services</li>
                        <li><i class="fa fa-th-list"></i>Add Working Time</li>
                       
                    </ol>
                </div>
            </div>


        <div class="text-right">
            <div class="credits">
            </div>
        </div>
    </section>
    <form class="form-horizontal" action='working_time.php' method="POST" enctype="multipart/form-data">
              <!-- image -->
<!--        <div class="form-group">
                        <label class="control-label col-lg-2" for="exampleInputFile"><h4>Image</h4></label>
                        <div class="col-lg-10">
                        <div class="controls">
                            <input type="file"  name="upload" style="width:auto;"  placeholder="image" value="uploadnow"  id="exampleInputFile"  accept="service_image/" required="required"/>
                                   </div>
                    </div>
                               </div>-->
                    <div class="form-group">
                         <label class="control-label col-lg-2" for="inputSuccess" ><h4>Time</h4></label>
                    <div class="col-lg-10">
                    <div class="controls">
                        <input type="text" id="time" name="time" placeholder="" style="width:auto;" class="form-control input-lg m-bot15" required="required">
                        </div>
                    </div>
                </div>
                   
                <div class="col-lg-offset-2 col-lg-10">
                    <!-- Button -->
                    <div class="controls">
                        <input type="submit" class="btn btn-success" value="Submit" name="submit" />
                    </div>
                </div>
            </fieldset>
           </form>        <!--main content end-->
</section>
<?php include("adminfooter.php"); ?>