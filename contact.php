
<?php include('include/nav.php');?>
<?php include "include/contact_form.php";?>
<section class="contact-form">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="contact" method="POST">
       <div class="top">
       <p class="first">Send an email</p>
       <p class="second">Hello there send us an email</p>
       </div>
       <?php echo"$success";?>
<?php echo"$fail";?> 
<?php echo"$first_name_err";?>
          <div class="form-group">
              <input type="text" placeholder="First Name" class="form-control" name="first_name" required>
              <span><i class="fa fa-user"></i></span>
          </div>
          <?php echo"$last_name_err";?>
          <div class="form-group">
              <input type="text" placeholder="Last Name" class="form-control" name="last_name" required>
              <span><i class="fa fa-user"></i></span>
          </div>
          <?php echo"$email_err";?>
          <div class="form-group">
              <input type="email" placeholder="Email" class="form-control" name="email" required>
              <span><i class="fa fa-mail"></i></span>
          </div>
          <div class="form-group">
              <input type="tel" placeholder="Phone No" class="form-control" name="phone" required>
              <span><i class="fa fa-lock"></i></span>
          </div>
          </div>
<?php echo"$subject_err";?>
          <div class="form-group">
              <input type="text" placeholder="Subject" class="form-control" name="subject" required>
              <span><i class="fa fa-lock"></i></span>
          </div>
          <?php echo"$message_err";?>
          <div class="form-group">
          <textarea name="message" id="" class="form-control" placeholder="Message *" required></textarea>
          </div>
          <button type="submit" class="form-control">Send Email <i class="fa fa-arrow-right"></i></button>
      </form>
</section>

<section class="contacts2 cid-sbinCKvWvM" id="contacts2-1c">
    <!---->
    
    
    <div class="container">
        <div class="mbr-section-head">
            <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                <strong>Contacts</strong>
            </h3>
            
        </div>
        <div class="row justify-content-center mt-4">
           
            <div class="card col-12 col-md-6">
                <div class="card-wrapper">
                    <div class="image-wrapper">
                        <span class="mbr-iconfont mobi-mbri-letter mobi-mbri"></span>
                    </div>
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style mb-1 display-5">
                            <strong>Email</strong>
                        </h6>
                        <p class="mbr-text mbr-fonts-style display-7">
                            <a href="mailto:<?php echo"$email_admin1";?>" class="text-primary"><?php echo"$email_admin1";?></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card col-12 col-md-6">
                <div class="card-wrapper">
                    <div class="image-wrapper">
                        <span class="mbr-iconfont mobi-mbri-phone mobi-mbri"></span>
                    </div>
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style mb-1 display-5">
                            <strong>Phone</strong>
                        </h6>
                        <p class="mbr-text mbr-fonts-style display-7">
                            <a href="tel:<?php echo"$phone123";?>" class="text-primary"><?php echo"$phone123";?></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card col-12 col-md-6">
                <div class="card-wrapper">
                    <div class="image-wrapper">
                        <span class="mbr-iconfont mobi-mbri-globe mobi-mbri"></span>
                    </div>
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style mb-1 display-5">
                            <strong>Address</strong>
                        </h6>
                        <p class="mbr-text mbr-fonts-style display-7">
                            <?php echo"$location123";?>
                    </div>
                </div>
            </div>
            <div class="card col-12 col-md-6">
                <div class="card-wrapper">
                    <div class="image-wrapper">
                        <span class="mbr-iconfont mobi-mbri-bulleted-list mobi-mbri"></span>
                    </div>
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style mb-1 display-5">
                            <strong>Working Hours</strong>
                        </h6>
                        <p class="mbr-text mbr-fonts-style display-7">
                            24hrs/7days
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="form1 cid-sbinIHmktx mbr-fullscreen mbr-parallax-background" id="form1-1e">

    

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(255, 255, 255);"></div>
    <div class="align-center container">
        <div class="row justify-content-center">
            <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                <form action="https://mobirise.eu/" method="POST" class="mbr-form form-with-styler" data-form-title="Form Name"><input type="hidden" name="email" data-form-email="true" value="uxrRYiUwxkTTyyGaTWOHflSe1pneAUqE0XykAPlWix2MWSf5v64MG/KaQ3yaKnLFCVVMFR0oeCLd8IdOgEX+LmmPWqZJZxpBv2bku6BF4KClvzUamYQwebC6Sebe0ZD7">
                    </div>
                    <div class="dragArea row">
                        <div class="col-12">
                            <h1 class="mbr-section-title mb-4 display-2">
                                <strong>Get Latest Updates!</strong>
                            </h1>
                        </div>
                        <div class="col-12">
                            <p class="mbr-text mbr-fonts-style mb-5 display-7">Sign Up to Get email About Our finest and latest Investments.</p>
                        </div>
                        <div class="col-md col-12 form-group" data-for="name">
                            <input type="text" name="name" placeholder="Name" data-form-field="Name" class="form-control" id="name-form1-1e">
                        </div>
                        <div class="col-md col-12 form-group" data-for="email">
                            <input type="email" name="email" placeholder="Email" data-form-field="Email" class="form-control" id="email-form1-1e">
                        </div>
                        <div class="mbr-section-btn col-12 col-md-auto">
                            <button type="submit" class="btn btn-secondary display-4">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- 
