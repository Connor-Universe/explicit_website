
<?php
   include "include/login_process.php";
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href="assets/images/logo.html" type="image/x-icon">
    <title><?php echo"$site_name3";?></title>
    <link rel="shortcut icon" type="image/png" href="images/icon/favicon.html">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/metisMenu.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="css/default-css.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr css -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="<?php echo"$chat";?>" async></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
          <div class="navbar-brand" style="margin: 10px;">
            <span class="navbar-logo">
                <a href="index.php">
                    <img src="images/logo1.png" alt="" style="height: 6rem; " >
                </a>
            </span>
            <span class="navbar-caption-wrap"></span>
            
        </div>
            <div class="login-box ptb--100">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <div class="login-form-head">
                     
                    <h4>Sign In</h4>
                    <p>Hello there, Sign in and start managing your Investment Portfolio </p>
             
                    </div>

                    <div class="login-form-body">
                    <?php echo"$fail";?>
                      <br>
                      <br>    

                      <?php echo"$email_err";?>
                        <div class="form-gp">
                         
                            <label for="exampleInputEmail">Email address</label>
                            <input type="email" id="exampleInputEmail" name="email" required>
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                        </div>
                        <?php echo"$password_err";?>
                        <div class="form-gp">
                      
                            <label for="exampleInputPassword">Password</label>
                            <input type="password" id="exampleInputPassword" name="password" required>
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                                </div>
                            </div>
                            <!-- <div class="col-6 text-right">
                                <a href="#">Forgot Password?</a>
                            </div> -->
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit"  type="submit">Log In <i class="ti-arrow-right"></i></button>
                   
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Don't have an account? <a href="register.php">Sign up</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    
    <!-- others plugins -->
    <script src="js/plugins.js"></script>
    <script src="js/scripts.js"></script>
    <script>		
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>


<!-- Mirrored from coinanalytica.com/users/register by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Jan 2021 02:03:20 GMT -->
</html></div>

  </body>
</html>
