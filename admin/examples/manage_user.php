<?php
 session_start();
 include("../../include/config.php");
 $id_no = $_GET['id_no'];
 $get_total_invest0 = "SELECT SUM(amount_invest) AS value_sum FROM investment_request WHERE id_no =$id_no";
 $run_total_invest0 = mysqli_query($connect,$get_total_invest0);
 $total_invest0 = mysqli_fetch_assoc($run_total_invest0);
 $get_total_invest = "SELECT SUM(amount_invest) AS value_sum FROM investment_request WHERE verified = 1";
 $run_total_invest = mysqli_query($connect,$get_total_invest);
 $total_invest = mysqli_fetch_assoc($run_total_invest);
 $get_total_invest1 = "SELECT SUM(amount) AS value_sum FROM wallet WHERE id_no =$id_no";
 $run_total_invest1 = mysqli_query($connect,$get_total_invest1);
 $total_invest1 = mysqli_fetch_assoc($run_total_invest1);
 $get_total_invest2 = "SELECT SUM(amount) AS value_sum FROM referals WHERE id_no =$id_no";
 $run_total_invest2 = mysqli_query($connect,$get_total_invest2);
 $total_invest2 = mysqli_fetch_assoc($run_total_invest2);
 $get_total_invest3 = "SELECT SUM(amount) AS value_sum  FROM withdraw_request WHERE verified = 1 and id_no =$id_no";
 $run_total_invest3 = mysqli_query($connect,$get_total_invest3);
 $total_invest3 = mysqli_fetch_assoc($run_total_invest3);
 $get_total_invest4 = "SELECT SUM(amount) AS value_sum  FROM withdraw_request WHERE verified = 0 and id_no =$id_no";
 $run_total_invest4 = mysqli_query($connect,$get_total_invest4);
 $total_invest4 = mysqli_fetch_assoc($run_total_invest4);
 $get_total_invest5 = "SELECT SUM(amount) AS value_sum FROM bonus WHERE id_no =$id_no";
 $run_total_invest5 = mysqli_query($connect,$get_total_invest5);
 $total_invest5 = mysqli_fetch_assoc($run_total_invest5);
 $get_total_invest6 = "SELECT SUM(amount) AS value_sum FROM penalty WHERE id_no =$id_no";
 $run_total_invest6 = mysqli_query($connect,$get_total_invest6);
 $total_invest6 = mysqli_fetch_assoc($run_total_invest6);
 $get_total_invest7 = "SELECT SUM(amount) AS value_sum FROM investments WHERE id_no = $id_no";
 $run_total_invest7 = mysqli_query($connect,$get_total_invest7);
 $total_invest7 = mysqli_fetch_assoc($run_total_invest7);
 $get_bonus = "SELECT SUM(amount) AS value_bonus FROM bonus where id_no = $id_no";
$run_bonus = mysqli_query($connect,$get_bonus);
$fetch_bonus = mysqli_fetch_assoc($run_bonus);
$get_referal = "SELECT SUM(amount) AS value_referal FROM referals where id_no = $id_no";
$run_referal = mysqli_query($connect,$get_referal);
$fetch_referal = mysqli_fetch_assoc($run_referal);
$get_referal1 = "SELECT *  FROM referals where id_no = $id_no";
$run_referal1 = mysqli_query($connect,$get_referal1);
$fetch_referal1 = mysqli_num_rows($run_referal);
$get_funds = "SELECT SUM(amount) AS value_adds FROM add_funds where id_no = $id_no";
$run_funds = mysqli_query($connect,$get_funds);
$fetch_funds = mysqli_fetch_assoc($run_funds);
$final = $fetch_funds['value_adds'] + $fetch_bonus['value_bonus'] + $fetch_referal['value_referal'] + $total_invest7['value_sum'];
 $get_user = "select * from users where id_no = $id_no";
 $run_user_id = mysqli_query($connect,$get_user);
 $row_user = mysqli_fetch_array($run_user_id);
 $first_name = $row_user['first_name'];    
 $last_name = $row_user['last_name'];
 $email = $row_user['email'];
 $wallet = $row_user['wallet'];
 $username = $row_user['username'];
 $country = $row_user['country'];
 $password = $row_user['password_user'];
 $ip = $row_user['ip'];
 $id = $row_user['id'];
 $status = $row_user['Status'];
 $get_last = "select * from last_access where id_no = $id_no order by id DESC limit 0,1";
 $run_last = mysqli_query($connect,$get_last);
 $row_last = mysqli_fetch_array($run_last);
 $date1 = $row_last['date'];


 if(!isset($_SESSION['username']))
 {
     // not logged in
     header("location:../../admin.php");
     echo"<script>alert('This page is for admins only !')</script>";
     exit();
 }elseif(isset($_GET['logout'])){
     session_destroy();
     unset($_SESSION['username']);
     header("location:../../admin.php");
     echo"<script>alert('Your are logging out!')</script>";
 }elseif(!isset($id_no)){
     header("location:members.php");
 }
 

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Admin page
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
</head>

