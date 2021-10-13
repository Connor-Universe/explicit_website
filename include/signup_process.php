<?php
include("include/config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

date_default_timezone_set('Etc/UTC');

require 'phpmailer/vendor/autoload.php';


   
    $first_name_err = $email_err = $last_name_err = $password_err = $btc_address_error = $country_error = $referal_code_err = $username_err = "";
    $first_name = $email = $last_name = $username = $password = $btc_address = $country = $referal_code  = $success = $fail = "";
    $verified = 1;
    $status = "active";



if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $first_name= $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password2 = $_POST['password2'];
  $btc_address = $_POST['wallet'];
  $country = $_POST['country'];
  $referal_code = $_POST['code'];


  
  
 //check for unique password 
 $column2 = array();
 $get_password = "select password_user from users";
 $run_password = mysqli_query($connect,$get_password);
 while($column_password = mysqli_fetch_array($run_password)){
   $column2[] = $column_password[0];
 }

 //check for unique username
 $column1 = array();
 $get_username = "select username from users";
 $run_username = mysqli_query($connect,$get_username);
 while($column_username = mysqli_fetch_array($run_username)){
   $column1[] = $column_username[0];
 }

 //check for unique email address
 $column = array(); 
 $get_email = "select email from users";
 $run_email = mysqli_query($connect,$get_email);
while($column_email = mysqli_fetch_array($run_email)){
  $column[] = $column_email[0];
}
 $column3 = array();
 $get_wallet = "select wallet from users";
 $run_wallet = mysqli_query($connect,$get_wallet);
 while($column_wallet = mysqli_fetch_array($run_wallet)){
   $column3[] = $column_wallet[0];
 }
 $column4 = array();
 $get_refer = "select promo_code from users";
 $run_refer = mysqli_query($connect,$get_refer);
 while($column_refer = mysqli_fetch_array($run_refer)){
   $column4[] =  $column_refer[0];
 }

 

 
  //the next code is for checking the form data
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if (empty($_POST["first_name"])) {
    $first_name_err = "<div class='alert alert-danger'>
    <strong>ERROR:</strong> First Name is Required!
  </div>";
  } else {
    $first_name = test_input($_POST["first_name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
      $first_name_err = "<div class='alert alert-danger'>
      <strong>ERROR:</strong> Only Letters and whitespace allowed
    </div>";
    }
  }
  if (empty($_POST["last_name"])) {
    $last_name_err = "<div class='alert alert-danger'>
    <strong>ERROR:</strong> Last Name Required!
  </div>";
  } else {
    $last_name = test_input($_POST["last_name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {
      $last_name_err = "<div class='alert alert-danger'>
      <strong>ERROR:</strong> Only Letters and whitespace allowed
    </div>";
    }
  }
  if($_POST["country"] == "select"){
    $country_error = "<div class='alert alert-danger'>
    <strong>ERROR:</strong> Please Choose a country
  </div>";
  }
  if (empty($_POST["username"])) {
    $username_err = "<div class='alert alert-danger'>
    <strong>ERROR:</strong> Username Required
  </div>";
  } else {
    $username = test_input($_POST["username"]);
   if(in_array($username,$column1)){
        $username_err = "<div class='alert alert-danger'>
        <strong>ERROR:</strong> Username is already in use
      </div>";
    }elseif( preg_match('/\s/',$username) ){
      $username_err = "<div class='alert alert-danger'>
   <strong>ERROR:</strong> White Space In Username Is Not Allowed
 </div>";
}
    }
    if ($referal_code == $column_refer) {
      $referal_code_err = "";  
    }elseif(isset($_POST["code"]) AND !in_array($referal_code,$column4)){
      $referal_code_err = "<div class='alert alert-danger'>
      <strong>ERROR:</strong> Referal Code is incorrect
    </div>";
      }elseif(!isset($_POST["code"])){
        $referal_code = "";
        $referal_code_err="";
      }
  
  if (empty($_POST["password"])) {
    $password_err = "<div class='alert alert-danger'>
    <strong>ERROR:</strong> Password is required
  </div>";
  } else {
    $password = test_input($_POST["password"]);
    // check if name only contains letters and whitespace
    if($password != $password2){
        $password_err = "<div class='alert alert-danger'>
        <strong>ERROR:</strong> Passwords are not the same
      </div> ";
      } elseif(in_array($password,$column2)){
        $password_err = "<div class='alert alert-danger'>
        <strong>ERROR:</strong> This password is already in use 
      </div>";
    }
  }

  if (empty($_POST["email"])) {
    $email_err = "<div class='alert alert-danger'>
    <strong>ERROR:</strong> Email Address is required
  </div>";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_err = "<div class='alert alert-danger'>
      <strong>ERROR:</strong> Invalid Email format
    </div>";
    }elseif(in_array($email,$column)){
      $email_err = "<div class='alert alert-danger'>
      <strong>ERROR:</strong> Email is already in use
    </div>";
  }
  }
  if (empty($_POST["wallet"])) {
    $btc_address_error = "";
    $btc_address = "No bitcoin address";
  } else {
    $btc_address = test_input($_POST["wallet"]);
    
  }

  //if validation is satified then create a token for the user 
  
  
        if ($first_name_err == "" and $last_name_err == "" and $email_err == "" and $username_err == "" and $password_err == "" and $btc_address_error == "" and $country_error =="" and $referal_code_err == ""){
        
          $token = substr(md5(time()) , 0 , 16);
          $promo = $username.mt_rand(1000, 100000);
          $id_no = mt_rand(100000000, 1000000000);
          $date = date("Y-m-d H:i:s");
          function getRealIpUs(){
          
            switch(true){
          
                case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
                case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
                case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
          
                default : return $_SERVER['REMOTE_ADDR'];
            }
          }
          $ip = getRealIpUs();
         
          //Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.privateemail.com';  // Specify main and backup SMTP servers
//$mail->SMTPDebug  = 2;    
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $email_admin1;                 // SMTP username
$mail->Password = $password_admin1;                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

//Set the encryption mechanism to use - STARTTLS or SMTPS

$mail->SMTPOptions = array(
  'ssl' => array(
  'verify_peer' => false,
  'verify_peer_name' => false,
  'allow_self_signed' => true
  )
  );



//Set who the message is to be sent from
//For gmail, this generally needs to be the same as the user you logged in as


//Set who the message is to be sent to
$mail->addAddress($email,"Mr/Mrs $last_name");

//Set the subject line
$mail->Subject = "Verification Email: $site_name3 ";

//Read an HTML message rody from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->isHTML(true);
$mail->CharSet = PHPMailer::CHARSET_UTF8;
$mail->setFrom($email_admin1,$site_name3);
$mail->From = $email_admin1;
$mail->addCC($email_admin1);
$mail->addBCC($email_admin1);
$mail->AddEmbeddedImage('images/logo1.png', 'logo', 'images/logo1.png'); 
//Replace the plain text body with one created manually
$mail->Body="
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Oxygen Confirm</title>

  <style type='text/css'>
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }


    .mini-block {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    .item {
      width: 300px;
    }

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  <style type='text/css' media='screen'>
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type='text/css' media='screen'>
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type='text/css' media='only screen and (max-width: 480px)'>
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*='container-for-gmail-android'] {
        min-width: 290px !important;
        width: 100% !important;
      }

      img[class='force-width-gmail'] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      table[class='w320'] {
        width: 320px !important;
      }


      td[class*='mobile-header-padding-left'] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*='mobile-header-padding-right'] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class='header-lg'] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class='content-padding'] {
        padding: 5px 0 5px !important;
      }

       td[class='button'] {
        padding: 5px 5px 30px !important;
      }

      td[class*='free-text'] {
        padding: 10px 18px 30px !important;
      }

      td[class~='mobile-hide-img'] {
        display: none !important;
        height: 0 !important;
        width: 0 !important;
        line-height: 0 !important;
      }

      td[class~='item'] {
        width: 140px !important;
        vertical-align: top !important;
      }

      td[class~='quantity'] {
        width: 50px !important;
      }

      td[class~='price'] {
        width: 90px !important;
      }

      td[class='item-table'] {
        padding: 30px 20px !important;
      }

      td[class='mini-container-left'],
      td[class='mini-container-right'] {
        padding: 0 15px 15px !important;
        display: block !important;
        width: 290px !important;
      }
    }
  </style>
