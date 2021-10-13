
<?php
session_start();
include("../../include/config.php");

    $page = $_SERVER['PHP_SELF'];
     $sec = "86400";
     $get_user = "select id_no from users where token='$_SESSION[token]'";
     $run_user = mysqli_query($connect,$get_user);
     $row_user = mysqli_fetch_array($run_user);
     $id_no = $row_user['id_no'];

     $get_amount = "select amount from wallet where id_no= $id_no";
     $run_amount = mysqli_query($connect,$get_amount);
     $row_amount = mysqli_fetch_array($run_amount);
     $amount = $row_amount['amount'];
     if(!isset($amount) || $amount == 0){
       $dis = "disabled";
       $amount <= 0;
     }else{
       $dis="";
     }
     ?>
     <?php include "../include/top.php";?>
      <!-- End Navbar -->
      
    <div class="content">
      <div class="wallet">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12" id="wallet">
                      <h3>Wallet</h3>
                  </div>
                  <div class="col-lg-12">
                  <div class="card card-nav-tabs text-center">
                            <div class="card-header card-header-primary">                        
                                <h3>$<?php echo"$amount";?> USD</h3>
                                <h5>Available balance</h5>
                                <a href="withdraw.php" class="btn btn-primary" <?php echo"$dis";?>>Withdraw</a>
                            </div>
                           
                            </div>
                            <!-- end -->
                  </div>
              </div>
              <!--end -->
              <div class="col-lg-6">

              </div>
              <!-- end -->
              <div class="col-lg-12">
              <div class="card card-nav-tabs text-center">
                            <div class="card-header card-header-primary">
                               <h3>     <?php echo"$site_name3";?> Wallet(PLEASE READ)</h3>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-primary">Disclaimer</h4>
                                <p class="card-text">You may withdraw from your wallet once the sufficent time for ROI(Return On Investment) has been completed  </p>
                              <p class="card-text">Your wallet will be activated once the admins have verified your payments, this can take between 12hrs-24hrs </p>
                              <p class="card-text">when you are ready to withdraw funds from your wallet you can click the withdraw button and you will be taken to the <a href="withdaw.php">Withdraw</a> page</p>
                                <p class="card-text">Once the sufficent number of days have gone by for your investment, you may withdraw your funds via the <a href="withdraw.php" class="">Withdraw</a> page here</p>
                                <p class="card-text">If you have any questions don't hesitate to contact our support team via the chatbox below or through our <a href="contact.php" class="text-primary">"Contact Page"</a></p>
                                <p class="card-text">CONTACT US IF YOU HAVE ANY ISSUES!</p>
                                <a href="wallet.php#wallet" class="btn btn-primary">Go Up</a>
                            </div>
                          
                            </div>
               </div>
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