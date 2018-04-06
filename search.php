<?php ob_start();?>
<link rel="stylesheet" href="assets/css/style.css">
<link href="js/fontawesome-stars-o.css" rel="stylesheet">
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.barrating.min.js"></script> -->
<script type="text/javascript">
$(document).ready(function() {    
    $('.rating').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: -1,
        readonly: true
    });
});
</script>
<div class="searchBox">
<?php
include "admin/conn.php";

$user_id = $_GET['uid'];
$worker_id = 0;
$time = $_GET['time'];
$inner_id = $_GET['inner_id'];
$amount = $_GET['final_amount'];

// echo $user_id . "<br>";
// echo $worker_id . "<br>";
// echo $time . "<br>";
// echo $inner_id . "<br>";
// echo $amount . "<br>";

$sql = "SELECT * FROM signup where service = " . $inner_id . " AND id IN (SELECT worker_id FROM worker_timing WHERE work_time_id = " . $time . ") AND id NOT IN (SELECT worker_id FROM orders WHERE work_time_id = " . $time . " AND inner_service_id = " . $inner_id . " AND user_id = " . $user_id . ");";
$result = mysqli_query($conn, $sql);
//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
if (mysqli_num_rows($result) > 0) {
    echo "<h2 class='text-center'><img src='image/happy.png' width='50px' /> Yay ! Here's Available Workers</h2>";
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['gender'] == 'female') {
            $worker_pic = "image/worker_female2.png";
        }

        if ($row['gender'] == 'male') {
            $worker_pic = "image/worker_male.png";
        }

        // $rating = "SELECT AVG(rating)/COUNT(*) AS rating FROM ratings WHERE worker_id = " . $row['id'];
        $rating = "SELECT COALESCE(AVG(rating)/COUNT(*),0) AS rating FROM ratings WHERE worker_id = " . $row['id'];
        $rating_result = mysqli_query($conn, $rating);
        ?>

                    <div class="row workerTab">
                        <div class="col-md-2 col-md-offset-1 text-right">
                            <img src="<?php echo $worker_pic; ?>" width="100px" class="worker_pic" />
                        </div>
                        <div class="col-md-4">
                            <input type="hidden" name="wid" value="<?php echo $row['id']; ?>" />
                            Worker Name : <span><b class="worker_name"><?php echo $row['name']; ?></b></span><br>
                            <!-- Address: <span><b><?php echo $row['address']; ?></b></span><br> -->
                            Email: <span><b><?php echo $row['email']; ?></b></span><br>
                            <select class="rating" data-id="rate<?php echo $row['id']; ?>">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <?php 
                                if (mysqli_num_rows($rating_result) > 0) {
                                    while($rating_row = mysqli_fetch_assoc($rating_result)) {
                                        // echo json_encode($row['id'], JSON_HEX_TAG);
                                        // echo json_encode($rating_row['rating'], JSON_HEX_TAG);

                                ?>
                                        
                                        <script type="text/javascript">
                                        {
                                            $(document).ready(function() {
                                                // alert(2);
                                                var $el = 0
                                                $rate = 0;
                                                $el = <?php echo json_encode($row['id'], JSON_HEX_TAG); ?>;
                                                $rate = <?php echo $rating_row['rating']; ?>;
                                                $("select[data-id*="+$el+"]").barrating('set', $rate);
                                                $("select[data-id*="+$el+"]").parent().find(".br-widget").attr("role", $rate);
                                            });
                                        }
                                        </script>
                                <?php
                                    }
                                }
                                ?>
                        </div>
                        <div class="col-md-4 text-center"><button class="btn btn-primary hireBtn" data-toggle="modal" data-target="#myModal" id="worker<?php echo $row['id']; ?>">HIRE ME !</button></div>
                    </div>
                    <?php
}
} else {
    echo "<h2 class='text-center'><img src='image/oh.png' width='50px' /> <img src='image/sad.png' width='50px' /> Sorry ! No Worker Available For This Time.</h2>";
}

//echo "New record created successfully";
//$sql = "SELECT LAST_INSERT_ID()";

?>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Summary</h4>
      </div>
      <div id="summary-body" class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn greenbg btn-primary" id="okBtn" data-dismiss="modal"><big><i class="fa fa-share-square"></i> SEND SERVICE REQUEST</big></button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
    var $wid = 0,
        $user_id = 0,
        $time = 0,
        $inner_id = 0,
        $amount = 0;
    $(document).ready(function() {
        $("#okBtn").click(function(e) {
            // alert("wid = "+$wid);
            $.post("hire.php", {uid: $user_id, wid: $wid, inner_id: $inner_id, time_id: $time, amount: $amount}, function(result){
                // alert("result = "+result);
                if(result.trim() == 1) {
                    // SUCCESS
                    alert("Your Service Request has been sent Successfully ! Worker need to accept it. \nWe will inform you shortly.");
					// url = 'summery.php?orders_id=' + $user_id + '&user_id='+ $wid ;
                    // document.location.href = url;
                    location.reload();
                } else if(result.trim() == 0) {
                    // FAILURE
                    alert("Something went wrong ! Service has not been booked !");
                    location.reload();
                }
            });
        });
        $(".hireBtn").click(function(e) {
            e.preventDefault();
            $wid = $(this).attr("id").replace("worker","");
            $user_id = <?php echo $user_id; ?>;
            $time = <?php echo $time; ?>;
            $inner_id = <?php echo $inner_id; ?>;
            $amount = <?php echo $amount; ?>;

            $.post("summary.php", {uid: $user_id, wid: $wid, inner_id: $inner_id, time_id: $time, amount: $amount}, function(result){
                $("#summary-body").html(result);
                // if(result.trim() == 1) {
                //     // SUCCESS
                //     alert("Your Service has been booked Successfully !");
				// 	url = 'summery.php?orders_id=' + $user_id + '&user_id='+ $wid ;
                //     document.location.href = url;
                // } else if(result.trim() == 0) {
                //     // FAILURE
                //     alert("Something went wrong ! Service has not been booked !");
                //     location.reload();
                // }
            });
            // $.post("hire.php", {uid: $user_id, wid: $wid, inner_id: $inner_id, time_id: $time, amount: $amount}, function(result){
            //     if(result.trim() == 1) {
            //         // SUCCESS
            //         alert("Your Service has been booked Successfully !");
			// 		url = 'summery.php?orders_id=' + $user_id + '&user_id='+ $wid ;
            //         document.location.href = url;
            //     } else if(result.trim() == 0) {
            //         // FAILURE
            //         alert("Something went wrong ! Service has not been booked !");
            //         location.reload();
            //     }
            // });
            /*
            $.get("search.php?" + $('#searchForm').serialize(), function(data, status){
                $("#workerResult").html(data);
                $('html, body').animate({
                    scrollTop: $("#workerResult").offset().top
                }, 500);
            });
            */
        })
    })
</script>