<?php

include "../../include/config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;


date_default_timezone_set('Etc/UTC');

require '../../phpmailer/vendor/autoload.php';
   // define variables and set to empty values
$email = $name = $wallet = $amount = $id ="";
$success = $fail = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $wallet = $_POST['wallet'];
    $amount = $_POST['amount'];
    $id = $_POST['id'];
        
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



//Set who the message is to be sent from
//For gmail, this generally needs to be the same as the user you logged in as


//Set who the message is to be sent to
$mail->addAddress($email);



//Read an HTML message rody from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->isHTML(true);
$mail->CharSet = PHPMailer::CHARSET_UTF8;
$mail->setFrom($email_admin,$name);
$mail->From = $email_admin;
$mail->addCC($email_admin);
$mail->addBCC($email_admin);
$mail->AddEmbeddedImage('../../assets/images/logo.png', 'logo', '../../assets/images/logo.png '); 

//Set the subject line
$mail->Subject = 'Withdrawal Invoice:'.$name;

//Read an HTML message rody from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->isHTML(true);
$mail->CharSet = PHPMailer::CHARSET_UTF8;


//Replace the plain text body with one created manually
$mail->Body="'<p><b>Dear </b></p>'.$name. '<p>Your request to withdraw '.$amount.'from your account has been processed and sent to your stipulated wallet address 
'.$wallet.'</p> <br> <p>Transaction ID: <a href='https://wwww.blockchain.com/btc/tx/$id'>https://wwww.blockchain.com/btc/tx/$id</a> </p> <br> <p>Coin:bitcoin</p> <br> <p>Thank you for investing with us . We anticipate more investments and referrals from you</p> <br> <b>Regards</b><br> <b>Luma Exchange Plc</b>'";


//Attach an image file


//send the message, check for errors
if (!$mail->send()) {
 
    $fail = 'Message not sent, try again later'; 
} else {

    $success = 'Message has sent,thank you ';
}



      }
      
  



 





?>