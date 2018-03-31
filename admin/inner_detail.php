<?php
//session_start();
include('conn.php');
if(isset($_GET['del_name'])){ $del_name=$_GET['del_name']; 
							mysqli_query($conn,"DELETE FROM inner_service WHERE path='$del_name'") or die(mysqli_error());} ?>

<!DOCTYPE html>
<!-- container section start -->
<section id="container" class="">
    <?php include("header.php"); ?>
    <?php include("sidebar.php"); ?>


    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!--overview start-->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                    <h3 class="page-header"><i class="fa fa-table"></i> InnerService Table</h3>

                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
                        <li><i class="fa fa-laptop"></i>Dashboard</li>
                        <li><i class="fa fa-th-list"></i>InnerService Table</li>
                    </ol>
                </div>
            </div>

            <div class="text-right">
                <div class="credits">

                </div>
            </div>
        </section>
        <!--main content start-->
        <?php
        $sql = "select * from inner_service";
        $result = mysqli_query($conn, $sql);
//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        ?>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        InnerService Table
                    </header>

                    <table class="table table-striped table-advance table-hover">
                        <tbody>

                            <tr>
                                <th><i class="icon_profile"></i> Id</th>
                                <th><i class="icon_image"></i> image</th>
                                <th><i class="icon_document"></i>outer Service Id</th>
                                <th><i class="icon_document"></i>Inner Service name</th>
                                <th><i class=""></i></th>
                                <th><i class=""></i></th>
                                <th><i class="icon_cogs"></i> Action</th>

                            </tr>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    //while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></h5></b></td>
                                        <td><img src='<?php echo $row['path']; ?>' height='100px' width='100px'></td>
                                        <td><?php echo $row['outerid']; ?></h5></b></td>
                                        <td><?php echo $row['i_sname']; ?></h5></b></td>
                                        <td align="center"><a href="inner_detail.php?del_name=<?php echo $row['path']; ?>"></a></td>
                                        <td><a href="edit.php?name=<?php echo $row['outerid']; ?>"></a></td>             
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-primary" href="#"><i class="icon_plus_alt2"></i></a>
                                                <a class="btn btn-danger" href="inner_detail.php?del_name=<?php echo $row['path']; ?>"><i class="icon_close_alt2"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>          

                        </tbody>
                    </table>
                </section>
            </div>
        </div>

        <!--main content end-->
    </section>
    <!-- container section start -->
    <?php include("adminfooter.php"); ?>