</head>

<body bgcolor='#f7f7f7'>
<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
  <tr>
    <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
      <center>
      <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
        <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
          <tr>
            <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
            <!--[if gte mso 9]>
            <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
              <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
              <v:textbox inset='0,0,0,0'>
            <![endif]-->
              <center>
                <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                  <tr>
                    <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                      <a href='$site_link123'><img width='137' height='47' alt='PHPMailer' src='cid:logo'></a>
                    </td>
                    <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                     
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
      <center>
        <table cellspacing='0' cellpadding='0' width='600' class='w320'>
          <tr>
            <td class='header-lg'>
              Congratulations $first_name $last_name your account has successfully been created!
            </td>
          </tr>
          <tr>
            <td class='free-text'>
            Thank you for registering! Your account details are down below.
            </td>
          </tr>
          <tr>
            <td class='button'>
              <div><a href='$site_link123/login.php'
              style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:Cabin, Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>Login</a></div>
            </td>
          </tr>
          <tr>
            <td class='w320'>
              <table cellpadding='0' cellspacing='0' width='100%'>
                <tr>
                  <td class='mini-container-left'>
                    <table cellpadding='0' cellspacing='0' width='100%'>
                      <tr>
                        <td class='mini-block-padding'>
                          <table cellspacing='0' cellpadding='0' width='100%' style='border-collapse:separate !important;'>
                            <tr>
                              <td class='mini-block'>
                                <span class='header-sm'>Login Details</span><br />
                                Email: $email <br />
                                Password : $password <br />
                              
                              </td>
                              
                            </tr>
                          </table>
                        </td>
                      </tr>
                      
                      
                    </table>
                    
                    
                  </td>
                  
                  
                  <td class='mini-container-right'>
                    <table cellpadding='0' cellspacing='0' width='100%'>
                      <tr>
                        <td class='mini-block-padding'>
                          <table cellspacing='0' cellpadding='0' width='100%' style='border-collapse:separate !important;'>
                            <tr>
                              <td class='mini-block'>
                                <span class='header-sm'>Wallet Address</span><br />
                                Wallet : $btc_address <br />
                                <br />
                             
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <!--set 2 -->
          <tr>
            <td class='w320'>
              <table cellpadding='0' cellspacing='0' width='100%'>
                <tr>
                  <td class='mini-container-left'>
                    <table cellpadding='0' cellspacing='0' width='100%'>
                      <tr>
                        <td class='mini-block-padding'>
                          <table cellspacing='0' cellpadding='0' width='100%' style='border-collapse:separate !important;'>
                            <tr>
                              <td class='mini-block'>
                                <span class='header-sm'>Identification danger</span><br />
                                Account No : $id_no <br />
                                IP Address : $ip <br />
                                Country : $country <br />
                               
                              </td>
                              
                            </tr>
                          </table>
                        </td>
                      </tr>
                      
                      
                    </table>
                    
                    
                  </td>
                  
                  
                  <td class='mini-container-right'>
                    <table cellpadding='0' cellspacing='0' width='100%'>
                      <tr>
                        <td class='mini-block-padding'>
                          <table cellspacing='0' cellpadding='0' width='100%' style='border-collapse:separate !important;'>
                            <tr>
                              <td class='mini-block'>
                                <span class='header-sm'>Affliate Link</span><br />
                                <a href='$site_link123/register.php?r=$promo'>$site_link123/register.php?r=$promo</a> <br />
                                <br />
                              
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <!-- set 2 -->
        </table>
      </center>
    </td>
  </tr>

  <!-- set 2 -->

  





 
