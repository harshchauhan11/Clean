<?php
include("admin/conn.php");
$time_id = $_POST["time_id"];
$uid = $_POST['uid'];
$wid = $_POST['wid'];
$inner_id = $_POST['inner_id'];
$amount = $_POST['amount'];
$start_date = $_POST['start_date'];

// echo $start_date;

?>
<link href="admin/css/font-awesome.min.css" rel="stylesheet" />
<script type="application/javascript">
    $(document).ready(function() {
        // alert(3);
        // $(".hireBtn").click(function(e) {
        //     e.preventDefault();
        //     $wid = <?php echo $user_id; ?>;
        //     $user_id = <?php echo $user_id; ?>;
        //     $time = <?php echo $time; ?>;
        //     $inner_id = <?php echo $inner_id; ?>;
        //     $amount = <?php echo $amount; ?>;
            
            
        //     $.post("hire.php", {uid: $user_id, wid: $wid, inner_id: $inner_id, time_id: $time, amount: $amount}, function(result){
        //         if(result.trim() == 1) {
        //             // SUCCESS
        //             alert("Your Service Request has been sent Successfully ! You will be informed soon.");
		// 			// url = 'summery.php?orders_id=' + $user_id + '&user_id='+ $wid ;
        //             // document.location.href = url;
        //         } else if(result.trim() == 0) {
        //             // FAILURE
        //             alert("Something went wrong ! Service has not been booked !");
        //             location.reload();
        //         }
        //     });
        //     /*
        //     $.get("search.php?" + $('#searchForm').serialize(), function(data, status){
        //         $("#workerResult").html(data);
        //         $('html, body').animate({
        //             scrollTop: $("#workerResult").offset().top
        //         }, 500);
        //     });
        //     */
        // })
    })
</script>
<?php
/*
echo $uid . "<br>";
echo $wid . "<br>";
echo $time_id . "<br>";
echo $inner_id . "<br>";
echo $amount . "<br>";
*/

$worker = "SELECT *, (SELECT address FROM signup WHERE id = $uid) AS user_address FROM signup WHERE id = " . $wid;
$service = "SELECT * FROM inner_service where id = " . $inner_id;
$timing = "SELECT * FROM work_time where id = " . $time_id;
$result1 = mysqli_query($conn, $worker);
$result2 = mysqli_query($conn, $service);
$result3 = mysqli_query($conn, $timing);

if (mysqli_num_rows($result1) > 0 && mysqli_num_rows($result2) > 0 && mysqli_num_rows($result3) > 0) {
    echo "<h3 class='text-center nomarg'><img src='image/happy.png' width='50px' /> Cool ! Just one step remaining.</h3><br/>";
    $row1 = mysqli_fetch_assoc($result1);
    $row2 = mysqli_fetch_assoc($result2);
    $row3 = mysqli_fetch_assoc($result3);
    // while ($row = mysqli_fetch_assoc($result)) {
        // if($row['gender'] == 'female')
        //     $worker_pic = "image/worker_female2.png";
        // if($row['gender'] == 'male')
        //     $worker_pic = "image/worker_male.png";
    ?>
        <div class="row">
            <div class="col col-lg-12">
                <div class="table-responsive">          
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="col-lg-4">Worker :</td>
                                <td class="col-lg-8 text-left"><div class="row"><div class="col-lg-6 text-left"><b><?php echo ucfirst($row1['name']); ?></b><br/><small>( <?php echo $row1['email']; ?> )</small></div><div class="col-lg-6 text-right <?php echo $row1['gender']; ?>"><?php echo strtoupper($row1['gender']); ?></div></div></td>
                            </tr>
                            <tr>
                                <td class="col-lg-4">Worker's Age :</td>
                                <td class="col-lg-8 text-left"><?php echo $row1['age']; ?></td>
                            </tr>
                            <tr>
                                <td class="col-lg-4">Your Address :</td>
                                <td class="col-lg-8 text-left"><?php echo ucwords($row1['user_address']); ?></td>
                            </tr>
                            <tr>
                                <td class="col-lg-4">Service You're Looking :</td>
                                <td class="col-lg-8 text-left"><b><?php echo $row2['i_sname']; ?></b></td>
                            </tr>
                            <tr>
                                <td class="col-lg-4">Your Preferred Date :</td>
                                <td class="col-lg-8 text-left"><?php echo date_format(date_create($start_date), "j M, Y"); ?></td>
                            </tr>
                            <tr>
                                <td class="col-lg-4">Your Preferred Timing :</td>
                                <td class="col-lg-8 text-left"><?php echo ucfirst($row3['time']); ?></td>
                            </tr>
                            <tr>
                                <td class="col-lg-4">Total Payable Amount :</td>
                                <td class="col-lg-8 text-left green"><b><big>&#8377; <?php echo $amount; ?></big></b></td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="text-center"><small>NOTE: Confirming to this will send above Worker an Service request. When He/She will respond, Your service request will be Booked. Please be patiece little.</small></small></p>
                    <!-- <div class="col-md-12 text-center"><button class="btn greenbg btn-primary hireBtn" id="worker<?php echo $row['id']; ?>"><big><i class="fa fa-share-square"></i> SEND SERVICE REQUEST</big></button></div> -->
                </div>
            </div>
        </div>

    <?php
    // }
}
?>