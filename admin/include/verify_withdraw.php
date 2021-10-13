<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;
require '../../phpmailer/vendor/autoload.php';
include '../../include/config.php';
$id=$_GET['id'];
$amount = $_GET['amount'];
$id_no = $_GET['no'];
$wallet = $_GET['wallet'];
$name = $_GET['name'];
$email_user = $_GET['email'];
$btc = $_GET['btc'];
$reference = $_GET['reference'];
$coin = $_GET['coin'];
$delete = "UPDATE withdraw_request SET verified = 1 WHERE id= $id";
$run = mysqli_query($connect,$delete);
$result = $run;
$withdraw = "INSERT INTO withdraws (amount,id_no) VALUES('$amount','$id_no')";
$run_withdraw = mysqli_query($connect,$withdraw);
$date = date("Y-m-d H:i:s");
date_default_timezone_set('Etc/UTC');


  
        
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
$mail->SMTPOptions = array(
  'ssl' => array(
  'verify_peer' => false,
  'verify_peer_name' => false,
  'allow_self_signed' => true
  )
  );


//Read an HTML message rody from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->isHTML(true);
$mail->CharSet = PHPMailer::CHARSET_UTF8;
$mail->setFrom($email_admin1,$site_name3);
$mail->From = $email_admin1;
$mail->addCC($email_admin1);
$mail->addBCC($email_admin1);

$mail->AddEmbeddedImage('../../images/logo1.png', 'logo', '../../images/logo1.png '); 

//Set who the message is to be sent from
//For gmail, this generally needs to be the same as the user you logged in as

//Set who the message is to be sent to
$mail->addAddress($email_user);

//Set the subject line
$mail->Subject = 'Withdrawal Notice:'.$name;

//Read an HTML message rody from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->isHTML(true);
$mail->CharSet = PHPMailer::CHARSET_UTF8;


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
              Congratulations $name!
            </td>
          </tr>
          <tr>
            <td class='free-text'>
            Your request to withdraw has been approved check below to see more details of your withdrawal. 
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
                                <span class='header-sm'>Withdrawal Amount</span><br />
                                Amount : $$amount <br />
                                <br />
                              
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
                                Wallet : $wallet <br />
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
                                <span class='header-sm'>Crypto Currency</span><br />
                                Coin : $coin <br />
                               
                               
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
                                <span class='header-sm'>Transaction ID</span><br />
                                Transaction Id : $reference
                            
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


//send the message, check for errors
if (!$mail->send()) {
 
    $fail = 'Message not sent, try again later'; 
} else {

    $success = 'Message has sent,thank you ';
}
      
$update_total = "UPDATE investments SET amount = '$total' , complete = $complete where reference = $reference";
$run_total = mysqli_query($connect,$update_total);
$sum_total = "SELECT SUM(amount) AS value_sum FROM investments where id_no = $id_no";
$run_sum_total = mysqli_query($connect,$sum_total);
$fetch_sum = mysqli_fetch_assoc($run_sum_total);
$sum_withdraw = "SELECT SUM(amount) AS value_withdraw FROM withdraws where id_no = $id_no";
$run_withdraw = mysqli_query($connect,$sum_withdraw);
$fetch_withdraw = mysqli_fetch_assoc($run_withdraw);
$get_bonus = "SELECT SUM(amount) AS value_bonus FROM bonus where id_no = $id_no";
$run_bonus = mysqli_query($connect,$get_bonus);
$fetch_bonus = mysqli_fetch_assoc($run_bonus);
$get_referal = "SELECT SUM(amount) AS value_referal FROM referals where id_no = $id_no";
$run_referal = mysqli_query($connect,$get_referal);
$fetch_referal = mysqli_fetch_assoc($run_referal);
$get_penalty = "SELECT SUM(amount) AS value_penalty FROM penalty where id_no = $id_no";
$run_penalty = mysqli_query($connect,$get_penalty);
$fetch_penalty = mysqli_fetch_assoc($run_penalty);
$get_funds = "SELECT SUM(amount) AS value_adds FROM add_funds where id_no = $id_no";
$run_funds = mysqli_query($connect,$get_funds);
$fetch_funds = mysqli_fetch_assoc($run_funds);
$get_remove = "SELECT SUM(amount) AS value_remove FROM remove_funds where id_no = $id_no";
$run_remove = mysqli_query($connect,$get_remove);
$fetch_remove = mysqli_fetch_assoc($run_remove);
$balance1 = $fetch_sum['value_sum'] - $fetch_withdraw['value_withdraw'] + $fetch_funds['value_adds'];
$balance2 =  $fetch_bonus['value_bonus'] - $fetch_penalty['value_penalty'] - $fetch_remove['value_remove'];
$balance3 = $fetch_referal['value_referal'];
$balance = $balance1 + $balance2 + $balance3;
$insert_total = "UPDATE wallet SET amount = $balance where id_no = $id_no";
$run_insert_total = mysqli_query($connect,$insert_total);
$insert_feed = "INSERT INTO live_feed (date,type,description,id_no) VALUES('$date','WITHDRAWAL-APPROVED','Your withdrawal request of $btc $coin has been approved and has been sent to your wallet address ','$id_no')";
$run_feed =mysqli_query($connect,$insert_feed);
header("location:../examples/withdraw-request.php?success=true");

?>