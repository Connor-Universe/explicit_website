<?php
session_start();
 include("../../include/config.php");

 $limit = 25;
 $page = isset($_GET['page']) ? $_GET['page'] : 1;
 if($page<1){
     $page=1;
 }
 
 $start = ($page - 1) * $limit;
 $get_post1 = "select count(*) from users";
 $run_post1 = mysqli_query($connect,$get_post1);
 $post_rows = mysqli_fetch_array($run_post1)[0];
 $num_rows = mysqli_num_rows($run_post1);

 $pages = ceil($post_rows / $limit);

 $previous = $page - 1;
 $next = $page + 1; 
  $get_user = "select * from users order by id DESC limit $start,$limit";
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
<?php

if ($_SERVER["REQUEST_METHOD"] == "GET"){
 
if(isset($_GET['member'])){
    $search = mysqli_real_escape_string($connect,$_GET['member']);
}else{
    $search = "";
}

$limit = 20;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
if($page<1){
    $page=1;
}

$start = ($page - 1) * $limit;
$get_post2 = "select count(*) from users where username like '%$search%' or first_name like '%$search%' or last_name like '%$search%'";
$run_post2 = mysqli_query($connect,$get_post2);
$post_rows2 = mysqli_fetch_array($run_post2)[0];

$pages = ceil($post_rows2 / $limit);

$previous = $page - 1;
$next = $page + 1;
$get_user = "select * from users where username like '%$search%' or first_name like '%$search%' or last_name like '%$search%' order by id DESC limit $start,$limit";
$run_user = mysqli_query($connect,$get_user);

$sql = "select * from users where username like '%$search%' or first_name like '%$search%' or last_name like '%$search%' limit $start,$limit";
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

                <div class="col-lg-6">

                <h3 class="first">
                          Find User: 
                          </h3>
                          <form action="add_bonus.php" method = "GET"  name="member">
                           <input type="text" class="form-control" name="member">
                           <button type="submit" class="btn btn-primary">Search</button>
                          </form>
                          </div>
                    <div class="col-lg-12">
                        <h3 class="first">
                        Send bonus 
                        </h3>
                        
                       
                    </div>

                </div>
                <!-- end of row -->
                <div class="row">
                 <div class="col-lg-12">
                 <?php
                 if(isset($_GET['success'])){
                  $success= "<div class='alert alert-success'>
                  <strong>Success</strong> bonus Successfully Added
                </div> ";
                 }else{
                   $success = "";
                 }
                 echo"$success";
                 ?>
                 <table class="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Name</th>
            <th>ID NO</th>
            <th>Wallet Amount(USD)</th>
            <th>Total bonuses(USD)</th>
            <th class="text-right">Add bonus</th>
       
        </tr>
    </thead>
    <tbody>
    <?php
    while($row_user = mysqli_fetch_array($run_user)){
    $first_name = $row_user['first_name'];
    $last_name = $row_user['last_name'];
    $username = $row_user['username'];
    $id_no = $row_user['id_no'];
    $get_funds = "SELECT SUM(amount) AS value_adds FROM bonus where id_no = $id_no";
    $run_funds = mysqli_query($connect,$get_funds);
    $fetch_funds = mysqli_fetch_assoc($run_funds);
    $get_wallet = "select amount from wallet where id_no = $id_no";
    $run_wallet = mysqli_query($connect, $get_wallet);
    $row_wallet = mysqli_fetch_array($run_wallet);
    $amount = $row_wallet['amount'];
    echo"
    <tr>
    <td class='text-center'></td>
    <td>$first_name $last_name <br> $username</td>
    <td>$id_no</td>
    <td>$$amount</td>
    <td>$$fetch_funds[value_adds]</td>
    <td class='text-right'>
       <form action='../include/bonus.php' method='POST' id ='$id_no'>
         <input class='form-control' type='number' min='0' placeholder='Add bonus' name='amount' required>
         <input type='hidden' name='id' value='$id_no'>
         
         <button type='button' rel='tooltip' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal$id_no'>  Add</button> 
         <!-- start of modal -->
          <div  class='modal fade' id='exampleModal$id_no' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title'>Add bonus!</h5>
          <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
            <i class='tim-icons icon-simple-remove'></i>
          </button>
        </div>
        <div class='modal-body'>
          <p>Are you sure you want to add bonus to this users account? You won't be able to undo this action! .</p>
        </div>
        <div class='modal-footer'>
       
          <button type='button' class='btn btn-secondary' data-dismiss='modal'>No</button>
          <button type='submit' class='btn btn-primary' name='add'>Yes</button>
        </div>
      </div>
    </div>
  </div>
                              <!-- end of modal -->
       </form>
    </td>
</tr>
    ";
  }
    ?>
       
       
    </tbody>
</table>
<ul class="pagination justify-content-center" style="padding-top:30px;">
                                 <?php
                                       
                                       if(isset($_GET['member'])){
                                        $member = $_GET['member'];
                                        $prev="<li class='page-item'><a class='page-link btn btn-danger' href='add_bonus.php?page=$previous&&member=$member&&member=#start'>Previous</a></li>";
                                        $reset="<li class='page-item'><a class='page-link btn btn-info' href='add_bonus.php'>Reset</a></li>";
                                        $nxt ="<li class='page-item'><a class='page-link btn btn-primary' href='add_bonus.php?page=$next&&member=$member&&member=#start'>Next</a></li>";
                                      }  else{
                                        $prev="<li class='page-item'><a class='page-link btn btn-danger' href='add_bonus.php?page=$previous#start'>Previous</a></li>";
                                        $reset="<li class='page-item'><a class='page-link btn btn-info' href='add_bonus.php'>Reset</a></li>";
                                        $nxt ="<li class='page-item'><a class='page-link btn btn-primary' href='add_bonus.php?page=$next#start'>Next</a></li>";
                                      }   
                                  if($page == 1){
                                    $prev = "<li class='page-item disabled'><a class='page-link btn btn-danger' href='add_bonus.php'>Previous</a></li>";
                                }
                                if($page == $pages OR $query_result == 0){
                                    $nxt="<li class='page-item disabled'><a class='page-link btn btn-primary' href='add_bonus.php?page=$next'>Next</a></li>";
                                }
                                 ?>
<?php echo"$prev";?>
<?php echo"$reset";?>
   <?php echo "$nxt";?>


</ul>
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