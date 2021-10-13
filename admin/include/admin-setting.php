<?php
include("../../include/config.php");
date_default_timezone_set('Etc/UTC');




   
   
    



if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $username2= $_POST['username'];
  $password2 = $_POST['password'];
 
 



  
  
 
  
  
       
        
      
         
         
        $update_user = "UPDATE admin SET  username ='$username2',  password ='$password2'";
        $run_user = mysqli_query($connect,$update_user);
        
}




  

  




        
  

?>