<body class="">
<div class="wrapper">
    <div class="sidebar">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
    <div class="sidebar-wrapper">
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
             
          </a>
          <a href="javascript:void(0)" class="simple-text logo-normal">
            Admin Page
          </a>
        </div>
       <?php include "../include/left.php";?>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
    <?php include "../include/top.php";?>
    
      <!-- End Navbar -->
      
    <div class="content">
      <div class="wallet">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <h3>User Details </h3>
                  </div>
                  <div class="col-lg-12">
                 
                  <div class="card">
                        <div class="card-body">
                            <form>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Username</label>
                                <input type="text" class="form-control" id="inputEmail4" value="<?php echo"$username";?>" readonly >
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Full Name</label>
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo"$first_name $last_name";?>"readonly>
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Email</label>
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo"$email";?>" readonly>
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Processings</label>
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo"$wallet";?>" readonly>
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Total balance</label>
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo"$$total_invest1[value_sum]";?>" readonly><a href='fund_history.php' class="btn btn-primary" >History</a>
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Total Deposit</label>
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo"$$total_invest0[value_sum]";?>" readonly><a href='deposit_history.php' class="btn btn-primary" >History</a>
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Active Deposit</label>
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo"$$total_invest[value_sum]";?>" readonly><a href='pending_deposit.php' class="btn btn-info" >Manage Deposit</a>
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Total Earnings</label>
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo"$$final";?>" readonly><a href='earning_history.php' class="btn btn-primary" >Earning History</a>
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Total Withdrawn</label>
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo"$$total_invest3[value_sum]";?>" readonly><a href='withdraw_history.php' class="btn btn-primary" >History</a>
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Pending Withdrawals</label>
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo"$$total_invest4[value_sum]";?>"readonly><a href='withdraw_request.php' class="btn btn-info" >Process Withdrawals</a>
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Total Bonus</label>
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo"$$total_invest5[value_sum]";?>" readonly><a href='bonus.php' class="btn btn-danger" >Send a bonus </a><a href='bonuses.php' class="btn btn-primary" >History</a>
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Total Penalty</label>
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo"$$total_invest6[value_sum]";?>" readonly><a href='penalty.php' class="btn btn-danger" >Send a Penalty </a><a href='penalties.php' class="btn btn-primary" >History</a>
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Referal 1st Level</label>
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo"$fetch_referal1";?>" readonly><a href='referals.php' class="btn btn-info" >Referals </a><a href='referal_earning.php' class="btn btn-success" >Traffic</a>
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Referal Comission</label>
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo"$$total_invest2[value_sum]";?>" readonly><a href='referal_earning.php' class="btn btn-info" >History</a>
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">User Ip Address</label>
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo"$ip";?>" readonly>
                                </div>
                            </div>
                           
                            <table class="table">
                            <thead>
        <tr>
          
            <th>IP</th>
            <th>Last Access</th>
           
        </tr>
    </thead>
    <tbody>
    <td>
    <?php echo"$ip";?>
    </td>
    <td>
    <?php echo"$date1";?>
    </td>
    </tbody>
                            </table>
                  
                            <div class="form-row">
                              
                          <div class="form-group col-md-12">
                            <div class="card">
                                <div class="card-body">
                                <p class="card-text">Manage user funds:
Account balance: how many funds can the user deposit to any investment package or withdraw from the system.
Total deposit: how many funds has the user ever deposited to your system.
Total active deposit: the whole current deposit of this user.
Total earnings: how many funds has the user ever earned with your system.
Total withdrawals: how many funds has the user ever withdrawn from system.
Total bonus: how many funds has the administrator ever added to the user account as a bonus.
Total penalty: how many funds has the administrator ever deleted from the user account as a penalty.
Actions:
Transactions history - you can check the transactions history for this user.
Active deposits/Transactions history - you can check the deposits history for this user.
Earnings history - you can check the earnings history for this user.
Withdrawals history - you can check the withdrawals history for this user.
Process withdrawals - you can withdraw funds by clicking this link if a user asked you for a withdrawal.
Bonuses history - you can check the bonuses history for this user.
Penalties history - you can check the penalties history for this user.
Add a bonus and add a penalty - add a bonus or a penalty to this user.</p>
                                </div>
                            </div>
                                </div>
                            </div>
                    
                            </form>
                        </div>
                        </div>

                  <!-- end of form -->
                  <!-- start of form -->
                    <div class="container" id="change">
                        
                  <!-- end of form -->
              </div>
          </div>
      </div>
    
    </div>
    <!-- end of content section -->
    <?php include "../include/footer.php";?>
    </div>
  </div>
   <?php include('../include/side.php');?>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- Place this tag in your head or just before your close body tag. -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');
        $navbar = $('.navbar');
        $main_panel = $('.main-panel');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;
        white_color = false;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



        $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .background-color span').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data', new_color);
          }

          if ($main_panel.length != 0) {
            $main_panel.attr('data', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data', new_color);
          }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            sidebar_mini_active = false;
            blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
          } else {
            $('body').addClass('sidebar-mini');
            sidebar_mini_active = true;
            blackDashboard.showSidebarMessage('Sidebar mini activated...');
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);
        });

        $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (white_color == true) {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').removeClass('white-content');
            }, 900);
            white_color = false;
          } else {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').addClass('white-content');
            }, 900);

            white_color = true;
          }


        });

        $('.light-badge').click(function() {
          $('body').addClass('white-content');
        });

        $('.dark-badge').click(function() {
          $('body').removeClass('white-content');
        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "black-dashboard-free"
      });
  </script>
    <script>		
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>

</html>