<section class="clients1 cid-sbinEozhYE" id="clients1-1d">
    
    <div class="images-container container">
        <div class="mbr-section-head">
            
            
            
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-3 card">
                <img src="assets/images/1.png">
            </div>
            <div class="col-md-3 card">
                <img src="assets/images/2.png">
            </div>
            <div class="col-md-3 card">
                <img src="assets/images/3.png">
            </div>
            <div class="col-md-3 card">
                <img src="assets/images/4.png">
            </div>
            <div class="col-md-3 card">
                <img src="assets/images/2.png">
            </div>
            <div class="col-md-3 card">
                <img src="assets/images/3.png">
            </div>
            <div class="col-md-3 card">
                <img src="assets/images/4.png">
            </div>
            <div class="col-md-3 card">
                <img src="assets/images/5.png">
            </div>
        </div>
    </div>
</section> -->
<?php include("include/foot.php");?>
<script src="assets/web/assets/jquery/jquery.min.js"></script>  <script src="assets/popper/popper.min.js"></script>  <script src="assets/tether/tether.min.js"></script>  <script src="assets/bootstrap/js/bootstrap.min.js"></script>  <script src="assets/web/assets/cookies-alert-plugin/cookies-alert-core.js"></script>  <script src="assets/web/assets/cookies-alert-plugin/cookies-alert-script.js"></script>  <script src="assets/smoothscroll/smooth-scroll.js"></script>  <script src="assets/dropdown/js/nav-dropdown.js"></script>  <script src="assets/dropdown/js/navbar-dropdown.js"></script>  <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>  <script src="assets/viewportchecker/jquery.viewportchecker.js"></script>  <script src="assets/parallax/jarallax.min.js"></script>  <script src="assets/theme/js/script.js"></script>  <script src="assets/formoid/formoid.min.js"></script>  
  
  
<input name="cookieData" type="hidden" data-cookie-customDialogSelector='null' data-cookie-colorText='#424a4d' data-cookie-colorBg='rgba(234, 239, 241, 0.62)' data-cookie-textButton='Continue' data-cookie-colorButton='#ff8a8a' data-cookie-colorLink='#424a4d' data-cookie-underlineLink='true' data-cookie-text="We use cookies to give you the best experience. Read our <a href='privacy.html'>cookie policy</a>.">
    <input name="animation" type="hidden">
 
  </body>

<!-- Mirrored from coinanalytica.com/contact by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Jan 2021 02:03:05 GMT -->
</html></div>

  </body>
</html>
