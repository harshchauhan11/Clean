<?php ob_start(); include("admin/conn.php");?>
 <?php
 if (isset($_POST["submit"])) {
    
     
        $value1 = $_POST['name'];
        //if (isset($_POST['role'])){
        $value2 = $_POST['role'];
        //$value2 = $_POST['role'];
        // $value3 = $_POST['service'];
        // $value4 = $_POST['time'];
        $value4 = "";
        $value5 = $_POST['email'];
        $value6 = $_POST['address'];
        $value7 = $_POST['phone'];
        $value8 = $_POST['password'];
        if (isset($_POST["gender"]))
            $value9 = $_POST['gender'];
        else
            $value9 = 0;
        if (isset($_POST["age"]))
            $value10 = $_POST['age'];
        else
            $value10 = 0;
        if (isset($_POST["que"]))
            $value11 = $_POST['que'];
        else
            $value11 = null;
        $value12 = $_POST['area'];
        $sql = "INSERT INTO signup(name,role,time,email,address,phone,password,gender,age,que,area) VALUES ( '$value1', '$value2', '$value4' , '$value5' , '$value6' , '$value7', '$value8', '$value9', '$value10', '$value11', '$value12' )";


        if (mysqli_query($conn, $sql)) {
            ?>
            <script>
            {
                alert("Thank you for signup");
            }
            window.location.assign("login.php");
            </script>
            <?php
            //echo "New record created successfully";
            //$sql = "SELECT LAST_INSERT_ID()";
            $userID = mysqli_insert_id($conn);
            $time="";
            if(isset($_POST['time']) && isset($_POST['services'])) {
                $time = $_POST['time'];
                $services = $_POST['services'];
            
                //print_r($time);
                $sql = "INSERT INTO worker_timing (work_time_id, worker_id) VALUES ";
                $sql2 = array();
                foreach($time as $t) {
                    array_push($sql2, "('$t', '$userID')");
                }
                $s = implode(",", $sql2);
               // echo $userID . "<br>";
                //echo $_POST['phone'] . "<br>";
                // echo $sql2 . "<br>";
               // echo "s = " . $s . "<br>";
                $sql = $sql . $s;
               // echo "sql = " . $sql . "<br>";

               $sql_services = "INSERT INTO worker_services (worker_id, inner_service_id) VALUES ";
                $sql2_services = array();
                foreach($services as $se) {
                    array_push($sql2_services, "('$userID', '$se')");
                }
                $s2 = implode(",", $sql2_services);
               // echo $userID . "<br>";
                //echo $_POST['phone'] . "<br>";
                // echo $sql2 . "<br>";
               // echo "s = " . $s . "<br>";
                $sql_services = $sql_services . $s2;
               // echo "sql = " . $sql . "<br>";

                if (mysqli_query($conn, $sql)) {
                    if (mysqli_query($conn, $sql_services)) {
                        header("Location: login.php");
                    }
                } else {
                    header("Location: login.php");
                }
            }
        } else {
            echo "Error: " . $sql . "" . mysqli_error($conn);
            ?>
            <script>
                {
                    alert("Sorry, try again.");
                }
                window.location.assign("signup.php");
            </script>
            <?php   
        }
    }
    ?>
      
      
<?php
if(isset($_SESSION['userdata']))
$sessio_data = $_SESSION['userdata'];
if (!isset($sessio_data['id'])) {
$page_name="My Signup";
include("mainheader.php");
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $("#services").select2();
    });
</script>


<div class="container">
    <div class="text-center">
        <h1 class="nice">Signup Form</h1>
    </div>
    <form class="form-horizontal" method="post"
          action="signup.php" onsubmit="return validate()" name="f1">
          <fieldset>
                        <legend> Details</legend>
        
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Name</label>

            <div class="col-md-4">
                <input id="name"  name="name" type="text" placeholder="Name" class="form-control input-md" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" title="alphabates only" required>
                <span class="help-block">Please type in your full name</span>
            </div>
        </div>
                        
                        <!-- Role input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="role">signup as</label>

            <div class="col-md-4">
                
                <input type="radio" name="role" value="User" onclick="javascript:hide();" > User<br>
                <input type="radio" name="role" value="Worker" onclick="javascript:show();" > Worker

                                          </select>
                <span class="help-block">please select any one.</span>
            </div>
        </div>
                                     
          
                   <!-- Service input-->
                   <div id="text1">
                   <div class="form-group">
            <label class="col-md-4 control-label" for="Service">Services</label>

            <div class="col-md-4">
              
                       <select class="form-control input-lg m-bot15" style="width:auto;" name='services[]' id="services" multiple="multiple">
                            <?php
                            
                             $sql = "select * from outer_service";
                            $result = mysqli_query($conn, $sql);
//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    //while ($row = mysqli_fetch_array($result)) {
                                    ?>
                            <optgroup label="<?php echo $row['sname']; ?>">
                                <?php
                                 $sql = "select * from inner_service where outerid=".$row['id'];
                            $result1 = mysqli_query($conn, $sql);
