<?php
session_start();
 include("../../include/config.php");


$limit = 20;
 $page = isset($_GET['page']) ? $_GET['page'] : 1;
 if($page<1){
     $page=1;
 }
 
 $start = ($page - 1) * $limit;
 $get_post1 = "select count(*) from investment_request";
 $run_post1 = mysqli_query($connect,$get_post1);
 $post_rows = mysqli_fetch_array($run_post1)[0];

 $pages = ceil($post_rows / $limit);
 $previous = $page - 1;
 $next = $page + 1;

  $get_user1 = "select * from investment_request order by id DESC limit $start,$limit";
 $run_user1 = mysqli_query($connect,$get_user1);
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
<?php
  $date1 = "";
  $date2 = "";
  $limit = 20;
 $query_result ="";
 $start1 = 0;
 $end = 0;
 $coin12 = "";
if (isset($_GET['search'])){
  $limit = $_GET['num'];
  $date1 = $_GET['from'];
  $date2 = $_GET['to'];
  $start1 = $_GET['start'];
  $end = $_GET['end'];
  $coin12 = $_GET['type'];

$page = isset($_GET['page']) ? $_GET['page'] : 1;
if($page<1){
    $page=1;
}

$start = ($page - 1) * $limit;
if(isset($_GET['type']) AND $_GET['type'] == "active"){
  $get_user1 = "select * from investment_request WHERE amount_invest between $start1 and $end and date between '$date1' and  '$date2' order by id DESC limit $start,$limit";
  $get_post1 = "select count(*) from investment_request WHERE amount_invest between $start1 and $end and date between '$date1' and  '$date2' order by id DESC limit $start,$limit "; 
  $sql = "select * from investment_request WHERE amount_invest between $start1 and $end and date between '$date1' and  '$date2' order by id DESC limit $start,$limit";
}else{

  $get_user1 = "select * from investment_request WHERE amount_invest between $start1 and $end and date between '$date1' and  '$date2'and coin='$coin12' order by id DESC limit $start,$limit";
  $get_post1 = "select count(*) from investment_request WHERE amount_invest between $start1 and $end and date between '$date1' and  '$date2' and coin='$coin12' order by id DESC limit $start,$limit "; 
  $sql = "select * from investment_request WHERE amount_invest between $start1 and $end and date between '$date1' and  '$date2' and coin='$coin12' order by id DESC limit $start,$limit";
}

$run_post1 = mysqli_query($connect,$get_post1);
$post_rows = mysqli_fetch_array($run_post1)[0];
$num_rows = mysqli_num_rows($run_post1);
$pages = ceil($post_rows / $limit);
$previous = $page - 1;
$next = $page + 1; 
$run_user1 = mysqli_query($connect,$get_user1);
$result = mysqli_query($connect, $sql);
$query_result = mysqli_num_rows($result);







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
        <ul class="nav">
  <?php include "../include/left.php";?>
        </ul>
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
                          Pending Deposits
                        </h3>
                        <form action="pending_deposit.php" method = "GET"  name="refer">
                          <select  id="type" name="type"><option value="active">All eCurrencies</option>
                          <?php
                          
                          $get_crypto = "select * from crypto_wallet";
                          $run_crypto = mysqli_query($connect,$get_crypto);
                          while($row_crypto = mysqli_fetch_array($run_crypto)){
                            $name = $row_crypto['name'];
                            $abb = $row_crypto['abb'];
                            echo"<option value='$name'>$name</option>";
                          } 
                          ?>
                           </select><br>
                        
                           <label for="">
                           From
                           </label>
                           <input type="date" name='from' class="form-control" required>
                           <label for="">
                           To
                           </label>
                           <input type="date" name='to' class="form-control" required>
                           <label for="">
                           Per Page
                           </label>
                           <input type="number" name='num' min='1' class="form-control" placeholder = "<?php echo"$limit";?>" required>
                           <label for="">
                           Amount(From)
                           </label>
                           <input type="number" name='start' min='0' class="form-control" placeholder = "0.00" required>
                           <label for="">
                           Amount(End)
                           </label>
                           <input type="number" name='end' min='0' class="form-control" placeholder = "0.00" required>
                           <button type="submit" name='search' class="btn btn-primary">Go</button>
                          </form>
                       
                    </div>

                </div>
                <!-- end of row -->
                <div class="row">
                 <div class="col-lg-12">
                 <?php
                 $success = "";
                 if(isset($_GET['success']) AND $_GET['success'] == "true"){
                  $success= "<div class='alert alert-success'>
                  <strong>Accepted</strong> Investment Request Successfully Accepted
                </div> ";
                 }elseif(isset($_GET['success']) AND $_GET['success'] == "false"){
                  $success= "<div class='alert alert-Danger'>
                  <strong>Declined</strong> Investment Request Declined!
                </div> ";
                 }elseif(isset($_GET['success']) AND $_GET['success'] == "delete"){
                  $success= "<div class='alert alert-info'>
                  <strong>Deleted</strong> Investment Request Deleted!
                </div> ";
                 }
                 echo"$success";
                 ?>
                 <table class="table table-responsive">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Name</th>
            <th>btc Address</th>
            <th>Plan</th>
            <th>Amount($)</th>
            <th>Amount(btc)</th>
            <th>Email</th>
            <th>Reference No</th>  
            <th>Date</th>
            <th>Crypto Coin</th>
            <th>Status</th>  
            <th>Action(Accept)</th>
            <th>Action(Decline)</th>
            <th>Action(Delete)</th>
        </tr>
    </thead>
    <tbody>
    
        <?php
        while($row_user = mysqli_fetch_array($run_user1)){
          $first_name = $row_user['first_name'];
          $last_name = $row_user['last_name'];
          $plan = $row_user['plan'];
          $wallet = $row_user['wallet'];
          $amount_dollar = $row_user['amount_invest'];
          $btc = $row_user['btc'];
          $reference = $row_user['reference_id'];
          $reference1 = $reference + 1;
          $id_no = $row_user['id_no'];
          $id = $row_user['id'];
          $verified = $row_user['verified'];
          $date1 = $row_user['date'];
          $coin = $row_user['coin'];
          if($verified == 0){
              $verifieds = "False";
              $dis="";
              $dis1 ="";
          }elseif($verified == 1){
              $verifieds = "True";
              $dis="disabled";
              $dis1 = "disabled";
          }elseif($verified == 2){
            $verifieds = "True";
            $dis1="disabled";
            $dis= "";
        }
          $get_email = "select email from users where id_no = $id_no ";
          $run_email = mysqli_query($connect,$get_email);
          $row_email = mysqli_fetch_array($run_email);
          $email = $row_email['email'];
          
          echo"
          <tr>
           <td>$id</td>
           <td>$first_name $last_name</td>
           <td>$wallet</td>
           <td>$plan</td>
           <td>$amount_dollar</td>
           <td>$btc</td>
           <td>$email</td>
           <td>$reference</td>
           <td>$date1</td>
           <td>$coin</td>
           <td>$verifieds</td>
           <td>
       <button type='button' rel='tooltip' class='btn btn-primary btn-sm btn-icon' data-toggle='modal' data-target='#exampleModal$id'>  <i class='tim-icons icon-simple-add'></i></button> 
       <!-- start of modal -->
        <div  class='modal fade' id='exampleModal$id' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title'>Accept Investment Request</h5>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
          <i class='tim-icons icon-simple-remove'></i>
        </button>
      </div>
      <div class='modal-body'>
        <p>Are you sure you want to Accept this investment request? You won't be able to undo this action! .</p>
      </div>
      <div class='modal-footer'>
     
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>No</button>
        <a href='../include/verify_invest.php?id=$id&&name=$first_name&&wallet=$wallet&&plan=$plan&&amount=$amount_dollar&&btc=$btc&&reference=$reference&&email=$email&&no=$id_no&&coin=$coin' rel='tooltip' class='btn btn-primary' $dis>
        Yes
    </a> 
      </div>
    </div>
  </div>
</div>
                            <!-- end of modal --></td><td>
    
   <button type='button' rel='tooltip' rel='tooltip' class='btn btn-info btn-sm btn-icon' data-toggle='modal' data-target='#exampleModal$reference'>  <i class='tim-icons icon-pin'></i></button> 
   <!-- start of modal -->
    <div  class='modal fade' id='exampleModal$reference' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
<div class='modal-dialog' role='document'>
<div class='modal-content'>
  <div class='modal-header'>
    <h5 class='modal-title'>Decline Investment Request</h5>
    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
      <i class='tim-icons icon-simple-remove'></i>
    </button>
  </div>
  <div class='modal-body'>
    <p>Are you sure you want to decline this investment request? You won't be able to undo this action! .</p>
  </div>
  <div class='modal-footer'>
 
    <button type='button' class='btn btn-secondary' data-dismiss='modal'>No</button>
    <a href='../include/pending_investment_request.php?id=$id&&name=$first_name&&wallet=$wallet&&plan=$plan&&amount=$amount_dollar&&btc=$btc&&reference=$reference&&email=$email&&no=$id_no&&coin=$coin' rel='tooltip' class='btn btn-info' $dis1>
    Yes
</a>
  </div>
</div>
</div>
</div>
                        <!-- end of modal --></td><td>
    
       <button type='button' rel='tooltip' class='btn btn-danger btn-sm btn-icon' data-toggle='modal' data-target='#exampleModal$reference1'>  <i class='tim-icons icon-simple-remove'></i></button> 
       <!-- start of modal -->
        <div  class='modal fade' id='exampleModal$reference1' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title'>Delete Investment Request</h5>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
          <i class='tim-icons icon-simple-remove'></i>
        </button>
      </div>
      <div class='modal-body'>
        <p>Are you sure you want to delete this investment request? You won't be able to undo this action! .</p>
      </div>
      <div class='modal-footer'>
     
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>No</button>
        <a href='../include/delete_invest_request.php?id=$id' rel='tooltip' class='btn btn-danger'>
         Yes
       </a>
      </div>
    </div>
  </div>
</div>
                            <!-- end of modal -->
       </td>
          </tr>
          ";
        }
        ?>
       
    </tbody>
</table>
<div class="col-lg-12">
<ul class="pagination justify-content-center" style="padding-top:30px;">
                                 <?php
                                  
                                 
                                  if(isset($_GET['search'])){
                                    $limit = $_GET['num'];
                                    $date1 = $_GET['from'];
                                    $date2 = $_GET['to'];
                                    $start = $_GET['start'];
                                    $end = $_GET['end'];
                                    $coin12 = $_GET['type'];
                                    $prev="<li class='page-item'><a class='page-link btn btn-danger' href='pending_deposit.php?page=$previous&&type=$coin12&&from=$date1&&to=$date2&&num=$limit&&start=$start1&&end=$end&&search=#start'>Previous</a></li>";
                                    $reset="<li class='page-item'><a class='page-link btn btn-info' href='pending_deposit.php'>Reset</a></li>";
                                    $nxt ="<li class='page-item'><a class='page-link btn btn-primary' href='pending_deposit.php?page=$next&&type=$coin12&&from=$date1&&to=$date2&&num=$limit&&start=$start1&&end=$end&&search=#start'>Next</a></li>";
                                  }  else{
                                    $prev="<li class='page-item'><a class='page-link btn btn-danger' href='pending_deposit.php?page=$previous#start'>Previous</a></li>";
                                    $reset="<li class='page-item'><a class='page-link btn btn-info' href='pending_deposit.php'>Reset</a></li>";
                                    $nxt ="<li class='page-item'><a class='page-link btn btn-primary' href='pending_deposit.php?page=$next#start'>Next</a></li>";
                                  }   
                                 
                                  if($page == 1){
                                    $prev = "<li class='page-item disabled'><a class='page-link btn btn-danger' href='pending_deposit.php'>Previous</a></li>";
                                }
                                if($page == $pages OR $query_result ==0){
                          
                                    $nxt="<li class='page-item disabled'><a class='page-link btn btn-primary' href='pending_deposit.php?page=$next'>Next</a></li>";
                                
                              }
                                 ?>
<?php echo"$prev";?>
<?php echo"$reset";?>
   <?php echo "$nxt";?>


</ul>


</div>
                 </div>
                   
                  <!--end -->
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
</body>

</html>