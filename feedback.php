<?php include("admin/conn.php");?>
 <?php
 if (isset($_POST["submit"])) {
    
     
        $value1 = $_POST['name'];
        $value2 = $_POST['email'];
        $value3 = $_POST['subject'];
        $sql = "INSERT INTO feedback(name,email,subject) VALUES ( '$value1', '$value2', '$value3')";
 if (mysqli_query($conn, $sql)) {

                ?>
<!--<script>
                    {
                        alert("Thank you");

                    }
                    window.location.assign("index.php")
                </script>-->
<!--   <script>
                {
                    alert("Sorry, try again.");
                }
                window.location.assign("feedback.php")
            </script>-->
            <?php
 }}
        
    
    ?>
      
<?php
$page_name="My Feedback";
include("mainheader.php");
?>
            
<div class="main">
<div class="container">
    <form class="form-horizontal" method="post"
          action="feedback.php" onsubmit="return validate()" name="f1">
          <div class="text-center">
            <h1 class="nice">Feed<b>Back</b></h1>
        </div><hr>
          <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Name</label>

            <div class="col-md-6">
                <input id="name" onblur="alpha()" name="name" type="text" placeholder="Name" class="form-control input-md" pattern="[a-zA-Z]+" title="alphabates only" required>
                <span class="help-block">Please type in your full name</span>
            </div>
        </div>
                        
                     
        <!-- Phone input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="phone">Email</label>

            <div class="col-md-6">
                <input id="email" name="email" type="text" placeholder="Email" 
                       class="form-control input-md"  minlength="8"  required>
                <span class="help-block">Enter your email</span>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-4 control-label" for="subject">Subject</label>

            <div class="col-md-6">
                <textarea id="subject" name="subject" type="textarea" placeholder="subject" 
                          class="form-control input-md"  style="height: 100px; width: 100%;"  required></textarea>
                <span class="help-block"></span>
            </div>
        </div>
        
          </fieldset>
              <!-- Button (Double) -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="button1id"></label>

            <div class="col-md-12 text-center">
                <input type="submit" name="submit" class="btn btn-lg btn-success" value="SUBMIT" />
                
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
</div>
            
         <?php include("mainfooter.php"); ?>

  
