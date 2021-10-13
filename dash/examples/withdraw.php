<?php
session_start();
include("../include/withdraw_process.php");
$get_user = "select * from users where token = '$_SESSION[token]'";
$run_user = mysqli_query($connect,$get_user);
$row_user = mysqli_fetch_array($run_user);
$id_no = $row_user['id_no'];
$get_wallet = "select amount from wallet where id_no = $id_no";
$run_wallet = mysqli_query($connect,$get_wallet);
$row_wallet = mysqli_fetch_array($run_wallet);
$get_crypto = "select * from crypto_wallet";
$run_crypto = mysqli_query($connect,$get_crypto);
$amount = $row_wallet['amount'];
if($amount <= 0 || !isset($amount)){
  $dis = "disabled";
}else{
  $dis ="";
}
?>
<?php include "../include/top.php";?>
      <!-- End Navbar -->
      
    <div class="content">
      <div class="wallet">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <h3>Withdraw Funds</h3>
                  </div>
                  <div class="col-lg-12">
                 
                  <div class="card">
                    <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="form-group">
                            <label for="amount">Withdraw Amount(in dollars)</label>
                            <input type="number" <?php echo"$dis";?> class="form-control" id="amount" name="amount"aria-describedby="Amount" min="5" max="<?php echo"$amount";?>" placeholder="Enter Withdraw Amount" required>
                             <select class="form-control" name="coin" required>
        
                             <?php
      
      while($row_crypto = mysqli_fetch_array($run_crypto)){
        $name = $row_crypto['name'];
        $abb = $row_crypto['abb'];
        echo"<option value='$abb'>$name</option>";
      } 
       ?>
        </select>
                            
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Wallet Address</label>
                            <input type="text" class="form-control" id="btc" placeholder="Enter receiving bitcoin address" name ="wallet" <?php echo"$dis";?> required>
                        </div>
                        <small id="amount"  class="form-text text-muted">We'll never share your Wallet address and other personal details with anyone else!.</small>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="">
                                Remember this Wallet address?
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>

                        <button type="submit"  class="btn btn-primary" <?php echo"$dis";?>>Submit</button>
                        </form>
                    </div>
                    </div>

                  <!-- end of form -->
              </div>
          </div>
      </div>
      <div class="container">
           <div class="row">
               <div class="col-lg-12">
               <div class="card card-nav-tabs text-center">
                            <div class="card-header card-header-primary">
                               <h3>     <?php echo"$site_name3";?> Withdraw</h3>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-primary">Disclaimer</h4>
                                <p class="card-text">Withdrawl can be done at any time, all you have to do is input the amount you want to withdraw(in dollars) enter a valid receiving bitcoin address and click submit! Your Withdrawl request will be processed by our admins and you will be credited within 5mins</p>
                                <p class="card-text">If you have any questions don't hesitate to contact our support team via the chatbox below or through our <a href="contact.php" class="text-primary">"Contact Page"</a></p>
                                <p class="card-text">THE MINIMUM YOU CAN WITHDRAW IS 5 DOLLARS AND ONCE YOUR INVESTMENT PLAN HAS EXPIRED YOU WILL AUTOMATICALLY GET CREDITED INTO YOUR DEFAULT CRYPTO WALLET</p>
                                <a href="invest.php#invest" class="btn btn-primary">Go Up</a>
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