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
$date = date("Y-m-d H:i:s");
$btc = $_GET['btc'];
$reference = $_GET['reference'];
$coin = $_GET['coin'];
$delete = "UPDATE withdraw_request SET verified = 2 WHERE id= $id";
$run = mysqli_query($connect,$delete);
$result = $run;


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
$mail->setFrom($email_admin1,$last_name);
$mail->From = $email_admin1;
$mail->addCC($email_admin1);
$mail->addBCC($email_admin1);

$mail->AddEmbeddedImage('../../assets/favicons/apple-touch-icon.png', 'logo', '../../assets/favicons/apple-touch-icon.png '); 

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
$mail->Body="<p>
Dear $name </p> 
<p>
Your request to withdraw has been Declined. Please contact the support team for more details </p>
<p> We anticipate more investments and referrals from you</p> 
<b>Regards</b>
<br> 
<b>$site_name3</b>";


//Attach an image file


//send the message, check for errors
if (!$mail->send()) {
 
    $fail = 'Message not sent, try again later'; 
} else {

    $success = 'Message has sent,thank you ';
}
$insert_feed = "INSERT INTO live_feed (date,type,description,id_no) VALUES('$date','WITHDRAWAL-DECLINED','Your Withdrawal request of $btc $coin has been declined and has not been sent to your wallet address ','$id_no')";
$run_feed =mysqli_query($connect,$insert_feed);

header("location:../examples/withdraw-request.php?success=false");

?>