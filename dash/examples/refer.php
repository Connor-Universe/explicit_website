<?php
 session_start();
 include("../../include/config.php");


 $get_user = "select * from users where token = '$_SESSION[token]'";
 $run_user = mysqli_query($connect,$get_user);
 $row_user = mysqli_fetch_array($run_user);

 $first_name2 = $row_user['first_name'];
 $last_name2 = $row_user['last_name'];
 $email2= $row_user['email'];
 $wallet2 = $row_user['wallet'];
 $username2 = $row_user['username'];
 $country2 = $row_user['country'];
 $password2 = $row_user['password_user'];
 $id_no2 = $row_user['id_no'];
 $referal_code2 = $row_user['referal_code'];
 $promo = $row_user['promo_code'];

 ?>
<?php include "../include/top.php";?>
      <!-- End Navbar -->
      
    <div class="content">
    <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h3>Referal Link</h3>
                          <div class="card card-nav-tabs text-center">
                <div class="card-body">
                  <input type= "text" value="<?php echo"$site_link123";?>/register.php?r=<?php echo "$promo";?>" class="form-control" id="input" disabled> <button id="clipboardCopy" onclick="JSalert()" class="btn btn-primary">Copy</button>
                  <h5 class="card-title">Copy this code, refer someone else to this platform and earn a comission on each purchase</h5>
                </div>
              </div>
              <!-- end of card -->
          </div>
            <div class="col-lg-12">
                <h3>Referal List</h3>
                
            </div>
               <div class="col-lg-12">
            <h3>Referees</h3>
            <table class="table" id="refer">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Country</th>
         
        </tr>
    </thead>
    <tbody>
      <?php
       $get_refer1 = "select * from users where referal_code = '$promo'";
       $run_refer1 = mysqli_query($connect,$get_refer1);
       

       while($row_refer1 = mysqli_fetch_array($run_refer1)){
        
         $first_name_refer1 = $row_refer1['first_name'];
         $last_name_refer1 = $row_refer1['last_name'];
         $country_refer1 = $row_refer1['country'];
        
       

         echo" <tr>
         <td class='text-center'></td>
         <td>$first_name_refer1</td>
         <td>$last_name_refer1</td>
         <td>$country_refer1</td>
         
     </tr>";
       }
      ?>
      
    </tbody>
</table>


            </div>
            <div class="col-lg-12">
            <h3>Referal Comissions</h3>
            <table class="table" id="refer">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Country</th>
            <th class="text-right">Amount Invested</th>
            <th class="text-right">Comission</th>
        </tr>
    </thead>
    <tbody>
      <?php
       $get_refer = "select * from investment_request where referal_code = '$promo' and verified = 1 ";
       $run_refer = mysqli_query($connect,$get_refer);
       
       while($row_refer = mysqli_fetch_array($run_refer)){
        
         $first_name_refer = $row_refer['first_name'];
         $last_name_refer = $row_refer['last_name'];
         $country_refer = $row_refer['country'];
         $amount_invest_refer = $row_refer['amount_invest'];
         $comssion_refer = $amount_invest_refer * $amount_settings/100;
        
       

         echo" <tr>
         <td class='text-center'></td>
         <td>$first_name_refer</td>
         <td>$last_name_refer</td>
         <td>$country_refer</td>
         <td class='text-right'>&dollar; $amount_invest_refer</td>
         <td class='td-actions text-right'>
            $comssion_refer
         </td>
     </tr>";
       }
      ?>
      
    </tbody>
</table>


            </div>
        </div>
    </div>
      <div class="container">
           <div class="row">
               <div class="col-lg-12">
               <div class="card card-nav-tabs text-center">
                            <div class="card-header card-header-primary">
                               <h3>     <?php echo"$site_name3";?> Referal</h3>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-primary">Disclaimer</h4>
                                <p class="card-text">Referals are a great way to add to your wallet! Just refer someone with your unique referal code in your dashboard to get 5% comission on whatever your referee invests on our platform!</p>
                                <p class="card-text">If you have any questions don't hesitate to contact our support team via the chatbox below or through our <a href="contact.php" class="text-primary">"Contact Page"</a></p>
                                <p class="card-text">MAKE SURE YOU PROVIDE THE CORRECT REFERAL CODE TO YOUR REFEREE OTHERWISE YOU WON'T RECEIVE YOUR COMISSION</p>
                                <p class="card-text">THE REFEREE MUST INVEST IN A PLAN IN ORDER FOR YOU TO RECEIVE YOUR COMISSION</p>
                                <a href="refer.php#refer" class="btn btn-primary">Go Up</a>
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
   <script type='text/javascript'>
      
      function JSalert(){
      swal("Copied", ", Your Referal Link has been copied !", "success");
    }
          
      
        
        </script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>

  <script>
  

  /* Get the text field */

  var copyText = document.getElementById("input");
document.getElementById('clipboardCopy').addEventListener('click', clipboardCopy);
async function clipboardCopy() {
  let text = document.querySelector("#input").value;
  await navigator.clipboard.writeText(text);
}




  </script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "black-dashboard-free"
      });
  </script>
</body>

</html>