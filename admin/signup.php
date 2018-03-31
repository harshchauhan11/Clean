<?php include("admin/conn.php");?>
 <?php
 if (isset($_POST["submit"])) {
        $value1 = $_POST['name'];
        $value2 = $_POST['role'];
        $value3 = $_POST['email'];
        $value4 = $_POST['address'];
        $value5 = $_POST['phone'];
        $value6 = $_POST['password'];
        $sql = "INSERT INTO signup(name,role,email,address,phone,password) VALUES ( '$value1', '$value2', '$value3' , '$value4' , '$value5' , '$value6' )";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            ?>
            <script>
                {
                    alert("Thank you for signup");

                }
                window.location.assign("login.php");
            </script>
            <?php
        } else {
            echo "Error: " . $sql . "" . mysqli_error($conn);
            ?>
            <script>
                {
                    alert("Sorry, try again.");
                }
                window.location.assign("signup.php")
            </script>
            <?php
        }
    }
    ?>
      
<?php
$page_name="My Signup";
include("mainheader.php");
?>
            
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
                <input id="name" onblur="alpha()" name="name" type="text" placeholder="Name" class="form-control input-md" pattern="[a-zA-Z]+" title="alphabates only" required>
                <span class="help-block">Please type in your full name</span>
            </div>
        </div>
                        
                        <!-- Role input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="role">signup as</label>

            <div class="col-md-4">
                <select class="form-control input-md" name='role'>
                                    <option value= "user">User</option>
                                    <option value= "worker">Worker</option>
                                    

                                          </select>
                <span class="help-block">please select any one.</span>
            </div>
        </div>
                        <!-- Email input-->
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
        <!-- Phone input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="password">Phone</label>

            <div class="col-md-4">
                <input id="phone" name="phone" type="number" placeholder="Phone number" onBlur="num()"
                       class="form-control input-md" maxlength="12" minlength="8"  pattern="^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1}){0,1}9[0-9](\s){0,1}(\-)8[0-9](\s){0,1}7[0-9](\s){0,1}{0,1}(\s){0,1}[1-9]{1}[0-9]{7}$" required>
                <span class="help-block">Please provide your Mobile Number</span>
            </div>
        </div>
        <div class="form-group">
      <!-- Password-->
      <label class="col-md-4 control-label" for="password">Password</label>
      <div class="col-md-4">
        <input type="password" id="password" name="password" placeholder="" 
                class="form-control input-md" required>
        <span class="help-block">Password should be at least 4 characters</span>
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
        </fieldset>
              <!-- Button (Double) -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="button1id"></label>

            <div class="col-md-8">
                <input type="submit" name="submit" class="btn btn-success" value="Register" />
                
            </div>
        </div>
    </form>
</div>
 <?php include("mainfooter.php"); ?>

  
