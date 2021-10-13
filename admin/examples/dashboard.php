<?php
session_start();
  include("../../include/config.php");

  $get_users = "select * from users where verified = 1";
  $run_users = mysqli_query($connect,$get_users);
  $num_users = mysqli_num_rows($run_users);
  if($num_users == ""){
    $num_users = 1;
  }
  $get_users1 = "select * from users where verified = 1 AND Status = 'active'";
  $run_users1 = mysqli_query($connect,$get_users1);
  $num_users1 = mysqli_num_rows($run_users1);
  $get_users2 = "select * from users where verified = 1 AND Status = 'suspend'";
  $run_users2 = mysqli_query($connect,$get_users2);
  $num_users2 = mysqli_num_rows($run_users2);
  $per = ($num_users1 / $num_users) * 100;
  $per = round($per,2);
  $per1 = ($num_users2 / $num_users) * 100;
  $per1 = round($per1,2);
  $get_invest = "select * from investment_request";
  $run_invest = mysqli_query($connect,$get_invest);
  $num_invest = mysqli_num_rows($run_invest);
  $column = array();
  $get_invest1 = "select id_no from investment_request where verified = 1";
  $run_invest1 = mysqli_query($connect,$get_invest1);
  while($array_invest = mysqli_fetch_array($run_invest1)){
    $column[] = $array_invest[0];
  }

  function countDistinct( &$arr, $n)
{
    $res = 1;
 
    // Pick all elements one by one
    for ( $i = 1; $i < $n; $i++)
    {
 
        for ($j = 0; $j < $i; $j++)
            if ($arr[$i] == $arr[$j])
                break;
 
        // If not printed earlier,
        // then print it
        if ($i == $j)
            $res++;
    }
    return $res;
}
 
