<?php
//include './admin/conn.php';
//$userdata="";
if(isset($_SESSION["userdata"]))
    $sessio_data = $_SESSION["userdata"];
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $page_name; ?> </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300">
        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
        <link href="http://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
        <!-- <link rel="stylesheet" href="assets/css/font-awesome.min.css"> -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <link rel="stylesheet" type="text/css" media="all" href="assets/css/style-projects.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
        <script src="js/jquery.barrating.min.js"></script>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="image/logo.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">



       <script type="text/javascript">
	 function alpha()
	 {
		 	var letters = /^[A-Za-z]+$/;  
if(f1.name.value.match(letters))  
{  
	return true;
}  
else  
{  
alert('Username must have alphabet characters only');  
name.focus();  
return false;  
}   
function num(){
}
if(a==1 && b==1)
{
	return true;
}
else
{
	return false;
	}
}  
</script>    
<script>     function validate(){

      var a = document.getElementById("password").value;
            var b = document.getElementById("confirm_password").value;
            if (a!=b) {
               alert("Passwords do no match");
               return false;} }
    </script>
    
	
    </head>


    <body>
        <!-- <header role="banner">
            <nav id="navbar-primary" class="navbar navbar-default navbar-static-top navbar-sticky" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-primary-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    </div>
                    <div class="collapse navbar-collapse navbar-responsive-collapse" id="navbar-primary-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#"><img class="office-logo" src="image/help2home.jpg" id="logo-navbar-middle" alt="Help2Home"></a></li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                    </ul>
                    </div>
                </div>
            </nav>
        </header> -->

        <!-- Header -->

        <nav id="navbar-section" class="navbar navbar-default navbar-static-top navbar-sticky" role="navigation">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="index.php"><img class="office-logo" src="image/help2home.png" ></a>
                </div>

                <div id="navbar-spy" class="collapse navbar-collapse navbar-responsive-collapse text-center">
                    <ul class="nav navbar-nav pull-center">
                        <li class="<?php  setActiveClassMenu('index.php'); ?>">
                            <a href="index.php">Home</a>                        </li>
<!--                                         <li>
                                                <a href="signup.php">Signup</a>
                                            </li>-->
                       <?php
                        if (isset($sessio_data['id']) || isset($sessio_data['name']) || isset($sessio_data['email'])) {
                            ?>
                            <li>
                                <a href="#">Welcome, <?php echo $sessio_data['name']; ?></a>
                            </li>
                            <li>
                                <a href="index.php#services">Book A Service</a>
                            </li>
                            <li>
                                <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="<?php setActiveClassMenu('logout.php'); ?>">
                                <a href="logout.php">Logout</a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li class="<?php setActiveClassMenu('signup.php'); ?>">
                                <a href="signup.php">Register</a> 
                            </li>
                            <li class="logo-space">
                                <a href=""></a>
                            </li>
                            <li class="<?php setActiveClassMenu('login.php'); ?>" >
                                <a href="login.php">Login</a>
                            </li>
                            <?php
                        }
                        ?>
                                 
                        <li class="<?php setActiveClassMenu('contact.php'); ?>">
                            <a  href="feedback.php">Contact</a>
                        </li>
                    </ul>         
                </div>
            </div>
        </nav>

        <!-- End Header -->


