<?php include("conn.php"); 

 
?>
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
                window.location.assign("inner_service.php")
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
//$retval = mysqli_query($conn, $sql);
//if (!$retval) {
//    die('Could not enter data: ' . mysqli_error());
//}
//echo "Entered data successfully\n";
//echo $value3;

?><br/>
<?php echo $value1; ?><br/>
<?php echo $value2; ?><br/>
<section id="container" class="">

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">
               
             <h3 class="page-header"><i class="fa fa-table"></i> Add InnerService</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                    <li><i class="fa fa-table"></i>Add Services</li>
                    <li><i class="fa fa-th-list"></i>Add InnerService</li>
                </ol>
            </div>
        </div>

        <div class="text-right">
            <div class="credits">
            </div>
        </div>
    </section>
    <form class="form-horizontal" action='inner_service.php' method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <fieldset>
                <label class="control-label col-lg-2" for="inputSuccess"><h4>Outer service</h4></label>
                <div class="col-lg-10">
                    <!-- dropdown -->
                    <div class="controls">

                        <select class="form-control input-lg m-bot15" style="width:auto;" name='o_sname'>
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
                </div>
                  </div>        
        <!-- image -->
        <div class="form-group">
                        <label class="control-label col-lg-2" for="exampleInputFile"><h4>Image</h4></label>
                        <div class="col-lg-10">
                        <div class="controls">
                            <input type="file"  name="upload" style="width:auto;"  placeholder="image" value="uploadnow"  id="exampleInputFile"  accept="service_image/" required="required"/>
                                   </div>
                    </div>
                               </div>
                    <!-- inner service name -->
                     <div class="form-group">
                         <label class="control-label col-lg-2" for="inputSuccess" ><h4>Inner service name</h4></label>
                    <div class="col-lg-10">
                    <div class="controls">
                        <input type="text" id="i_sname" name="i_sname" placeholder="" style="width:auto;" class="form-control input-lg m-bot15" required="required">
                        </div>
                    </div>
                </div>
                    <!--service Rate  -->
                     <div class="form-group">
                         <label class="control-label col-lg-2" for="inputSuccess" ><h4>Service Rate</h4></label>
                    <div class="col-lg-10">
                    <div class="controls">
                        <input type="text" id="rate" name="rate" placeholder="" style="width:auto;" class="form-control input-lg m-bot15" required="required">
                        </div>
                    </div>
                </div>
<div class="form-group">
                         <label class="control-label col-lg-2" for="inputSuccess" ><h4>Information</h4></label>
                    <div class="col-lg-10">
                    <div class="controls">
                        <input type="text" id="info" name="info" placeholder="" style="width:auto;" class="form-control input-lg m-bot15" required="required">
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