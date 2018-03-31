<?php
include("admin/conn.php");
$uid = 0;
$orders_id = "";
    if (isset($_GET['i']))
    $orders_id = $_GET['i'];
    if (isset($_GET['a']))
    $orders_id = $_GET['a'];

?>

<?php
$sessio_data=$_SESSION["userdata"];
if (!isset($sessio_data['id'])) {
    
            header("location: login.php"); // Redirecting To Other Page
        }    
?>
<?php
if (isset($sessio_data['id'])) {
    $uid = $sessio_data['id'];
}
?>
<?php

include("mainheader.php");

//$inner_id = $_REQUEST['inner_id'];
?>
<?php
if(isset($_REQUEST['orders_id']))
    $orders_id = $_REQUEST['orders_id'];
else
    $orders_id = 0;
$id="";
$amount="";
$booking_date="";
$name="";
//$user_name="";

            // $orders_id = $_REQUEST['orders_id'];
$sql = "SELECT * FROM orders where id=" . $orders_id . ";";

$result = mysqli_query($conn, $sql);
//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $amount = $row['amount'];
        $booking_date = $row['booking_date'];
        //echo "$user_name";
        //$user_id = $row['userid'];
         $sql = "SELECT * FROM  signup where id=" . $wid . ";";
        $result = mysqli_query($conn, $sql);
        //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['name'];
            }
        }
        // outer name get from outer id  
        
        // outer name get from outer id 
    }
}

            
?>
<div class="container">
    <div class="text-center">
        <h1 class="nice">Summery </h1>
    </div>
    <form class="form-horizontal" method="post"
          action="" onsubmit="return validate()" name="f1">
        <fieldset>
            <legend> Details</legend>
            <div class="form-group">
                <label class="col-md-4 control-label" for="name"> Total Amount</label>
                <div class="col-md-4">
                    <h4><?php echo "$amount"; ?></h4>


                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Date & Time of booking</label>

                <div class="col-md-4">
                    <h4><?php echo " $booking_date"; ?> </h4>

                    <span class="help-block"></span>
                </div>
            </div>
                        <div class="form-group">
                <label class="col-md-4 control-label" for="button1id"></label>

                <div class="col-md-8">
                    <input type="submit" name="submit" class="btn btn-success" onclick="" value="submit" />

                </div>
            </div>
    </form>
</div>
<script>
    function getTotalBillingAmount(amount) {
        //console.log(document.getElementById("single_amount"));
        document.getElementById("billing_display").innerHTML = parseInt(document.getElementById("single_amount").value) * parseInt(amount);
    }

</script>
<?php include("mainfooter.php"); ?>


