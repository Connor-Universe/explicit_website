<?php
 session_start();
 include("../../include/config.php");
 include("../include/security_set.php");

 $get_user = "select * from security";
 $run_user = mysqli_query($connect,$get_user);

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
                      <h3>Security </h3>
                      <h3>Advanced login security settings: </h3>
                  </div>
                  <div class="col-lg-12">
                 <?php echo"$success";?>
                
                  <div class="card">
                        <div class="card-body">
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <?php
                            $row_user = mysqli_fetch_array($run_user);
                            $ip_change1 = $row_user['ip_change'];
                            $change = $row_user['browser_change'];
                            $email1 = $row_user['email'];
                            $checked1 = "";
                            $checked2 = "";
                            $checked3 = "";
                            $checked4 = "";
                            $checked5 = "";
                            $checked6 = "";
                            if($ip_change1 == "disabled"){
                                $checked1 = "checked";
                            }elseif($ip_change1 =="medium"){
                                $checked2 = "checked";
                            }elseif($ip_change1 =="high"){
                                $checked3 = "checked";
                            }elseif($ip_change1 =="paranoic"){
                                $checked4 = "checked";
                            }
                            if($change == "disabled"){
                                $checked5 = "checked";
                            }elseif($change =="enabled"){
                                $checked6 = "checked";
                            }

                            ?>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Detect IP Address Change Sensitivity:</label></br>
                                <input type="radio" class="" id="inputPassword4" value="disabled" name="ip" <?php echo"$checked1";?>>Disabled</br>
                                <input type="radio" class="" id="inputPassword4" value="medium" name="ip"<?php echo"$checked2";?>>Medium</br>
                                <input type="radio" class="" id="inputPassword4" value="high" name="ip" <?php echo"$checked3";?>>High</br>
                                <input type="radio" class="" id="inputPassword4" value="paranoic" name="ip" <?php echo"$checked4";?>>Paranoic</br>
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Detect Browser Change:</label></br>
                                <input type="radio" class="" id="inputPassword4" value="disabled" name="change" <?php echo"$checked5";?>>Disabled</br>
                                <input type="radio" class="" id="inputPassword4" value="enabled" name="change" <?php echo"$checked6";?>> Enabled</br>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Email</label>
                                  <input type="email" class="form-control" value="<?php echo"$email1";?>" name="email"> 
                                </div>
                                <button type = "submit" class="btn btn-primary">Set</button>
                                <div class="form-group col-md-12">
                            <div class="card">
                                <div class="card-body">
                                <p class="card-text">Monitor your template files:
                                This function will monitor template files and once it changed, admin will receive e-mail about changes. It will protect your website against unauthorized changes of your template files. Note: files are checking once in minute if one user is browsing your website atleast.</p>
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
                        <div class="row">
                            <div class="col-lg-12">
                             
                            </div>
                            <div class="col-lg-12">
                            <div class="col-lg-12">
                         
                 <div class="card">
                       <div class="card-body">
                          
                       </div>
                       </div>
                            </div>
                        </div>
                    </div>
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