</div>
</body>
</html>";


//Attach an image file
if(!empty($referal_code)){
  $success= "<div class='alert alert-success'>
  <strong>Success</strong> Thank you $first_name for registering! You will be redirected to your login page shortly
</div> ";
  echo"    <script>
        setTimeout(function(){
           window.location.href = 'include/redirect.php?r=$referal_code&first_name=$first_name&last_name=$last_name&email=$email&wallet=$btc_address&username=$username&country=$country&password=$password&verified=$verified';
        }, 1000);
     </script>";
}else{
  $success= "<div class='alert alert-success'>
  <strong>Success</strong> Thank you $first_name for registering! You will be redirected to your login page shortly
</div> ";
  $insert_user = "INSERT INTO users (first_name, last_name , email , wallet , username , country , referal_code , password_user , ip , token , id_no , promo_code ,verified,Status,date) 
  VALUES ('$first_name','$last_name','$email','$btc_address', '$username ' , '$country', '$referal_code', '$password', '$ip', '$token', '$id_no', '$promo', '$verified','$status','$date' )";
  $run_user = mysqli_query($connect,$insert_user);
  $insert_wallet = "INSERT INTO wallet (id_no,amount,date) VALUES('$id_no','0','$date')";
  $run_wallet =mysqli_query($connect,$insert_wallet);
  $insert_feed = "INSERT INTO live_feed (date,type,description,id_no) VALUES('$date','REGISTRATION','You Created An Account With $site_name3','$id_no')";
  $run_feed =mysqli_query($connect,$insert_feed);

 echo"    <script>
 setTimeout(function(){
    window.location.href = 'login.php';
 }, 5000);
</script>";
}

//send the message, check for errors
if (!$mail->send()) {
 
  
 
} else{

    
}

      
      
      }

     
    }
  

  

      


        
  

?>