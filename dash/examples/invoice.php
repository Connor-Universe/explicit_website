
 
<?php

session_start();
 include("../../include/config.php");
if(!isset($_SESSION['reference_id']) AND !isset($_SESSION['token'])){
    header("location:../../users/login.php");
}elseif(isset($_SESSION['reference_id']) AND !isset($_SESSION['token'])){
    header("location:../../users/login.php");
}else{
$get_invoice = "select * from investment_request where reference_id = $_SESSION[reference_id]";
$run_invoice = mysqli_query($connect, $get_invoice);
$row_invoice = mysqli_fetch_array($run_invoice);

$first_name = $row_invoice['first_name'];
$last_name = $row_invoice['last_name'];
$plan = $row_invoice['plan'];
$amount = $row_invoice['amount_invest'];
$btc = $row_invoice['btc'];
$reference = $_SESSION['reference_id'];
$coin = $row_invoice['coin'];


 $get_krypto = "select * from crypto_wallet where name = '$coin'";
 $run_krypto = mysqli_query($connect,$get_krypto);
 $row_krypto = mysqli_fetch_array($run_krypto);
 $coin1 = $row_krypto['abb'];
 $wallet =$row_krypto['address'];

}
?>
<?php include "../include/top.php";?>
      <!-- End Navbar -->
      
    <div class="content">
      <div class="wallet">
          <div class="container" id="invoice">
              <div class="row">
                  <div class="col-lg-12">
                      <h3>Investment Invoice</h3>
                      <div class="col-lg-12">
                      <div class='alert alert-success'>
  <strong>REQUEST SENT</strong> Thank you <?php echo "$first_name" ?> for your deposit request! Send the <?php echo"$coin";?> to the wallet address below and wait for confirmation from the <?php echo"$site_name3";?> support team 
</div> 
                      </div>
                  <div class="card card-nav-tabs text-center">
                        <h4 class="card-header card-header-info">Payment</h4>
                        <div class="card-body">
                        <h3>Plan: <?php echo"$plan";?></h3>
                     <h3>Amount(in dollars): <?php echo"$$amount";?></h3>
                     <h3>Amount(in <?php echo"$coin1";?>): <?php echo"$btc";?><?php echo"$coin1";?></h3>
                     <h3>Company <?php echo"$coin";?> address: <input id="input" type = "text" class="form-control" value="<?php echo"$wallet";?>" disabled><button class="btn btn-primary" onclick = "JSalert()"id="clipboardCopy">Copy</button></h3>
                     <h3>Reference No: <?php echo"$reference";?></h3>
                     <h3>Coin: <?php echo"$coin";?></h3>
                     <h3>Name: <?php echo"$first_name $last_name";?></h3>
  </div>
</div>
                      
                  </div>
                  <div class="col-lg-12">

                
                  <div class="card card-nav-tabs text-center">
                            <div class="card-header card-header-primary">
                               <h3>     <?php echo"$site_name3";?> Invoice(PLEASE READ)</h3>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-primary">Disclaimer</h4>
                                <p class="card-text">For your investment request to be verified please send the corresponding bitcoin value to the bitcoin address above</p>
                                <p class="card-text">Then send a screenshot of the payment and send it to our team via the <a href="contact.php">Contact</a> page</p>
                                <p class="card-text">Once our admins have confirmed your payment then your funds will instantly be sent to your wallet</p>
                                <p class="card-text">Once the sufficent number of days have gone by for your investment, you may withdraw your funds via the <a href="withdraw.php" class="">Withdraw</a> page here</p>
                                <p class="card-text">If you have any questions don't hesitate to contact our support team via the chatbox below or through our <a href="contact.php" class="text-primary">"Contact Page"</a></p>
                                <p class="card-text">DO NOT LET ANYONE SEE YOUR INVOICE!</p>
                                <a href="invoice.php#invoice" class="btn btn-primary">Go Up</a>
                            </div>
                          
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
  <script>
  

  /* Get the text field */

  var copyText = document.getElementById("input");
document.getElementById('clipboardCopy').addEventListener('click', clipboardCopy);
async function clipboardCopy() {
  let text = document.querySelector("#input").value;
  await navigator.clipboard.writeText(text);
}




  </script>
  <script type='text/javascript'>
      
      function JSalert(){
      swal("Copied", ", The Wallet Address has been copied !", "success");
    }
          
      
        
        </script>
</body>

</html>