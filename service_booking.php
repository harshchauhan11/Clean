<?php ob_start();
// echo $_SERVER['REQUEST_URI'];
$page_name="Service Booking";
include("admin/conn.php");
$sessio_data=$_SESSION["userdata"];
$uid = 0;
$answer_id = "";
    if (isset($_GET['i']))
    $answer_id = $_GET['i'];
    if (isset($_GET['a']))
    $answer_id = $_GET['a'];
?>
<?php
if (!isset($sessio_data['id'])) {
    header("location: login.php?followup=".urlencode($_SERVER['REQUEST_URI'])); // Redirecting To Other Page
}    

if (isset($sessio_data['id'])) {
    $uid = $sessio_data['id'];
}

if (isset($_REQUEST['submit'])) {
//echo "Hi..";
//echo $_POST['ans'];
$answers = $_POST['ans'];
    
// $value2 = $_POST['que_id'];
//$value3 = $_POST['ans'];
$value4 = $_SESSION['userid'];
 $year   = $_POST["year"];
  $month  = $_POST["month"];
   $day    = $_POST["day"];
   
   $dob = $year . "-" . $month . "-" . $day;
//$stmt1="";
 //$dob="$stmt1";
 //mysqli_stmt_bind_result($stmt1,$row->year, $row->month, $row->day);
//$dob = ($year."-".$month."-".$day);
     //      tr         $approved_date  = date("Y-m-d",$dob);

//$dob = $year . "-" . $month . "-" . $day ;
$value8 = $dob;
$value9 = $_POST['time'];
$value10 = $_POST['no_of_item'];

//echo $value8 . "," . $value9 . "," . $value10 . "," . $value3 . "," . $value4;

foreach($answers as $ans) {
    //echo $ans['queid'] . "<br />";
    //echo $ans['ans'] . "<br />";
    $queid = $ans['queid'];
    $ans = $ans['ans'];

$sql = "INSERT INTO answer (que_id,ans,userid,dob,time,no_of_item) VALUES ('$queid', '$ans', '$value4', '$value8' ,'$value9' , '$value10'  )";
//   
     // $active =" $activasion";mysqli_stmt_bind_result
//    $date =" $dateOfBirth"; 
$stmt1 = mysqli_prepare($conn, $sql);  
 
 
//echo $dob;
if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            ?>  
<!--            <script>
                {
                    alert("Thank you for add service");

                }
                window.location.assign("inner_service.php")
            </script>-->
            <?php
        } else {
            echo "Error: " . $sql . "" . mysqli_error($conn);
            ?>
    <!--            <script>
                    {
                      //  alert("Sorry, try again.");
                    }
                    //window.location.assign("index.php")
                </script> -->
<?php
        }
    }
}
    ?>

<?php

include("mainheader.php");


$inner_id = $_REQUEST['inner_id'];
$rate = "";
$inner_name = "";
$outer_name = "";

$sql = "SELECT * FROM inner_service where id=" . $inner_id . ";";
$result = mysqli_query($conn, $sql);
//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $inner_name = $row['i_sname'];
        $outer_id = $row['outerid'];
        // outer name get from outer id  
        $sql = "SELECT * FROM  outer_service where id=" . $outer_id . ";";
        $result = mysqli_query($conn, $sql);
        //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $outer_name = $row['sname'];
            }
        }
        // outer name get from outer id 
    }
}

?>


<div class="container">
    <div class="row">
        <div class="col col-lg-12 middleHeader">
            <h1 class="text-center">Service Booking</h1>
        </div>
        <div class="col col-lg-12 middleSection"><br/>
    
    <!-- <form id="searchForm" class="form-horizontal" method="get"
          action="search.php" onsubmit="return validate()" name="f1"> -->
    <form id="searchForm" class="form-horizontal" method="post"
          action="search.php" onsubmit="return validate()" name="f1">
        <fieldset>
            <!-- <legend> Details</legend> -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Outer Service Name</label>
                <div class="col-md-4">
                    <h4><?php echo "$outer_name"; ?></h4>


                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Inner Service Name</label>

                <div class="col-md-4">
                    <h4><?php echo " $inner_name"; ?> </h4>

                    <span class="help-block"></span>
                </div>
            </div>
            <!--                
            Get Quetion from inner id  -->
            <?php
            $sql = "SELECT * FROM  quation where innerid=" . $inner_id . ";";
            $result = mysqli_query($conn, $sql);
//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if (mysqli_num_rows($result) > 0) {
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
//        echo $row['title'];
                    echo "<br/>";
                    ?>
                    <!-- Title input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="title">   <?php echo $row['title']; ?></label>

                        <div class="col-md-4">
                            <input name="ans[<?php echo $i; ?>][queid]" type="hidden" value='<?php echo $row['id']; ?>' />
                            <input id="title1" name="ans[<?php echo $i; ?>][ans]" type="text" placeholder=""
                                   class="form-control input-md" required>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
            }
