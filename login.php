<?php ob_start(); include("admin/conn.php");?>
<?php
 $error = "";
if (isset($_POST["submit"])) {
           
            if ( empty($_POST["role"]) || empty($_POST["email"]) || empty($_POST["password"])) {
             
                $error = " fields are required.";
            } else {
                // Define $username and $password
                $role = $_POST['role'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                 //$phone = $_POST['phone'];
                //$phone="";

                // To protect from MySQL injection
                $role = stripcslashes($role);
                $email = stripslashes($email);
                //$phone = stripslashes($phone);
                $password = stripslashes($password);
                $role = mysqli_real_escape_string($conn, $role);
                //$phone = mysqli_real_escape_string($conn, $phone);
                $email = mysqli_real_escape_string($conn, $email);
                $password = mysqli_real_escape_string($conn, $password);
                //$password = md5($password);
                //echo $email . ", " . $password;
                //Check username and password from database
                 $sql = "SELECT * FROM signup WHERE role='$role' and email='$email' and password='$password' ";
                  $result = mysqli_query($conn, $sql);               
                if (mysqli_num_rows($result) == 1 ) {
                  // $row= mysqli_fetch_assoc($result);
                     $row = mysqli_fetch_assoc($result);                  
                      $_SESSION['userdata'] = $row;
//                    $_SESSION['role'] = $row["role"];
//                    $_SESSION['username'] = $row["name"];
//                    $_SESSION['useremail'] = $row["email"];
//                    $_SESSION['phone'] = $row["phone"];
//                    $_SESSION['address'] = $row["address"];// Initializing Session
                     
                   // print_r_pre($_SESSION);
                    if($role == "user") {
                        // echo $_GET["followup"];
                        if (isset($_GET["followup"])) {
                            header("Location: ".$_GET["followup"]); // User
                        } else
                            header("Location: dashboard.php"); // User
                        exit();
                    } else if($role == "worker") {
                        header("Location: worker_profile.php"); // Worker
                        exit();
                    }
                } else {
                    //echo '<a href="worker_profile.php">';
                    //$error = "Sorry, Incorrect username or password.";
                }
            }
        } else {
            //echo "submit button not clicked.";
        }
?>
<?php 
if(isset($_SESSION['userdata']))
    $sessio_data = $_SESSION['userdata'];
if (!isset($sessio_data['id'])) {
    // echo $sessio_data['id'];
$page_name=" My login";
include("mainheader.php");
?>
<div class="main">
<div class="container">
    
    
    <form class="form-horizontal" method="post" action="login.php<?php if(isset($_GET['followup'])) { echo "?followup=".urlencode($_SERVER['REQUEST_URI']); } ?>">
    <div class="text-center">
        <h1 class="nice">Sign<b><sup>In</sup></b></h1>
    </div><hr>
        
        <fieldset>
            <!-- <legend> Details</legend> -->
         <div><h3> <?php  echo $error ?></h3></div>
         
                    <!-- Role input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="role">Login as</label>
            <div class="col-md-6">
                <select class="form-control input-md" name='role'>
                                    <option value= "user">User</option>
                                    <option value= "worker">Worker</option>

                                          </select>
                <span class="help-block">please select any one.</span>
            </div>
        </div>
                     <!-- Email input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Email</label>

                <div class="col-md-6">
                    <input id="name" name="email" type="text" placeholder="Your Email Address" class="form-control input-md" required>
                                    <span class="help-block">Please type in your email address</span>
                </div>
            </div>

     <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">Password</label>
                <div class="col-md-6">
                    <input type="password" id="password" name="password" placeholder="Your Password" 
                           class="form-control input-md" required>
                            <span class="help-block">Password should be at least 4 characters</span>
                </div>
            </div>
        </fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label" for="button1id"></label>

            <div class="col-md-12 text-center">
                <input type="submit" name="submit" class="btn btn-lg btn-success" value="LOGIN" />
            </div>
        </div>
    </form>
</div>
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

