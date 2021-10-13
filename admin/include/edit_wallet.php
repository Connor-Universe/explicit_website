<?php
include("../../include/config.php");
date_default_timezone_set('Etc/UTC');




   
   
    $id=$address = $abb = $name = $success="";



if ($_SERVER["REQUEST_METHOD"] == "POST"){
$address = $_POST['address'];
$abb = $_POST['abb'];
$name = $_POST['name'];
$id = $_POST['id'];

 
$insert_user = "update crypto_wallet set name='$name',  abb ='$abb' , address ='$address' where id = $id";

$run_user = mysqli_query($connect,$insert_user);
$success= "<div class='alert alert-dark'>
<strong>Success</strong> Processing Edited
</div> ";
header("location:edit_processing.php?id=$id");
        
}




  

  




        
  

?>