<?php
 session_start();
 include("../../include/config.php");

 $get_user = "select * from users where token = '$_SESSION[token]'";
 $run_user = mysqli_query($connect,$get_user);
 $row_user = mysqli_fetch_array($run_user);

 $first_name = $row_user['first_name'];
 $last_name = $row_user['last_name'];
 $email = $row_user['email'];
 $wallet = $row_user['wallet'];
 $username = $row_user['username'];
 $country = $row_user['country'];
 $password = $row_user['password_user'];
 $id_no = $row_user['id_no'];
 $referal_code = $row_user['promo_code'];
 $get_total_invest = "SELECT SUM(amount) AS value_sum FROM investments WHERE id_no = $id_no";
  $run_total_invest = mysqli_query($connect,$get_total_invest);
  $total_invest = mysqli_fetch_assoc($run_total_invest);
  $get_bonus = "SELECT SUM(amount) AS value_bonus FROM bonus where id_no = $id_no";
$run_bonus = mysqli_query($connect,$get_bonus);
$fetch_bonus = mysqli_fetch_assoc($run_bonus);
$get_referal = "SELECT SUM(amount) AS value_referal FROM referals where id_no = $id_no";
$run_referal = mysqli_query($connect,$get_referal);
$fetch_referal = mysqli_fetch_assoc($run_referal);
$get_funds = "SELECT SUM(amount) AS value_adds FROM add_funds where id_no = $id_no";
$run_funds = mysqli_query($connect,$get_funds);
$fetch_funds = mysqli_fetch_assoc($run_funds);
$final = $fetch_funds['value_adds'] + $fetch_bonus['value_bonus'] + $fetch_referal['value_referal'] + $total_invest['value_sum'];
  $get_total_withdraw = "SELECT SUM(amount) AS value_sum FROM withdraw_request WHERE verified = 1 AND id_no =$id_no";
  $run_total_withdraw = mysqli_query($connect,$get_total_withdraw);
  $total_withdraw = mysqli_fetch_assoc($run_total_withdraw);
  $get_wallet = "select amount from wallet where id_no = $id_no";
  $run_wallet = mysqli_query($connect,$get_wallet);
  $row_wallet = mysqli_fetch_array($run_wallet);
  $amount = $row_wallet['amount'];

  if(!isset($total_invest['value_sum'])){
    $total_invest['value_sum'] = 0;
  }
  if(!isset($total_withdraw['value_sum'])){
    $total_withdraw['value_sum'] = 0;
  }
  if(!isset($amount)){
    $amount = 0;
  }

   $get_usersss = "select * from investment_request where id_no = $id_no ";
 $run_usersss = mysqli_query($connect,$get_usersss);
 $get_users = "select * from withdraw_request where id_no = $id_no ";
 $run_users = mysqli_query($connect,$get_users);
 $get_userss ="select * from users where id_no = $id_no";
 $run_userss  = mysqli_query($connect,$get_userss);
  $row_userss = mysqli_fetch_array($run_userss);
 $first_name = $row_userss['first_name'];
 $last_name = $row_userss['last_name'];
 $referal_code1 = $row_userss['promo_code'];

 $get_refer = "select * from users where referal_code = '$referal_code1'";
 $run_refer = mysqli_query($connect,$get_refer);
 ?>
<?php include "../include/top.php";?>
      <!-- End Navbar -->
      
    <div class="content">
        <div class="dash">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="first">
                        Transactions
                        </h3>
                        
                       
                    </div>

                </div>
                <!-- end of row -->
                <div class="row">
                
                <div class="col-lg-12">
                <h3> Transaction History </h3>
                  <h4>Investment History</h4>
                 <table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>email</th>
            <th>wallet</th>
            <th>plan</th>
            <th>reference Id</th>
            <th>btc/ltc/eth</th>
            <th>country</th>
                <th> status </th>
           
        </tr>
    </thead>
    <tbody>
    
        <?php
        while($row_usersss = mysqli_fetch_array($run_usersss)){
            $id = $row_usersss['id'];
          $email = $row_usersss['email'];
          $wallet = $row_usersss['wallet'];
          $plan = $row_usersss['plan'];
          $reference = $row_usersss['reference_id'];
          $btc = $row_usersss['btc'];
          $country = $row_usersss['country'];
         $id_no = $row_usersss['id_no'];
         $status1 = $row_usersss['verified'];
         if($status1 == 0){
             $statuss = "Pending";
         }else{
             $statuss = "Completed";
         }
          echo"
          <tr>
           <td>$id</td>
           <td>$email</td>
           <td>$wallet</td>
           <td>$plan</td>
           <td>$reference</td>
           <td>$btc</td>
           <td>$country</td>
            <td> $statuss </td>
          </tr>
          ";
        }
        ?>
       
    </tbody>
</table>
                 </div>
                   <div class="col-lg-12">
                   <h4>Withdrawal History</h4>
                   <table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>

            <th>wallet</th>
            <th>amount</th>
            <th>reference Id</th>
            <th>btc/ltc/eth</th>
            <th>transaction id</th>
            <th> status </th>
           
        </tr>
    </thead>
    <tbody>
    
        <?php
        while($row_users = mysqli_fetch_array($run_users)){
            $id1 = $row_users['id'];
  
          $wallet1 = $row_users['wallet'];
          $amount = $row_users['amount'];
          $reference1 = $row_users['reference_no'];
          $btc1 = $row_users['btc'];
          $transaction = $row_users['transaction_id'];
  $status1 = $row_users['verified'];
         if($status1 == 0){
             $statuss = "Pending";
         }else{
             $statuss = "Completed";
         }
          echo"
          <tr>
           <td>$id1</td>

           <td>$wallet1</td>
           <td>$amount</td>
           <td>$reference1</td>
           <td>$btc1</td>
           <td>$transaction</td>
           <td> $statuss </td>
     
          </tr>
          ";
        }
        ?>
       
    </tbody>
</table>
                   </div>
                   <div class="col-lg-12">
                   <h4>Referal History</h4>
                   <table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>

            <th>Name</th>
            <th>email</th>
            <th>country</th>
            <th>wallet</th>
            <th>id_no</th>
           
        </tr>
    </thead>
    <tbody>
    
        <?php
        while($row_refer = mysqli_fetch_array($run_refer)){
            $id_refer = $row_refer['id'];
  
            $wallet_refer = $row_refer['wallet'];
            $id_no_refer= $row_refer['id_no'];
            $first_refer = $row_refer['first_name'];
            $last_refer = $row_refer['last_name'];
            $email_refer = $row_refer['email'];
            $country_refer  = $row_refer['country'];
        if($show_settings == 1){
          echo"
          <tr>
           <td>$id_refer</td>

           <td>$first_refer $last_refer</td>
           <td>$email_refer</td>
           <td>$country_refer</td>
           <td>$wallet_refer</td>
           <td>$id_no_refer</td>
     
          </tr>
          ";
        }else{
          echo"";
        }
        
        }
        ?>
       
    </tbody>
</table>
                 </div>
                <!--end of row -->
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
</body>

</html>