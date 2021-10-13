<?php
include("../../include/config.php");
date_default_timezone_set('Etc/UTC');




   
   $success="";
    
$maximum = "";
$status = "";


if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $maximum= $_POST['maximum'];
  $status = $_POST['status'];

 
 



  
  
 
  
  
       
        
      
         
         
        $update_user = "UPDATE auto_withdraw SET id=1, maximum ='$maximum',  status ='$status'";
        $run_user = mysqli_query($connect,$update_user);

        $success= "<div class='alert alert-dark'>
        <strong>Success</strong> Changes have set
      </div> ";
        
}




  

  




        
  

?>