//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            if (mysqli_num_rows($result1) > 0) {
                                while ($row1 = mysqli_fetch_assoc($result1)) {
                                    //while ($row = mysqli_fetch_array($result)) {
                                    ?>
                            <h3><option value= "<?php echo $row1['id']; ?>"><?php echo $row1['i_sname']; ?></option></h3>
                                    <?php
                                }
                            }
                                ?>    
</optgroup>
                                    

                                    <?php
                                }
                            }
  ?>                          
 </select>
            </div>
                                     

        </div>
                       
                                <div class="form-group">
            <label class="col-md-4 control-label" for="role">Gender</label>

            <div class="col-md-4" >
                
                <input type="radio" name="gender" value="male"  >Male<br>
                <input type="radio" name="gender" value="female" > Female

                                          
                <span class="help-block">please select any one.</span>
            </div>
        </div>
                       <div class="form-group">
            <label class="col-md-4 control-label" for="Email">Age</label>

            <div class="col-md-4">
                <input id="age" name="age" type="age" placeholder="age"
                       class="form-control input-md">
                <span class="help-block">Please type in your age</span>
            </div>
        </div>
       
                              <div class="form-group">
            <label class="col-md-4 control-label" for="Email">Qualification</label>

            <div class="col-md-4">
                <input id="que" name="que" type="que" placeholder="Qualification"
                       class="form-control input-md">
                <span class="help-block">Please type in your Qualification</span>
            </div>
        </div>
           
                  <div class="form-group">
            <label class="col-md-4 control-label" for="Service">Time</label>
  <div class="col-md-4">
 <?php
                            $sql = "select * from work_time";
                            $result = mysqli_query($conn, $sql);
//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    //while ($row = mysqli_fetch_array($result)) {
                                    ?>
             <input type="checkbox" name="time[]" value="<?php echo $row['id']; ?>"><?php echo $row['time']; ?><br>
                                    
                                    <?php
                                }
                            }
                            ?>  
  
                           
  
            </div>
        </div> 

<!--                       <div class="form-group">
            <label class="col-md-4 control-label" for="name">Age</label>

            <div class="col-md-4">
                <input id="age" onblur="alpha()" name="age" type="text" placeholder="Age" class="form-control input-md"  title="Interger only" required>
                <span class="help-block">Please type age</span>
            </div>
        </div>-->
        
                                 </div>                <!-- Email input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="Email">Email</label>

            <div class="col-md-4">
                <input id="email" name="email" type="email" placeholder="Email"
                       class="form-control input-md" required>
                <span class="help-block">Please type in your email</span>
            </div>
        </div>
        <!-- address input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="name"> Address</label>

            <div class="col-md-4">
                <input id="address" name="address" type="text" placeholder="Address" class="form-control input-md"
                       required="">
                <span class="help-block">Please type in your  Address</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="area"> Area</label>

            <div class="col-md-4">
                <input id="area" name="area" type="text" placeholder="Area" class="form-control input-md"
                       required="">
                <span class="help-block">Please type in your  Area</span>
            </div>
        </div>
        
        <!-- Phone input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="password">Phone</label>

            <div class="col-md-4">
                <input id="phone" name="phone" type="" placeholder="Phone number" onBlur="num()"
                       class="form-control input-md" maxlength="12" minlength="8"  pattern="^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1}){0,1}9[0-9](\s){0,1}(\-)8[0-9](\s){0,1}7[0-9](\s){0,1}{0,1}(\s){0,1}[1-9]{1}[0-9]{7}$" required>
                <span class="help-block">Please provide your Mobile Number</span>
            </div>
        </div>
        <div class="form-group">
      <!-- Password-->
      <label class="col-md-4 control-label" for="password">Password</label>
      <div class="col-md-4">
          <input type="password" id="password" name="password" placeholder=""  pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Choose secure password"
                class="form-control input-md" required>
        <span class="help-block"></span>
      </div>
    </div>
 
    <div class="form-group">
      <!-- Password -->
      <label class="col-md-4 control-label"  for="password_confirm">Password (Confirm)</label>
      <div class="col-md-4">
        <input type="password" id="confirm_password" name="confirm_password" placeholder="" 
               class="form-control input-md" required>
        <span class="help-block">Please confirm password</span>
      </div>
    </div>
<!--          <div id="text1">
          </div>
                        -->
        
        </fieldset>
              <!-- Button (Double) -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="button1id"></label>

            <div class="col-md-8">
                <input type="submit" name="submit" class="btn btn-success" value="Register" />
                
            </div>
        </div>
    </form>
 
    
    <script type=text/javascript>
function hide(){
document.getElementById('text1').style.display='none';
}
function show(){
document.getElementById('text1').style.display='block';
}
</script>
</script>
</div>
            
<?php include("mainfooter.php");
} else {
    echo $sessio_data['role'];
    if(strcasecmp($sessio_data['role'], "user") == 0) {
         echo $_GET["followup"];
        if (isset($_GET["followup"])) {
            header("Location: ".$_GET["followup"]); // User
        } else
            header("Location: dashboard.php"); // User
        exit();
    } else if(strcasecmp($sessio_data['role'], "worker") == 0) {
        header("Location: worker_profile.php"); // Worker
        exit();
    }
}
?>

  
