<?php

include("config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

date_default_timezone_set('Etc/UTC');

require 'phpmailer/vendor/autoload.php';

   // define variables and set to empty values
$first_name_err = $email_err = $last_name_err = $message_err = $subject_err = $phone_num_err = "";
$first_name = $email = $last_name = $message = $phone = $subject = $success = $fail = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
  
  if (empty($_POST["message"])) {
    $message_err = "<div class='alert alert-danger'>
    <strong>ERROR:</strong> Message is required
  </div>";
  } else {
    $message = test_input($_POST["message"]);
    
    }
  
  if (empty($_POST["subject"])) {
    $subject_err = "<div class='alert alert-danger'>
    <strong>ERROR:</strong> Subject is Required
  </div>";
  } else {
    $subject = test_input($_POST["subject"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$subject)) {
      $subject_err = "<div class='alert alert-danger'>
      <strong>ERROR:</strong> Only Letters and whitespace allowed
    </div>";
    }
  }
  if (empty($_POST["email"])) {
    $email_err = "<div class='alert alert-danger'>
    <strong>ERROR:</strong> Email is Required
  </div>";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_err = "<span class='error'>Invalid email format!</span>";
    }
  }
 
   if ($first_name_err == "" and $email_err == "" and $subject_err == "" and $message_err == ""){
   
       

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
    $mail->addAddress($email_admin1,"New Message from $first_name");
    
    //Set the subject line
    $mail->Subject = 'Contact Form:'.$subject;
    
    //Read an HTML message rody from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->isHTML(true);
    $mail->CharSet = PHPMailer::CHARSET_UTF8;
    $mail->setFrom($email,$last_name);
    $mail->From = $email;
    $mail->addCC($email);
    $mail->addBCC($email);
    $mail->AddEmbeddedImage('assets/images/logo2.png', 'logo', 'assets/images/logo2.png '); 
    //Replace the plain text body with one created manually
    $mail->Body='<h1 align=center>FirstName:'.$first_name.'<br>LastName:'.$last_name.'<br>
    PhoneNumber:'.$_POST['phone'].'<br>Email:'.$email.'<br>Subject:'.$subject.'
    <br>Message:'.$message.'</h1>';

        

        if (!$mail->send()){
          $success =  "<div class='alert alert-danger'>
          <strong>Failed</strong> Seems there is a problem, if problem persists, please try again later
        </div> ";
        }else{
      
          $fail =   "<div class='alert alert-success'>
          <strong>Success</strong> Message has sent! Thank you $first_name for contacting $site_name3
        </div> ";
        
        
        }
      }
      
  
}


 





?>