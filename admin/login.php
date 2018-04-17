<?php include("conn.php"); ?>
<?php
$error = "";
if (isset($_POST["submit"])) {
   if ( empty($_POST["role"]) || empty($_POST["name"]) || empty($_POST["password"])) {
        $error = " fields are required.";
    } else {
        // Define $username and $password
        $role = $_POST['role'];
        $name = $_POST['name'];
        $password = $_POST['password'];

        // To protect from MySQL injection
         $role = stripslashes($role);
        $name = stripslashes($name);
        $password = stripslashes($password);
         $role = mysqli_real_escape_string($conn, $role);
        $name = mysqli_real_escape_string($conn, $name);
        $password = mysqli_real_escape_string($conn, $password);
        //$password = md5($password);
        //echo $name . ", " . $password;
        //Check username and password from database
        $sql = "SELECT * FROM signup WHERE role='$role' and name='$name' and password='$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        //echo "Returned rows = " . mysqli_num_rows($result);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['userid'] = $row["id"];
            $_SESSION['role'] = $row["role"];
            $_SESSION['username'] = $row["name"];
            $_SESSION['islogin'] = true;
            // Initializing Session
            header("location: index.php"); // Redirecting To Other Page
        } else {
            $error = "Sorry, Incorrect username or password.";
        }
    }
} else {
    //echo "submit button not clicked.";
}
?>
<div><h4><b><?php echo $error; ?></b></h4></div>


<?php
$page_name = "Admin Signup";
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
        <meta name="author" content="GeeksLabs">
        <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
        <link rel="shortcut icon" href="img/favicon.png">
        <title>Login Page </title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- bootstrap theme -->
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <!--external css-->
        <!-- font icon -->
        <link href="css/elegant-icons-style.css" rel="stylesheet" />
        <link href="css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />


    </head>
    <?php
    if (isset($_SESSION['userid']) || isset($_SESSION['username'])) {
        ?>
        <li>
            <a href="#">Welcome, <?php echo $_SESSION['username']; ?></a>
        </li>
        <li>
            <a href="logout.php">Logout</a>
        </li>
        <?php
    } else {
        ?>

        <?php
    }
    ?>


    <div class="container">

        <form class="login-form" method="post" action="login.php">
            
            <div class="login-wrap">
                <p class="login-img"><i class="icon_lock_alt"></i></p>
                <div class="input-group">
                     <span class="input-group-addon"><i class="icon_profile"></i></span>
                  <select class="form-control" name='role'>
                    
                        <option value= "admin">Admin</option>

                    </select>
                </div>
                            <div class="input-group">
                    <span class="input-group-addon"><i class="icon_profile"></i></span>
                    <input type="text" class="form-control" placeholder="Username" name="name" id="name" autofocus>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                </div>
<!--                <label class="checkbox">
                    <input type="checkbox" value="remember-me"> Remember me
                    <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
                </label>-->
                <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="login">Login</button>

            </div>
        </form>

        <!--End Main Container -->

        <!-- Footer -->
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script>
            new WOW().init();
        </script>
        <script type="text/javascript">$(function () {
                $('a[href*=#]:not([href=#])').click(function () {
                    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                        if (target.length) {
                            $('html,body').animate({
                                scrollTop: target.offset().top
                            }, 1000);
                            return false;
                        }
                    }
                });
            });</script>

    </body>
</html>