// Get Quetion from inner id 
            ?>     <div class="form-group">
                <label class="col-md-4 control-label" for="title">Which Date</label>
                <div class="form-inline">
                    <div class="col-md-4">
                        <div class="form-group col-lg-4">
                            <select name="year" id="year" class="form-control">
                                <option value="2018" selected>Year</option> 
                                <option value="2018">2018</option>
                            </select>     
                        </div>                    
                        <div class="form-group col-lg-4" style="align-items: center">
                            <select name="month" id="month" onchange="" class="form-control" size="1">
                                <option value="--" selected>Month</option>
                                <option value="01">Jan</option>
                                <option value="02">Feb</option>
                                <option value="03">Mar</option>
                                <option value="04">Apr</option>
                                <option value="05">May</option>
                                <option value="06">Jun</option>
                                <option value="07">Jul</option>
                                <option value="08">Aug</option>
                                <option value="09">Sep</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>            
                        </div>                                             
                        <div class="form-group col-lg-4">
                            <select name="day" id="day" onchange="" class="form-control" size="1">
                                <option value="--" selected>Day</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>      
                                <option value="31">31</option>
                            </select>
                        </div>                                              
                    </div>
                </div>  
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="time">Time   </label>

                <div class="col-md-4" >
                    <select class="form-control input-md" name="time" id="time" >
                        <?php
                        $sql = "SELECT * FROM work_time";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['time']; ?></option>
                            <?php
                            }
                        }
                        ?>
                    </select>
                    <input type="hidden" name="inner_id" value="<?php echo $inner_id; ?>" />
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" />
                    <span class="help-block"></span>
                </div>
            </div>
            <?php
            $sql = "SELECT * FROM  inner_service where id=" . $inner_id . ";";
            $result = mysqli_query($conn, $sql);
            //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $rate = $row['rate'];
                    $info = $row['info'];
                    
                    ?>         

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="title" >No of <?php echo $inner_name ?></label>

                        <div class="col-md-4">
                            <input id="no_of_item" name="no_of_item" onkeyup="getTotalBillingAmount(this.value);" onchange="getTotalBillingAmount(this.value);" type="number" min="1" placeholder=""
                                   class="form-control input-md" value="1" required>
                            <span class="help-block">One <?php echo $info ?> cost is <?php echo " $rate"; ?></span>
                        </div>
                        <input type="hidden" id="single_amount" value="<?php echo $rate; ?>"/>
                        <input type="hidden" id="final_amount" name="final_amount" value="<?php echo $rate; ?>"/>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="title">Billing Price is </label>

                        <div class="col-md-4">
                            <h2>&#8377; <span id="billing_display"> <?php echo " $rate"; ?> </span></h2>

                        </div>
                    </div>

                    <?php
                }
            }
            ?>     
            <!--             address input
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name"> Address</label>
            
                            <div class="col-md-4">
                                <input id="address" name="address" type="text" placeholder="Address" class="form-control input-md"
                                       required="">
                                <span class="help-block">Please type in your  Address</span>
                            </div>
                        </div>
                         Phone input
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password">Phone</label>
            
                            <div class="col-md-4">
                                <input id="phone" name="phone" type="number" placeholder="Phone number" onBlur="num()"
                                       class="form-control input-md" maxlength="12" minlength="8"  pattern="^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1}){0,1}9[0-9](\s){0,1}(\-)8[0-9](\s){0,1}7[0-9](\s){0,1}{0,1}(\s){0,1}[1-9]{1}[0-9]{7}$" required>
                                <span class="help-block">Please provide your Mobile Number</span>
                            </div>
                        </div>
                        <div class="form-group">
                             Password
                            <label class="col-md-4 control-label" for="password">Password</label>
                            <div class="col-md-4">
                                <input type="password" id="password" name="password" placeholder="" 
                                       class="form-control input-md" required>
                                <span class="help-block">Password should be at least 4 characters</span>
                            </div>
                        </div>
            
                        <div class="form-group">
                             Password 
                            <label class="col-md-4 control-label"  for="password_confirm">Password (Confirm)</label>
                            <div class="col-md-4">
                                <input type="password" id="confirm_password" name="confirm_password" placeholder="" 
                                       class="form-control input-md" required>
                                <span class="help-block">Please confirm password</span>
                            </div>
                        </div>
                    </fieldset>-->  
            
            <!-- Button (Double) -->
            <div class="form-group" style="margin-left: 200px">
                <label for="agree" class="control-label col-lg-2 col-sm-3"><a href=terms&conditions.php>Agree to Our Policy </a><span class="required">*</span></label>
                      <div class="col-lg-10 col-sm-9">
                          <input type="checkbox" style="width: 20px" class="checkbox form-control"  id="agree" name="agree" oninvalid="('Please accept our terms & condition.')" required />
                      </div>
                    </div>
            
            <div class="form-group">
                <label class="col-md-4 control-label" for="button1id"></label>

                <div class="col-md-8">
                    <input id="submitBtn" type="submit" name="submit"  class="btn btn-success" value="SEARCH WORKERS" />

                </div>
            </div>
            
            <div id="workerResult" class="col-lg-12 workerResult"></div>
    </form>
    </div>
    </div>
</div>
<!-- javascripts -->
 <script src="js/form-validation-script.js"></script>
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script src="admin/js/jquery.js"></script>
  <script src="admin/js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="admin/js/jquery.scrollTo.min.js"></script>
  <script src="admin/js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- jquery validate js -->
  <script type="text/javascript" src="admin/js/jquery.validate.min.js"></script>

  <!-- custom form validation script for this page-->
  <script src="admin/js/form-validation-script.js"></script>
  <!--custome script for all page-->
  <script src="admin/js/scripts.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script>
    var getTotalBillingAmount = function(amount) {
        //console.log(document.getElementById("single_amount"));
        //document.getElementById("billing_display").innerHTML = parseInt(document.getElementById("single_amount").value) * parseInt(amount);
        $("#billing_display").html(parseInt($("#single_amount").val()) * parseInt(amount));
        $("#final_amount").val(parseInt($("#single_amount").val()) * parseInt(amount));
    }
    $(document).ready(function() {
        $("#searchForm").submit(function(e) {
            e.preventDefault();
            $.get("search.php?" + $('#searchForm').serialize(), function(data, status){
                $("#workerResult").html(data);
                $('html, body').animate({
                    scrollTop: $("#workerResult").offset().top
                }, 500);
            });
        })
    })
</script>


<?php include("mainfooter.php"); ?>



