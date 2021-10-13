<?php
include("../../include/config.php");
date_default_timezone_set('Etc/UTC');




   
   
    $address = $abb = $name = $success="";



if ($_SERVER["REQUEST_METHOD"] == "POST"){
$address = $_POST['address'];
$abb = $_POST['abb'];
$name = $_POST['name'];

 
$insert_user = "INSERT INTO crypto_wallet (name, abb , address) 
VALUES ('$name','$abb','$address')";
$run_user = mysqli_query($connect,$insert_user);
$success= "<div class='alert alert-dark'>
<strong>Success</strong> Processing Added
</div> ";
        
}




  

  




        
  

?>