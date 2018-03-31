<?php
//session_start();
include('conn.php');
if(isset($_GET['del_name'])){ $del_name=$_GET['del_name']; 
							mysqli_query($conn,"DELETE FROM worker_timing WHERE worker_id='$del_name'") or die(mysqli_error());} ?>


<!DOCTYPE html>
<html lang="en">



<body>
  <!-- container section start -->
          <?php include("header.php"); ?>
	 <?php include("sidebar.php"); ?>


    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
              
             <h3 class="page-header"><i class="fa fa-table"></i>Workers Timing Table</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-table"></i>Tables</li>
              <li><i class="fa fa-th-list"></i>Workers Timing Table</li>
            </ol>
          </div>
        </div>

   
    </section>
            <!--main content start-->
            <?php
            $sql="select * from worker_timing";
             $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		?>
		
            <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                User Table
              </header>

              <table class="table table-striped table-advance table-hover">
                <tbody>
                    
                  <tr>
                    <th><i class=""></i> Id</th>
                    <th><i class="icon_profile"></i>work_time_id</th>
                    <th><i class="icon_profile"></i>worker_id</th>
                    
                    
                    <!--<th><i class="icon_profile"></i>role</th>-->
                    <!--<th><i class="icon_profile"></i> Service</th>-->
                    <!--<th><i class="icon_profile"></i> Full Name</th>-->
                    <!--<th><i class="icon_mail_alt"></i> Email</th>-->
                    <!--<th><i class="icon_pin_alt"></i> Adress</th>-->
                    <!--<th><i class="icon_mobile"></i> Mobile</th>-->
                    <!--<th><i class="icon_cogs"></i> Password</th>-->
                   
                    
                    
                      <th><i class="icon_cogs"></i> Action</th>
                       
                  </tr>
                  <?php
		while($row = mysqli_fetch_array($result))
		{
                    ?>
                  <tr>
                  <td><?php echo $row['id']; ?></h5></b></td>
                  <td><?php echo $row['work_time_id']; ?></h5></b></td>
                  <td><?php echo $row['worker_id']; ?></h5></b></td>
                   <td align="center"><a href="timed.php?del_name=<?php echo $row['worker_id']; ?>"></a></td>
                                        <td><a href="edit.php?name=<?php // echo $row['outerid']; ?>"></a></td>            
                         <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="#"><i class="icon_plus_alt2"></i></a>
                        <a class="btn btn-danger" href="timed.php?del_name=<?php echo $row['worker_id']; ?>"><i class="icon_close_alt2"></i></a>
                      </div>
                    </td>
                  </tr>
                                      <?php
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

  <!-- javascripts -->
   <?php include("adminfooter.php"); ?>
</body>

</html>
