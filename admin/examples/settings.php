<?php
 session_start();
 include("../../include/config.php");
 include("../include/site_change.php");

 $get_user = "select * from settings";
 $run_user = mysqli_query($connect,$get_user);
 $row_user = mysqli_fetch_array($run_user);

 $location = $row_user['location2'];
 $phone = $row_user['phone'];
 $email= $row_user['email'];
 $wallet = $row_user['wallet'];
 $password = $row_user['password'];
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
                      <h3>Main Settings </h3>
                  </div>
                  <div class="col-lg-12">
                 
                  <div class="card">
                        <div class="card-body">
                            <form>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Site Name:</label>
                                <input type="text" class="form-control" id="inputEmail4" value="" name="site_name" >
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Site Url:</label>
                                <input type="text" class="form-control" id="inputPassword4" value="" name="site_url">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Redirect To Https:</label>
                                   <select name="redirect_https" id="" class='form-control'>
                                   <option value="no">No</option>
                                   <option value="yes">Yes</option>
                                   </select> 
                                </div>
                                <div class="form-group col-md-12">
                                <label for="inputPassword4">Start Date</label>
                                <input type="date" class="form-control" name="date" id="inputPassword4" value="" >
                                </div>
                                <div class="form-group col-md-12">
                            <div class="card">
                                <div class="card-body">
                                <p class="card-text">Site name: your site title.
Site url: your site url, without tailing slash (http://yoursite.com for example).
Start day: shows days online. Select the date you have launched your site here.</p>
                                </div>
                            </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="">Processings:</label>
                                <a href="processings.php">Processings Setup Is Here</a>
                                </div>
                                <br>
                               
                                <div class="form-group col-md-12">
                                <label for="">Administrator login settings</label>
                                <label for="">Login</label>
                                <input type="text" class="form-control" id="inputPassword4" value="" name="login">
                                </div>
                                <div class="form-group col-md-12">
                          
                                <label for="">Password</label>
                                <input type="text" class="form-control" id="inputPassword4" value="" name="password">
                                </div>
                                <div class="form-group col-md-12">
                          
                          <label for="">Retype Password</label>
                          <input type="text" class="form-control" id="inputPassword4" value="" name="password2">
                          </div>
                          <div class="form-group col-md-12">
                          
                          <label for="">Administrative Email</label>
                          <input type="text" class="form-control" id="inputPassword4" value="" name="email">
                          </div>
                          <div class="form-group col-md-12">
                          
                          <label for="">Adminstrative Password</label>
                          <input type="text" class="form-control" id="inputPassword4" value="" name="password_email">
                          </div>
                          <div class="form-group col-md-12">
                          
                          <label for="">Admin Area Charset:</label>
                          <input type="text" class="form-control" id="inputPassword4" value="" name="charset">
                          </div>
                          <div class="form-group col-md-12">
                          
                          <label for="">Show Google translate</label>
                          <select name="translate" id="" class='form-control'>
                                   <option value="no">No</option>
                                   <option value="yes">Yes</option>
                                   </select> 
                          </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="">Reverse left and right columns</label>
                                <select name="reverse" id="" class='form-control'>
                                   <option value="no">No</option>
                                   <option value="yes">Yes</option>
                                   </select> 
                                </div>
                                <br>
                               
                                <div class="form-group col-md-12">
                                <label for="">Deny Registerations</label>
                                <select name="deny" id="" class='form-control'>
                                   <option value="no">No</option>
                                   <option value="yes">Yes</option>
                                   </select> 
                                </div>
                                <div class="form-group col-md-12">
                          
                                <label for="">Double opt-in during registration:
Confirm email address on signup</label>
<select name="confirm" id="" class='form-control'>
                                   <option value="no">No</option>
                                   <option value="yes">Yes</option>
                                   </select> 
                                </div>
                                <div class="form-group col-md-12">
                          
                          <label for="">System email</label>
                          <input type="text" class="form-control" id="inputPassword4" value="" name="system_email">
                          </div>
                          <div class="form-group col-md-12">
                          
                          <label for="">Support Email</label>
                          <input type="text" class="form-control" id="inputPassword4" value="" name="support_email">
                          </div>
                          <div class="form-group col-md-12">
                          
                          <label for="">Enable Calculator</label>
                          <select name="calculator" id="" class='form-control'>
                                   <option value="no">No</option>
                                   <option value="yes">Yes</option>
                                   </select> 
                          </div>
                          <div class="form-group col-md-12">
                          
                          <label for="">Use double entry accounting:</label>
                          <select name="accounting" id="" class='form-control'>
                                   <option value="no">No</option>
                                   <option value="yes">Yes</option>
                                   </select>
                          </div>
                          <div class="form-group col-md-12">
                          
                          <label for="">Show "Tell a friend" page:	</label>
                          <select name="tell_friend" id="" class='form-control'>
                                   <option value="no">No</option>
                                   <option value="yes">Yes</option>
                                   </select> 
                          </div>
                          <div class="form-group col-md-12">
                          
                          <label for="">After user logout move him to:		</label>
                          <select name="logout" id="" class='form-control'>
                                   <option value="no">Home</option>
                                   <option value="yes">Login</option>
                                   </select> 
                          </div>
                          <div class="form-group col-md-12">
                            <div class="card">
                                <div class="card-body">
                                <p class="card-text">Double opt-in when registering: Select 'yes' if a user has to confirm the registration. An E-mail with the confirmation code will be sent to the user after he had submitted the registration request.
Opt-in e-mail: Confirmation messages will be sent from this e-mail account.
System e-mail: All system messages will be sent from this e-mail account.
Use user location fields: Adds "Address", "City", "State", "Zip" and "Country" fields to user's profile.
Use double entry accounting: This mod is used for the transactions history screen in both users and admin areas. It shows three different columns - "Debit", "Credit" and "Balance" instead of one "Amount" field.
Redirect to HTTPS: Redirects users from HTTP to HTTPS. Use this option only if you can access your site using https. You should go to <a href='https://lumaexchange.com'>https://www.lumaexchange.com/</a> and your site will be displayed if the HTTPS is supported.
Reverse left and right columns. If the (this) box is unchecked, the user menu will be located on the left and news box on the right. If checked: news on the left, user menu on the right</p>
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
                                <h3>Edit Profile</h3>
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