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
 $reg_date = $row_user['date'];
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
                            Welcome <span class="text-primary"><?php echo"$first_name $last_name";?></span> to your dashboard
                        </h3>
                        
                        <div class="card card-nav-tabs text-center">
                        <h4 class="card-header card-header-info">   <?php echo"$site_name3";?> Id's</h4>
                        <div class="card-body">
                            <h4 class="card-title">Username : <?php echo"$username";?></h4>
                            <h4 class="card-title">ID NO : <?php echo"$id_no";?></h4>
                            <h4 class="card-title">Registration Date : <?php echo"$reg_date";?></h4>
                            <h4 class="card-title">Referal Link: </h4> <input class= "form-control" id="input" type="text" value ="<?php echo"$site_link123";?>/register.php?r=<?php echo"$referal_code";?>" disabled><button class="btn btn-primary" onclick="JSalert()" id="clipboardCopy">Copy</button>
                            <a href="profile.php" class="btn btn-primary">Profile</a>
                        </div>
                        </div>
                    </div>

                </div>
                <!-- end of row -->
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="second">
                            Account Details
                        </h3>
                    </div>
                   
                    <div class="col-lg-6">
                    <div class="card card-nav-tabs text-center">
                      
                      <div class="card-body">
                     
                          <h4 class="card-text text-muted">Account Balance</h4>
                          <h4 class="card-title">$<?php echo"$amount";?> USD</h4>
                          <i style="font-size:5em; margin-top:-70px; margin-left:-60px;" class="tim-icons icon-world"></i>  <a href="wallet.php" class="btn btn-primary">Check Wallet Balance</a>
                         
                      </div>
                  
                      </div>
                    </div>
                    <!-- end -->
                    <div class="col-lg-6">
                    <div class="card card-nav-tabs text-center">
                   
                      <div class="card-body">
                    
                          <h4 class="card-text text-muted">Total Deposit</h4>
                          <h4 class="card-title"> $<?php echo"$total_invest[value_sum]";?> USD</h4>
                          <i style="font-size:5em; margin-top:-70px; margin-left:-60px;" class="tim-icons icon-atom"></i>  <a href="invest.php" class="btn btn-primary">Make A Deposit</a>
                         
                      </div>
                  
                      </div>
                    </div><!--end-->
                    <div class="col-lg-6">
                    <div class="card card-nav-tabs text-center">
                      
                      <div class="card-body">
                      
                          <h4 class="card-text text-muted">Earned Total</h4>
                          <h4 class="card-title">$<?php echo"$final";?> USD</h4>
                          <i style="font-size:5em; margin-top:-70px; margin-left:-60px;" class="tim-icons icon-puzzle-10"></i>   <a href="invest.php" class="btn btn-primary">Check Transaction History</a>
                      </div>
                  
                      </div>
                    </div><!--end -->
                    <div class="col-lg-6">
                    <div class="card card-nav-tabs text-center">
                      
                      <div class="card-body">
                     
                          <h4 class="card-text text-muted">Total Withdrawn</h4>
                          <h4 class="card-title">$<?php echo"$total_withdraw[value_sum]";?> USD</h4>
                          <i style="font-size:5em; margin-top:-70px; margin-left:-60px;" class="tim-icons icon-bell-55"></i><a href="withdraw.php" class="btn btn-primary">Request A Withdrawal;</a>
                      </div>
                  
                      </div>
                    </div><!--end -->
                </div>
               
        </div>
    </div>
<!-- end -->
<div class="col-lg-12">
<a href="invest.php" style="width:100%;" class="btn btn-primary">Make A Deposit</a>
</div>
<div class="col-lg-12">
  <h3>Live Feed</h3>
  <table class="table" style = "width:100%;" id="refer">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Date</th>
            <th>Update Type</th>
            <th>Description</th>
         
        </tr>
    </thead>
    <tbody>
      <?php
       $get_live = "select * from live_feed where id_no = '$id_no' order by id DESC";
       $run_live = mysqli_query($connect,$get_live);
       

       while($row_live = mysqli_fetch_array($run_live)){
        
       $date_live = $row_live['date'];
       $type_live = $row_live['type'];
       $description_live =$row_live['description'];
       $color = "";
       if($type_live=="SIGNUP" OR $type_live=="LOGIN" OR $type_live=="DEPOSIT" OR $type_live=="BONUS" OR $type_live == "COMMISSION" OR $type_live =="PROFILE-CHANGE" OR $type_live=="PASSWORD-CHANGE"){
         $color = "success";
       }else{
         $color = "danger";
       }
       

         echo" <tr>
         <td class='text-center'>*</td>
         <td><a href='#' class='btn btn-primary'>$date_live</a> </br> </td>
         <td><a href='#' class='btn btn-$color'>$type_live</a></td>
         <td><a href='#' class='btn btn-secondary'>$description_live</a> </br></td>
         
     </tr>";
       }
      ?>
      
    </tbody>
</table>

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
      swal("Copied", ", Your Referal Link has been copied !", "success");
    }
          
      
        
        </script>
</body>

</html>