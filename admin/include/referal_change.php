<?php
include("../../include/config.php");
date_default_timezone_set('Etc/UTC');

$program = $referal_amount = $referal_force = $referal_show = $success="";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

$referal_amount = $_POST['amount'];


if(!isset($_POST['program'])){
    $program = 0;
}else{
    $program = $_POST['program'];
}

if(!isset($_POST['force'])){
    $referal_force = 0;
}else{
    $referal_force = $_POST['force'];
}

if(!isset($_POST['show'])){
    $referal_show = 0;
}else{
    $referal_show = $_POST['show'];
}

        $update_user = "UPDATE referal_settings SET id=1, referal_program ='$program',  referal_amount ='$referal_amount' , referal_show = '$referal_show', referal_force= '$referal_force'";
        $run_user = mysqli_query($connect,$update_user);

        $success= "<div class='alert alert-dark'>
        <strong>Success</strong> Changes have set
      </div> ";
        
}




  

  




        
  

?>