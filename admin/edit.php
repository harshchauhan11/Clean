<?php
include('conn.php');
$id = $_REQUEST["time_id"];


if (isset($_POST["submit"])) {
    $time = $_POST['time'];
    $result = $conn->query("select * from  work_time where id = '$id'");
    $row = $result->fetch_object();

    $sql = "SELECT * FROM work_time WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (mysqli_num_rows($result) == 1 ) {

        $update_sql = "update work_time set time='$time' where id = '$id'";
        if ($conn->query($update_sql) === TRUE) {
            echo "Record updated successfully";
            header("location:workingtime.php");
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {

    }
}
?>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <center>
        <form class="form-horizontal" method="POST" action="edit.php" enctype="multipart/form-data">
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
                        <input type='hidden' name='time_id' value='<?php echo $id; ?>'/>
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
    </center>
    </body>
</html>