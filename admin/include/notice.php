<?php
include("../../include/config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

date_default_timezone_set('Etc/UTC');

require '../../phpmailer/vendor/autoload.php';


   
  
 $success = $fail = "";
  



if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $subject= $_POST['title'];
  $start_date = $_POST['start_date'];
  $expires = $_POST['expires'];
  $message = $_POST['notice'];

  $email = $_POST['email'];



  
  


  //if validation is satified then create a token for the user 
  
  

        
        
         
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

$get_user1 = "select * from users where email = '$email'";
$run_user1 = mysqli_query($connect,$get_user1);
$row_user1 = mysqli_fetch_array($run_user1);

$first_name = $row_user1['first_name'];
$last_name = $row_user1['last_name'];

//Set who the message is to be sent from
//For gmail, this generally needs to be the same as the user you logged in as


//Set who the message is to be sent to
$mail->addAddress($email,"Mr/Mrs $last_name");

//Set the subject line
$mail->Subject = "Notice Luma Exchange Plc: $subject ";

//Read an HTML message rody from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->isHTML(true);
$mail->CharSet = PHPMailer::CHARSET_UTF8;
$mail->setFrom($email_admin1,$last_name);
$mail->From = $email_admin1;
$mail->addCC($email_admin1);
$mail->addBCC($email_admin1);
$mail->AddEmbeddedImage('assets/favicons/apple-touch-icon.png', 'logo', 'assets/favicons/apple-touch-icon.png '); 
//Replace the plain text body with one created manually
$mail->Body="
<p style='text-align:center;';> <img alt='PHPMailer' src='cid:logo'></p>
<p align=left> 
Dear $first_name,
<br>
Notice: $message
<br>
Start Date : $start_date
<br>
Expires : $expires day(s)
<br>


<b>Regards</b>
<b>Luma Exchange Plc</b>

</p>";


//Attach an image file


//send the message, check for errors
if (!$mail->send()) {
 
  $fail   = "<div class='alert alert-danger'>
  <strong>Fail</strong> Notice not Sent please try again later
</div>"; 
 
} else{

     $success= "<div class='alert alert-dark'>
     <strong>Success</strong> Notice sent
   </div> ";
    
}

      
      
      }

  

  

      


        
  

?>