<?php 
include "../../include/config.php";
$get_user123 = "select * from users where token = '$_SESSION[token]'";
 $run_user123 = mysqli_query($connect,$get_user123);
 $row_user123 = mysqli_fetch_array($run_user123);
 $id_no123 = $row_user123['id_no'];
 $date = date("Y-m-d H:i:s");
 $yes = "";
if(!isset($_SESSION['token']))
{
    // not logged in
    $yes = "
    <script type='text/javascript'>
    
    
    
      swal('Account Removed!', ', You Need To Login!', 'success');
    
    </script>";

    echo"
    <script>
setTimeout(function(){
   window.location.href = '../../login.php';
}, 1500);
</script>" ;
    exit();
}elseif(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['token']);
    $insert_feed = "INSERT INTO live_feed (date,type,description,id_no) VALUES('$date','LOGOUT','You logged out of your account ','$id_no123')";
    $run_feed =mysqli_query($connect,$insert_feed);
    $yes = "
    <script type='text/javascript'>
    
    
      swal({
        title: 'LOGOUT!',
        text: 'You are logging out',
        icon: 'warning',
        button: 'Okay'
      });
    
    
    </script>";

    echo"
    <script>
setTimeout(function(){
   window.location.href = '../../login.php';
}, 2000);
</script>" ;
  
  
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../images/favicon.png">
  <title>
   <?php echo"$site_name3";?>
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <!-- Smartsupp Live Chat script -->
  <script src="<?php echo"$chat";?>" async></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="white-content">
<div class="wrapper">
    <div class="sidebar">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
      <div class="sidebar-wrapper">
        <div class="logo">
        <a href="dashboard.php" class="simple-text logo-normal">
         <img src="../../images/logo1.png" alt="">
          </a>
          <a href="dashboard.php" class="simple-text ">
          
          </a>
        </div>
        <ul class="nav">
        <li >
            <a href="">
            
              <h5 style="color:white;">Account No: <?php echo"$id_no123";?></h5>
            </a>
          </li>
          <li >
            <a href="./dashboard.php">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li >
            <a href="./invest.php">
              <i class="tim-icons icon-atom"></i>
              <p>Investment Plans</p>
            </a>
          </li>
          <li>
            <a href="../include/wallet_process.php">
              <i class="tim-icons icon-pin"></i>
              <p>Wallet</p>
            </a>
          </li>
          <li>
            <a href="./withdraw.php">
              <i class="tim-icons icon-bell-55"></i>
              <p>Withdraw Funds</p>
            </a>
          </li>
          <li>
            <a href="./history.php">
              <i class="tim-icons icon-single-02"></i>
              <p>Transaction History</p>
            </a>
          </li>
          <li>
            <a href="./profile.php">
              <i class="tim-icons icon-single-02"></i>
              <p>Profile</p>
            </a>
          </li>
          <li>
            <a href="./password.php">
              <i class="tim-icons icon-single-02"></i>
              <p>Change Password</p>
            </a>
          </li>
          <?php
          if($program_settings == 1){
            echo"
            <li>
            <a href='./refer.php'>
              <i class='tim-icons icon-puzzle-10'></i>
              <p>Referal List</p>
            </a>
          </li>
      
            ";

          }else{
            echo"";
          }
          
          ?>
            <li>
            <a href="./company.php">
              <i class="tim-icons icon-align-center"></i>
              <p>Performance</p>
            </a>
          </li>
          <li>
            <a href="./rates.php">
              <i class="tim-icons icon-world"></i>
              <p>crypto Rates</p>
            </a>
          </li>
          <li>
          <a href="./contact.php">
              <i class="tim-icons icon-world"></i>
              <p>Contact Us</p>
            </a>
          </li>
      
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:void(0)"></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
              
            
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo">
                    <img src="../assets/img/anime3.png" alt="Profile Photo">
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="nav-link"><a href="profile.php" class="nav-item dropdown-item">Profile</a></li>
                  <li class="nav-link"><a href="profile.php" class="nav-item dropdown-item">Settings</a></li>
                  <li class="dropdown-divider"></li>
                  <li class="nav-link"><a href="?logout=true" class="nav-item dropdown-item">Log out</a></li>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>