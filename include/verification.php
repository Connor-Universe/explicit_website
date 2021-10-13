<?php
session_start();
include("config.php");
 if(isset($_GET['token'])){
     $token = $_GET['token'];
     $_SESSION['token'] = $token;
     $get_user = "update users set verified = 1 where token = '$token'";
     $run_user = mysqli_query($connect,$get_user);
     header( "refresh:3;url =../dash/examples/dashboard.php" );
     
 }else{
    header( "location:index.php" );
 }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href="assets/images/logo.html" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel = "stylesheet" href="css/verify.css">
    <title>crystalexchange</title>
</head>
<body>
<div class="card bg-light">
  <div class="card-body text-center">
    <h4 class="card-title">You are verified!</h4>
    <p class="card-text">You will be directed to your dashboard shortly</p>
  </div>
</div>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>