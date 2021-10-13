<?php
include("config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;


date_default_timezone_set('Etc/UTC');

require '../phpmailer/vendor/autoload.php';

      //referal email

      if(isset($_GET['r'])){
          $referal_code = $_GET['r'];
        $get_user ="select * from users where promo_code = '$referal_code'";
        $run_user = mysqli_query($connect,$get_user);
        $row_user = mysqli_fetch_array($run_user);
        $first_name1 = $row_user['first_name'];
        $last_name1 = $row_user['last_name'];
        $email12 = $row_user['email'];
        $id_no456 = $row_user['id_no'];
        $username1 = $row_user['username'];
        $first_name= $_GET['first_name'];
        $last_name = $_GET['last_name'];
        $email = $_GET['email'];
        $wallet = $_GET['wallet'];
        $username = $_GET['username'];
        $country = $_GET['country'];
        $password=$_GET['password'];
        $status = "active";
        $verified = 1;
        $date = date("Y-m-d H:i:s");
         
          $token = substr(md5(time()) , 0 , 16);
          $promo = $username.mt_rand(1000, 100000);
          $id_no = mt_rand(1000000, 10000000);
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
$mail->Port = 465;     

//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

//Whether to use SMTP authentication


$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);


//Set who the message is to be sent from
//For gmail, this generally needs to be the same as the user you logged in as
$mail->setFrom($email_admin1,$last_name);

//Set who the message is to be sent to
$mail->addAddress($email12,"Mr/Mrs".$last_name);

//Set the subject line
$mail->Subject = "Referal Email: $site_name3";

//Read an HTML message rody from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->isHTML(true);
$mail->CharSet = PHPMailer::CHARSET_UTF8;
$mail->From = $email_admin1;
$mail->addCC($email_admin1);
$mail->addBCC($email_admin1);
$mail->AddEmbeddedImage('../images/logo1.png', 'logo', '../images/logo1.png'); 

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
              Congratulations $first_name1 $last_name1 you have successfully refered someone!
            </td>
          </tr>
          <tr>
            <td class='free-text'>
            $username has used your referal link to register on our platform! You will now receive a $amount_settings% comission on any investment package they choose from! keep refering more users and get larger and larger referal bonuses!
            </td>
          </tr>
          <tr>
            <td class='button'>
              <div><a href='$site_link123/login.php'
              style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:Cabin, Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>Login</a></div>
            </td>
          </tr>
         





 
</div>
</body>
</html>";


//Attach an image file
$success= "<div class='alert alert-dark'>
<strong>Success</strong> Thank you $first_name for registering! You will be redirected to your login page shortly
</div> ";
$insert_user = "INSERT INTO users (first_name, last_name , email , wallet , username , country , referal_code , password_user , ip , token , id_no , promo_code ,verified,Status,date) 
VALUES ('$first_name','$last_name','$email','$wallet', '$username ' , '$country', '$referal_code', '$password', '$ip', '$token', '$id_no', '$promo', '$verified','$status','$date' )";
$run_user = mysqli_query($connect,$insert_user);
$insert_wallet = "INSERT INTO wallet (id_no,amount,date) VALUES('$id_no','0','$date')";
$run_wallet =mysqli_query($connect,$insert_wallet);
$insert_feed = "INSERT INTO live_feed (date,type,description,id_no) VALUES('$date','REFERRAL','You Refered $username To $site_name3','$id_no456')";
$run_feed =mysqli_query($connect,$insert_feed);
$insert_refer1 = "INSERT INTO referal_list (referer,referee,date) VALUES('$username1','$username','$date')";
$run_refer1 =mysqli_query($connect,$insert_refer1);
$insert_feed1 = "INSERT INTO live_feed (date,type,description,id_no) VALUES('$date','REGISTRATION','You Created An Account With $site_name3','$id_no')";
$run_feed1 =mysqli_query($connect,$insert_feed1);
      

echo"    <script>
setTimeout(function(){
  window.location.href = '../login.php';
});
</script>";

//send the message, check for errors
if (!$mail->send()) {


} else {


  
}
      

    }

 
        // end of referal email

?>