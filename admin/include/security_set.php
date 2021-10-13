<?php
include("../../include/config.php");
date_default_timezone_set('Etc/UTC');




   
   
    
$success="";
$ip = "";
$browser_change = "";
$email = "";


if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $ip= $_POST['ip'];
  $browser_change = $_POST['change'];
  $email = $_POST['email'];
 
 



  
  
 
  
  
       
        
      
         
         
        $update_user = "UPDATE security SET id=1, ip_change ='$ip',  browser_change ='$browser_change' , email = '$email'";
        $run_user = mysqli_query($connect,$update_user);

        $success= "<div class='alert alert-dark'>
        <strong>Success</strong> Changes have set
      </div> ";
        
}




  

  




        
  

?>