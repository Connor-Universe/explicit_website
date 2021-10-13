<?php
include("../../include/config.php");
date_default_timezone_set('Etc/UTC');




   
   
   $date = $success = $desc="";



if ($_SERVER["REQUEST_METHOD"] == "POST"){
$date = $_POST['date'];
$desc = $_POST['desc'];


 
$insert_user = "INSERT INTO holiday (date, description) 
VALUES ('$date','$desc')";
$run_user = mysqli_query($connect,$insert_user);
$success= "<div class='alert alert-dark'>
<strong>Success</strong> Holiday Added
</div> ";
        
}




  

  




        
  

?>