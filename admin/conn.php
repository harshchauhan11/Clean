<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clean";

$conn = mysqli_connect($servername, $username, $password, $dbname);
//$conn = new mysqli($servername, $username, $password, $dbname);

require_once ('lib/functions.php') ;
?>

