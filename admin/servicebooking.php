<?php include("conn.php"); ?>
<?php include("header.php"); ?>
<?php include("sidebar.php"); ?>

 <?php
 if (isset($_POST["submit"])) {
        $value1 = $_POST['inner_name'];
        $value2 = $_POST['title'];
         
        
        $sql = "INSERT INTO quation(innerid,title) VALUES ( '$value1', '$value2' )";

        if (mysqli_query($conn, $sql)) {
            echo "New record added";
            ?>
            <script>
                {
                    alert("Thank you");

                }
                window.location.assign("servicebooking.php")
            </script>
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
                      <h3 class="page-header"><i class="fa fa-table"></i> Add Questions</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
                         <li><i class="fa fa-table"></i>Add Services</li>
                        <li><i class="fa fa-th-list"></i>Add Questions</li>
                       
                    </ol>
                </div>
            </div>


        <div class="text-right">
            <div class="credits">
            </div>
        </div>
    </section>
    <form class="form-horizontal" action='servicebooking.php' method="POST" enctype="multipart/form-data">
        <div class="form-group">
                <fieldset>
                <label class="control-label col-lg-2" for="inputSuccess"><h4>Inner service</h4></label>
                <div class="col-lg-10">
                    <!-- dropdown -->
                    <div class="controls">

                        <select class="form-control input-lg m-bot15" style="width:auto;" name='inner_name'>
                            <?php
                            
                             $sql = "select * from outer_service";
                            $result = mysqli_query($conn, $sql);
//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    //while ($row = mysqli_fetch_array($result)) {
                                    ?>
                            <optgroup label="<?php echo $row['sname']; ?>">
                                <?php
                                 $sql = "select * from inner_service where outerid=".$row['id'];
                            $result1 = mysqli_query($conn, $sql);
//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            if (mysqli_num_rows($result1) > 0) {
                                while ($row1 = mysqli_fetch_assoc($result1)) {
                                    //while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <option value= "<?php echo $row1['id']; ?>"><?php echo $row1['i_sname']; ?></option>
                                    <?php
                                }
                            }
                                ?>
                               
                            </optgroup>
                                    

                                    <?php
                                }
                            }
                            
                            
                            
                           
                            ?>  
                        </select>


                    </div>
                </div>
                  </div>    
    

 
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
                         <label class="control-label col-lg-2" for="inputSuccess" ><h4>Question</h4></label>
                    <div class="col-lg-10">
                    <div class="controls">
                        <input type="text" id="i_sname" name="title" placeholder="" style="width:auto;" class="form-control input-lg m-bot15" required="required">
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