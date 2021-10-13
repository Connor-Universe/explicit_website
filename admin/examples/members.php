<?php
session_start();
 include("../../include/config.php");

 $limit = 20;
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
 if(isset($_GET['type1']) AND $_GET['type'] == "active"){
   $dis1 = "selected";
   $dis2 = "";
   $dis3 = "";
 }elseif(isset($_GET['type1']) AND $_GET['type'] == "suspend"){
  $dis1 = "";
  $dis2 = "selected";
  $dis3 = "";
}elseif(isset($_GET['type1']) AND $_GET['type'] == "block"){
  $dis1 = "";
  $dis2 = "";
  $dis3 = "selected";
}else{
  $dis1 = "";
   $dis2 = "";
   $dis3 = "";
}
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
 $search1 =$query_result = $search3 = "";
if (isset($_GET['type1'])){
 
    $search3 = $_GET['type'];
    $limit = 15;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    if($page<1){
        $page=1;
    }
    
    $start = ($page - 1) * $limit;
    $get_post2 = "select count(*) from users where Status = '$search3'";
    $run_post2 = mysqli_query($connect,$get_post2);
    $post_rows2 = mysqli_fetch_array($run_post2)[0];
    
    $pages = ceil($post_rows2 / $limit);
    
    $previous = $page - 1;
    $next = $page + 1;
    $get_user = "select * from users where Status = '$search3' order by id DESC limit $start,$limit";
    $run_user = mysqli_query($connect,$get_user);
    
    $sql = "select * from users where Status = '$search3' limit $start,$limit";
    $result = mysqli_query($connect, $sql);
    $query_result = mysqli_num_rows($result);
    
    
    
    
    
    
    
    }elseif (isset($_GET['member1'])){
 

      $search1 = mysqli_real_escape_string($connect,$_GET['member']);
  
  
  $limit =15;
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  if($page<1){
      $page=1;
  }
  
  $start = ($page - 1) * $limit;
  $get_post2 = "select count(*) from users where username like '%$search1%' or first_name like '%$search1%' or last_name like '%$search1%'";
  $run_post2 = mysqli_query($connect,$get_post2);
  $post_rows2 = mysqli_fetch_array($run_post2)[0];
  
  $pages = ceil($post_rows2 / $limit);
  
  $previous = $page - 1;
  $next = $page + 1;
  $get_user = "select * from users where username like '%$search1%' or first_name like '%$search1%' or last_name like '%$search1%' order by id DESC limit $start,$limit";
  $run_user = mysqli_query($connect,$get_user);
  
  $sql = "select * from users where username like '%$search1%' or first_name like '%$search1%' or last_name like '%$search1%' limit $start,$limit";
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
                          Members: 
                          </h3>
                          <form action="members.php" method = "GET"  name="member">
                           <input type="text" class="form-control" name="member">
                           <button type="submit" class="btn btn-primary" name="member1">Search</button>
                          </form>
                         
                  
                        
                       
                    </div>
                    <div class="col-lg-6">
                        
                    <form action="members.php" method = "GET"  name="type">
                           <select name="type" id="type" >
                           <option value="active" <?php echo"$dis1";?>>Active</option>
                           <option value="suspend" <?php echo"$dis2";?>>Suspended</option>
                           <option value="block" <?php echo"$dis3";?>>blocked</option></select>
                           <button type="submit" class="btn btn-primary" name = "type1">Go </button>
                          </form>
                    </div>

                </div>
                <!-- end of row -->
                <div class="row">
                 <div class="col-lg-12">
         
                 <h3>Results </h3>
                 <?php
                 if(isset($_GET['success'])){
                  $success= "<div class='alert alert-success'>
                  <strong>Success</strong> User Successfully Deleted
                </div> ";
                 }else{
                   $success = "";
                 }
                 echo"$success";
                 ?>
                 <table class="table" id="start">
    <thead>
        <tr>
          
            <th>Nickname(Username)</th>
            <th>Reg Date</th>
            <th>Status</th>
            <th>balance</th>
            <th>Funded</th>
            <th>Withdrew</th>
            <th>Earned</th>
            <th>Active Deposit</th>
        </tr>
    </thead>
    <tbody>
    
        <?php
        while($row_user = mysqli_fetch_array($run_user)){
          $first_name = $row_user['first_name'];
          $last_name = $row_user['last_name'];
          $email = $row_user['email'];
          $wallet = $row_user['wallet'];
          $username = $row_user['username'];
          $country = $row_user['country'];
          $password = $row_user['password_user'];
          $date_reg = $row_user['date'];
          $status = $row_user['Status'];
          $id_no = $row_user['id_no'];
          $promo = $row_user['promo_code'];
          $get_wallet = "select amount from wallet where id_no = $id_no";
          $run_wallet = mysqli_query($connect,$get_wallet);
          $row_wallet = mysqli_fetch_array($run_wallet);
          $amount_wallet = $row_wallet['amount'];
          $get_total_invest = "SELECT SUM(amount) AS value_sum FROM investments WHERE id_no = $id_no";
          $run_total_invest = mysqli_query($connect,$get_total_invest);
          $total_invest = mysqli_fetch_assoc($run_total_invest);
          $get_total_invest1 = "SELECT SUM(amount) AS value_sum FROM investments WHERE id_no = $id_no AND complete = 0";
          $run_total_invest1 = mysqli_query($connect,$get_total_invest1);
          $total_invest1 = mysqli_fetch_assoc($run_total_invest1);
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
       
          $ip = $row_user['ip'];
          $id = $row_user['id'];
          echo"
          <tr>
           <td>$username <br> $first_name $last_name <br> </td>
           <td><a href='edit_user.php?id_no=$id_no'>$date_reg </a></td>
           <td><select class='form-control'>
           <option>$status</option>
           </select></td>
           <td>$amount_wallet</td>
           <td>$total_invest[value_sum]</td>
           <td>$total_withdraw[value_sum]</td>
           <td>$final</td>
           <td>$total_invest1[value_sum]</td>
           
           
          </tr>
          <tr>
          <td> 
          
  
      <button type='button' rel='tooltip' class='btn btn-danger' data-toggle='modal' data-target='#exampleModal2'> Delete</button> 
      <!-- start of modal -->
       <div  class='modal fade' id='exampleModal2' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
 <div class='modal-dialog' role='document'>
   <div class='modal-content'>
     <div class='modal-header'>
       <h5 class='modal-title'>Permenatly Delete User?</h5>
       <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
         <i class='tim-icons icon-simple-remove'></i>
       </button>
     </div>
     <div class='modal-body'>
       <p>Are you sure you want to delete this user? All their records will be deleted You won't be able to undo this action! .</p>
     </div>
     <div class='modal-footer'>
    
       <button type='button' class='btn btn-secondary' data-dismiss='modal'>No</button>
       <a href='../include/delete_user.php?id_no=$id_no' rel='tooltip' class='btn btn-danger '>
       Yes
   </a> 
     </div>
   </div>
 </div>
</div>
                           <!-- end of modal --></td>
      <td> <a href='edit_user.php?id_no=$id_no' rel='tooltip' class='btn btn-danger '>
          Edit
      </a></td>
      <td> <a href='https://privateemail.com' rel='tooltip' class='btn btn-danger'>
     E-mail
  </a></td>
  <td> <a href='manage_user.php?id_no=$id_no' rel='tooltip' class='btn btn-danger '>
  Manage Funds
</a></td>
           </tr>
          ";
        }
        ?>
       
    </tbody>
</table>
<div class="col-lg-12">
<ul class="pagination justify-content-center" style="padding-top:30px;">
                                 <?php
                                       if(isset($_GET['member1'])){
                                         $search1 = $_GET['member'];
                                  $prev="<li class='page-item'><a class='page-link btn btn-danger' href='members.php?page=$previous&&member=$search1&&member1=#start'>Previous</a></li>";
                                  $reset="<li class='page-item'><a class='page-link btn btn-info' href='members.php'>Reset</a></li>";
                                  $nxt ="<li class='page-item'><a class='page-link btn btn-primary' href='members.php?page=$next&&member=$search1&&member1=#start'>Next</a></li>";
                                       }elseif(isset($_GET['type1'])){
                                        $search2 = $_GET['type'];
                                        $prev="<li class='page-item'><a class='page-link btn btn-danger' href='members.php?page=$previous&&type=$search2&&type1=#start'>Previous</a></li>";
                                        $reset="<li class='page-item'><a class='page-link btn btn-info' href='members.php'>Reset</a></li>";
                                        $nxt ="<li class='page-item'><a class='page-link btn btn-primary' href='members.php?page=$next&&type=$search2&&type1=#start'>Next</a></li>";
                                       }else{
                                        $prev="<li class='page-item'><a class='page-link btn btn-danger' href='members.php?page=$previous#start'>Previous</a></li>";
                                        $reset="<li class='page-item'><a class='page-link btn btn-info' href='members.php'>Reset</a></li>";
                                        $nxt ="<li class='page-item'><a class='page-link btn btn-primary' href='members.php?page=$next#start'>Next</a></li>";
                                       }
                                  if($page == 1){
                                    $prev = "<li class='page-item disabled'><a class='page-link btn btn-danger' href='members.php'>Previous</a></li>";
                                }
                                if($page == $pages OR $query_result == 0){
                                    $nxt="<li class='page-item disabled'><a class='page-link btn btn-primary' href='members.php?page=$next'>Next</a></li>";
                                }
                                 ?>
<?php echo"$prev";?>
<?php echo "$reset";?>
   <?php echo "$nxt";?>


</ul>
<a href="add_user.php" class="btn btn-primary">Modify</a><a href="add_user.php" class="btn btn-primary">Add New Member <?php echo"$query_result";?></a>
<div class="card card-nav-tabs text-center">
                            <div class="card-header card-header-primary">
                               <h3>  <?php echo"$site_name3";?></h3>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-primary">Members list:</h4>
                                <p class="card-text">Members list splits your members to 3 types: Active, Suspended and Disabled:</p>
                                <p class="card-text">Active: User can login and receive earnings if deposited in the system.</p>
                                <p class="card-text">Suspended: User cannot login</p>
                                <p class="card-text">
                                Disabled: Cannot access the website
</p>
                                <p class="card-text">The top left search form helps you to search a user by the nickname or e-mail. You can also enter a part of a nickname or e-mail to search users.</p>
<p class="card-text">The top right form helps you to navigate between the user types.
</p>
<p class="card-text">You can see the following information in the members list:
Nickname, Registration date, Status, Account, Deposit, Earned, Withdrew. You can see not confirmed users also if you use double opt-in registration.</p>
<p class="card-text">
Actions:</p>
<p class="card-text">Change status: select a new status in the 'Status' row and click the 'Modify' button;
Edit user information: click on the 'edit' link;
Delete user: click on the 'delete' link and confirm this action;
Send e-mail to user: click on the 'e-mail' link and send e-mail to user.
'Manage funds' link will help you to check any user's history and change his funds.
Add a new Member: click on the "Add a new member" button. You'll see the form for adding a new member.</p>

                            </div>
                          
                            </div>
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