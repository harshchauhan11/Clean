<?php include("conn.php"); ?>
<?php include("header.php"); ?>
<?php include("sidebar.php"); ?>

<?php
//require_once('admin/o_service.php');
error_reporting(0);
if ($_POST['submit']) {

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

    $value2 = $_POST['sname'];
    $value3 = $dir . $file_path;


    //$name = basename($_FILES['upload']['name']);
    //$t_name = ($_FILES['upload'] ['tmp_name']);
    //echo $value1 . "," . $value2 . "," . $name . "," . $t_name . "," . $dir;

    /*
      if (move_uploaded_file($t_name, $dir . $name)) {
      echo 'file uplod successfully....';
      } else {
      echo 'file are not supportd...';
      }
     */


    //$sql = "INSERT INTO outer_service (upload,sname) VALUES ( '$value1', '$value2' )";
    $sql = "INSERT INTO outer_service (sname,path) VALUES ( '$value2', '$value3' )";

    //$retval = mysqli_query($conn, "call imageInsert('$file_name' , '$file_path' , '$file_type')");

     
 if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            ?>
            <script>
                {
                    alert("Thank you for add service");

                }
                window.location.assign("outer_service.php")
            </script>
            <?php
        } else {
            echo "Error: " . $sql . "" . mysqli_error($conn);
            ?>
            <script>
                {
                    alert("Sorry, try again.");
                }
                window.location.assign("index.php")
            </script> 
<?php
        }
    }
    ?>
<!DOCTYPE html>
<section id="container" class="">
    <!-- container section start -->

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!--overview start-->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                      <h3 class="page-header"><i class="fa fa-table"></i> Add OuterService</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
                         <li><i class="fa fa-table"></i>Add Services</li>
                        <li><i class="fa fa-th-list"></i>Add OuterService</li>
                       
                    </ol>
                </div>
            </div>

            <div class="text-right">
                <div class="credits">
                </div>
            </div>
        </section>
            <form  class="form-horizontal" action='outer_service.php' method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <fieldset>
                        <label class="control-label col-lg-2" for="exampleInputFile"><h4>Image</h4></label>
                        <div class="col-lg-10">
                            <div class="controls">
                                <input type="file" style="width:auto;"  name="upload"  placeholder="image" value="uploadnow"  id="exampleInputFile"  accept="service_image/"  required="required"/>
                            </div>
                        </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2" for="inputSuccess"><h4> service name</h4></label>
                    <div class="col-lg-10">
                        <div class="controls">
                            <input type="text" id="name" style="width:auto;" name="sname" placeholder="" class="form-control input-lg m-bot15" required="required">
                        </div>
                    </div>
                </div>


                <div class="col-lg-offset-2 col-lg-10">
                    <!-- Button -->
                    <div class="controls">
                        <input name="submit" type="submit" class="btn btn-success" value="Submit" />
                    </div>
                </div>
                </div>
                </fieldset>         
        

        </form>        <!--main content end-->
    </section>
<?php include("adminfooter.php"); ?>