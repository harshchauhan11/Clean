<?php
//session_start();
include('conn.php');
if(isset($_GET['del_name'])){ $del_name=$_GET['del_name']; 
							mysqli_query($conn,"DELETE FROM work_time WHERE time='$del_name'") or die(mysqli_error());} ?>


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
              
             <h3 class="page-header"><i class="fa fa-table"></i> Display Time</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-table"></i>Tables</li>
              <li><i class="fa fa-th-list"></i>Display Time</li>
            </ol>
          </div>
        </div>

   
    </section>
            <!--main content start-->
            <?php
            $sql="select * from work_time";
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
                    <th><i class="icon_profile"></i> Time</th>
                    <!--<th><i class="icon_profile"></i>role</th>-->
                    <!--<th><i class="icon_profile"></i> Service</th>-->
                    <!--<th><i class="icon_profile"></i> Full Name</th>-->
                    <!--<th><i class="icon_mail_alt"></i> Email</th>-->
                    <!--<th><i class="icon_pin_alt"></i> Adress</th>-->
                    <!--<th><i class="icon_mobile"></i> Mobile</th>-->
                    <!--<th><i class="icon_cogs"></i> Password</th>-->
                   
                    
                       <th><i class=""></i></th>
                          <th><i class=""></i> </th>
                      <th><i class="icon_cogs"></i> Action</th>
                       
                  </tr>
                  <?php
		while($row = mysqli_fetch_array($result))
		{
                    ?>
                  <tr>
                  <td><?php echo $row['id']; ?></h5></b></td>
                  <td>
                      <input class="linput" type="text" name="timeText<?php echo $row['id']; ?>" value="<?php echo $row['time']; ?>" disabled />
                      <a href="#" class="editdonebtn"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                  </td>
                  <td align="center"><a href="workingtime.php?del_name=<?php echo $row['time']; ?>"></a></td>
                  <td><a href="edit.php?time_id=<?php  echo $row['id']; ?>"></a></td>             
                                       
                    <td>
                      <div class="btn-group">
                          <a class="btn btn-primary editbtn" href="edit2.php?time_id=<?php  echo $row['id']; ?>"><i class="icon_plus_alt2"></i></a>
                        <a class="btn btn-danger" href="workingtime.php?del_name=<?php echo $row['time']; ?>"><i class="icon_close_alt2"></i></a>
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
  
  <script>
      $(document).ready(function() {
          $(".editbtn").click(function(e) {
              e.preventDefault();
              $(this).parent().parent().parent().find("input.linput").removeAttr("disabled").addClass("linput_edit").focus();
              $(this).parent().parent().parent().find(".editdonebtn").css("visibility","visible");
              $(this).parent().parent().parent().css("background","#dedede");
              //alert($(this).parent().parent().parent().find("input.linput").attr("name").replace("timeText",""));
          });
          $(".editdonebtn").click(function (e) {
                e.preventDefault();
                $(this).css("visibility","hidden");
                $(this).parent().find("input.linput").attr("disabled","disabled").removeClass("linput_edit");
                $(this).parent().parent().css("background","#f9f9f9");
                
                $time_id = $(this).parent().find("input.linput").attr("name").replace("timeText","");
                $time = $(this).parent().find("input.linput").val();
                
                //alert($time_id + ", " + $time);
                
                $.post("edit2.php", {time_id: $time_id, time: $time}, function(result){
                    if(result.trim() == 1) {
                        // SUCCESS
                        alert("Time Updated Successfully !");
                        location.reload();
                    } else if(result.trim() == 0) {
                        // FAILURE
                        alert("Something went wrong ! Time Not Updated !");
                        location.reload();
                    }
                    //if(result == 1) {
                });
            });
      })
  </script>
</body>

</html>