// Driver Code
$n = count($column);
$unique_invest =  countDistinct($column, $n);
$non_invest = $num_users - $unique_invest;
$num_users4 = ($non_invest / $num_users) * 100;
$num_users3 = ($unique_invest / $num_users) * 100;
$num_users3 = round($num_users3,2);
$num_users4 = round($num_users4,2);
$get_users5 = "select * from plans";
$run_users5 = mysqli_query($connect,$get_users5);
$num_users5 = mysqli_num_rows($run_users5);
  $get_withdraw = "select * from withdraw_request";
  $run_withdraw = mysqli_query($connect,$get_withdraw);
  $num_withdraw = mysqli_num_rows($run_withdraw);
  $get_total_invest = "SELECT SUM(amount_invest) AS value_sum FROM investment_request WHERE verified = 1";
  $run_total_invest = mysqli_query($connect,$get_total_invest);
  $total_invest = mysqli_fetch_assoc($run_total_invest);
  $get_total_invest1 = "SELECT SUM(amount) AS value_sum FROM wallet";
  $run_total_invest1 = mysqli_query($connect,$get_total_invest1);
  $total_invest1 = mysqli_fetch_assoc($run_total_invest1);
  $get_total_invest2 = "SELECT SUM(amount) AS value_sum FROM referals";
  $run_total_invest2 = mysqli_query($connect,$get_total_invest2);
  $total_invest2 = mysqli_fetch_assoc($run_total_invest2);
  $get_total_invest3 = "SELECT SUM(amount) AS value_sum  FROM withdraw_request WHERE verified = 1";
  $run_total_invest3 = mysqli_query($connect,$get_total_invest3);
  $total_invest3 = mysqli_fetch_assoc($run_total_invest3);
  $get_total_invest4 = "SELECT SUM(amount) AS value_sum  FROM withdraw_request WHERE verified = 0";
  $run_total_invest4 = mysqli_query($connect,$get_total_invest4);
  $total_invest4 = mysqli_fetch_assoc($run_total_invest4);
  $date1 = date("Y-m-d");
  $get_total_invest5 = "SELECT SUM(amount_invest) AS value_sum  FROM investment_request WHERE date = '$date1'";
  $run_total_invest5 = mysqli_query($connect,$get_total_invest5);
  $total_invest5 = mysqli_fetch_assoc($run_total_invest5);
  $date2 = date("Y-m-d");
  $get_total_invest6 = "SELECT SUM(amount) AS value_sum  FROM withdraw_request WHERE date = '$date2'";
  $run_total_invest6 = mysqli_query($connect,$get_total_invest6);
  $total_invest6 = mysqli_fetch_assoc($run_total_invest6);
  $date3 = strtotime("-7 days");
  $date3 = date("Y-m-d",$date3);
  $get_total_invest7 = "SELECT SUM(amount_invest) AS value_sum  FROM investment_request WHERE date between '$date3' and  '$date1'";
  $run_total_invest7 = mysqli_query($connect,$get_total_invest7);
  $total_invest7 = mysqli_fetch_assoc($run_total_invest7);
  $date4 = strtotime("-7 days");
  $date4 = date("Y-m-d",$date4);
  $get_total_invest8 = "SELECT SUM(amount) AS value_sum  FROM withdraw_request WHERE date between '$date3' and  '$date1'";
  $run_total_invest8 = mysqli_query($connect,$get_total_invest8);
  $total_invest8 = mysqli_fetch_assoc($run_total_invest8);
  $date5 = strtotime("-30 days");
  $date5 = date("Y-m-d",$date5);
  $get_total_invest9 = "SELECT SUM(amount_invest) AS value_sum  FROM investment_request WHERE date between '$date5' and  '$date1'";
  $run_total_invest9 = mysqli_query($connect,$get_total_invest9);
  $total_invest9 = mysqli_fetch_assoc($run_total_invest9);
  $date6 = strtotime("-30 days");
  $date6 = date("Y-m-d",$date6);
  $get_total_invest10 = "SELECT SUM(amount) AS value_sum  FROM withdraw_request WHERE date between '$date5' and  '$date1'";
  $run_total_invest10 = mysqli_query($connect,$get_total_invest10);
  $total_invest10 = mysqli_fetch_assoc($run_total_invest10);
  $date7 = strtotime("-365 days");
  $date7 = date("Y-m-d",$date7);
  $get_total_invest11 = "SELECT SUM(amount_invest) AS value_sum  FROM investment_request WHERE date between '$date7' and  '$date1'";
  $run_total_invest11 = mysqli_query($connect,$get_total_invest11);
  $total_invest11 = mysqli_fetch_assoc($run_total_invest11);
  $date8 = strtotime("-365 days");
  $date8 = date("Y-m-d",$date8);
  $get_total_invest12 = "SELECT SUM(amount) AS value_sum  FROM withdraw_request WHERE date between '$date7' and  '$date1'";
  $run_total_invest12 = mysqli_query($connect,$get_total_invest12);
  $total_invest12 = mysqli_fetch_assoc($run_total_invest12);
  $get_admin = "select username from admin";
  $run_admin = mysqli_query($connect,$get_admin);
  $row_admin = mysqli_fetch_array($run_admin);
  $username = $row_admin['username'];
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
    Admin Page
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
        <div class="dash">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="first">
                            Information
                        </h3>
                        
                        <div class="card card-nav-tabs">
                      
                        <div class="card-body">
                            <h5 class="card-title">Members:Total: <?php echo"$num_users";?>, Active: <?php echo"$num_users1";?> (<?php echo"$per%";?>), Suspended: <?php echo"$num_users2";?> (<?php echo"$per1%";?>) </h5>
                            <h5 class="card-title">Made a Deposit: <?php echo"$unique_invest";?> , Have Not made a deposit: <?php echo"$non_invest";?> (<?php echo"$num_users4%";?>)</h5>
                            <br>
                            <h5 class="card-title">Investment Packages: Active : <?php echo"$num_users5";?>, Closed: 0, Inactive: 0</h5>
                            <br>
                            <h5 class="card-title">Total System Earnings : $<?php echo"$total_invest[value_sum]";?></h5>
                            <br>
                            <h5 class="card-title">Total Members balance : $<?php echo"$total_invest1[value_sum]";?></h5>
                            <h5 class="card-title">Total Members Deposit : $<?php echo"$total_invest[value_sum]";?></h5>
                            <h5 class="card-title">Current Members Deposit : $<?php echo"$total_invest[value_sum]";?></h5>
                            <h5 class="card-title">Total Referrals Comissions: $<?php echo"$total_invest2[value_sum]";?></h5>
                            <br>
                            <h5 class="card-title">Total Withdrawals : $<?php echo"$total_invest3[value_sum]";?></h5>
                            <h5 class="card-title">Pending Withdrawals: $<?php echo"$total_invest4[value_sum]";?></h5>
                        
                        </div>
                        </div>
                    </div>

                </div>
                <!-- end of row -->
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="second">
                            In/Out Total
                        </h4>
                    </div>
                   
                    <div class="col-lg-12">
             
                    <table class="table">
    <thead>
        <tr>
         
            <th>24 hours</th>
            <th>7 days</th>
            <th>Month</th>
            <th>Year</th>
            <th>Total</th>
         
        </tr>
    </thead>
    <tbody>
    <tr>
         
         <th>IN    OUT</th>
         <th>IN    OUT</th>
         <th>IN    OUT</th>
         <th>IN    OUT</th>
         <th>IN    OUT</th>
      
     </tr>
     <tr>
         
     <th><?php echo"$$total_invest5[value_sum] | $$total_invest6[value_sum]";?></th>
         <th><?php echo"$$total_invest7[value_sum] | $$total_invest8[value_sum]";?></th>
         <th><?php echo"$$total_invest9[value_sum] | $$total_invest10[value_sum]";?></th>
         <th><?php echo"$$total_invest11[value_sum] | $$total_invest12[value_sum]";?></th>
         <th><?php echo"$$total_invest[value_sum] | $$total_invest3[value_sum]";?></th>
      
     </tr>
     <tr>
         
      
      
     </tr>
    

       
    </tbody>
</table>
                    </div>
                    <!-- end -->
                    <div class="col-lg-12">
                    <h4 class="second">
                    Funds In/Out Total
                        </h4>
                    <table class="table">
    <thead>
        <tr>
         
            <th>24 hours</th>
            <th>7 days</th>
            <th>Month</th>
            <th>Year</th>
            <th>Total</th>
         
        </tr>
    </thead>
    <tbody>
    <tr>
         
         <th> IN    OUT</th>
         <th> IN    OUT</th>
         <th> IN    OUT</th>
         <th> IN    OUT</th>
         <th> IN    OUT</th>
      
     </tr>
     <tr>
         
     <th><?php echo"$$total_invest5[value_sum] | $$total_invest6[value_sum]";?></th>
         <th><?php echo"$$total_invest7[value_sum] | $$total_invest8[value_sum]";?></th>
         <th><?php echo"$$total_invest9[value_sum] | $$total_invest10[value_sum]";?></th>
         <th><?php echo"$$total_invest11[value_sum] | $$total_invest12[value_sum]";?></th>
         <th><?php echo"$$total_invest[value_sum] | $$total_invest3[value_sum]";?></th>
      
     </tr>
     <tr>
         
      
      
     </tr>
    

       
    </tbody>
</table>
                      </div>
                    </div><!--end-->
                    <div class="col-lg-6">
                  
                  
                      </div>
                    </div><!--end -->
                    <div class="col-lg-10">
                    <div class="card card-nav-tabs text-center">
                            <div class="card-header card-header-primary">
                               <h3>  <?php echo"$site_name3";?></h3>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-primary">Welcome to the HYIP Manager Admin Area!
You can see help messages on almost all pages of the admin area in this part.</h4>
                                <p class="card-text">You can see how many members are registered in the system on this page.
System supports 3 types of users:</p>
                                <p class="card-text">Suspended users. These users can login to the members area but will not receive any</p>
                                <p class="card-text">Disabled users. These users can not login to the members area and will not receive any earnings.</p>
                                <p class="card-text">
User becomes active when registering and only administrator can change status of any registered user. You can see how many users are active and disabled in the system at the top of this page.
</p>
                                <p class="card-text">Investment packages:
You can create unlimited sets of investment packages with any settings and payout options. Also you can change status of any package.
Active package. All active users will receive earnings every pay period if made a deposit</p>
<p class="card-text">"Total system earnings" is a difference between funds came from payment processings and all the withdrawals you made.
</p>
<p class="card-text">"Total member's balance" shows you how many funds can users withdraw from the system. It is the sum of all users' earnings and bonuses minus penalties and withdrawals.</p>
<p class="card-text">
"Total member's deposit" shows you how many funds have users ever deposited in your system.</p>
<p class="card-text">"Current members' deposit" shows the overall users' deposit.</p>
<p class="card-text">"Total withdrawals" shows you how many funds have you withdrawn to users' accounts</p>
<p class="card-text">"Pending withdrawals" shows you how many funds users have requested to withdraw.</p>
<p class="card-text">In/out stats shows you how many funds users have entered in your system and how many funds have you withdrawn today, this week, this month, this year and total.</p>
                         
                            </div>
                          
                            </div>
                    </div><!--end -->
                </div>
                <!--end of row -->
            </div>
            <div class="row">
                   <div class="col-lg-10">
                
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
</body>

</html>