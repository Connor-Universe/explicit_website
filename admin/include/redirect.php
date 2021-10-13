<?php
include("../../include/config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;


date_default_timezone_set('Etc/UTC');

require '../../phpmailer/vendor/autoload.php';

      //referal email

      if(isset($_GET['r'])){
          $referal_code = $_GET['r'];
        $get_user ="select * from users where promo_code = '$referal_code'";
        $run_user = mysqli_query($connect,$get_user);
        $row_user = mysqli_fetch_array($run_user);
        $first_name1 = $row_user['first_name'];
        $last_name1 = $row_user['last_name'];
        $email12 = $row_user['email'];
        $first_name= $_GET['first_name'];
        $last_name = $_GET['last_name'];
        $email = $_GET['email'];
        $wallet = $_GET['wallet'];
        $username = $_GET['username'];
        $country = $_GET['country'];
        $password=$_GET['password'];
        $status = "active";
        $verified = 1;
        $date = date("Y-m-d");
         
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
$mail->SMTPDebug  = 2;    
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


//Set who the message is to be sent to
$mail->addAddress($email12,"Mr/Mrs".$last_name);

//Set the subject line
$mail->Subject = "Referal Email: $site_name3";

//Read an HTML message rody from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->isHTML(true);
$mail->CharSet = PHPMailer::CHARSET_UTF8;
$mail->From = $email_admin1;
$mail->setFrom($email_admin1,$last_name);
$mail->addCC($email_admin1);
$mail->addBCC($email_admin1);
$mail->AddEmbeddedImage('../assets/favicons/apple-touch-icon.png', 'logo', '../assets/favicons/apple-touch-icon.png '); 

//Replace the plain text body with one created manually
$mail->Body="
<p style='text-align:center;';> <img alt='PHPMailer' src='cid:logo'></p>
<p align=left> 
Hello $first_name1 $last_name1, 
Congratulations! A user has used your referal link to register on our platform! You will now receive a 5% comission on any investment package they choose from! keep refering more users and get larger and larger referal bonuses! 
</p>";


//Attach an image file
$success= "<div class='alert alert-dark'>
<strong>Success</strong> User Added Successfully
</div> ";
$insert_user = "INSERT INTO users (first_name, last_name , email , wallet , username , country , referal_code , password_user , ip , token , id_no , promo_code ,verified,Status,date) 
VALUES ('$first_name','$last_name','$email','$wallet', '$username ' , '$country', '$referal_code', '$password', '$ip', '$token', '$id_no', '$promo', '$verified','$status','$date' )";
$run_user = mysqli_query($connect,$insert_user);
$insert_wallet = "INSERT INTO wallet (id_no,amount,date) VALUES('$id_no','0','$date')";
$run_wallet =mysqli_query($connect,$insert_wallet);

echo"    <script>
setTimeout(function(){
  window.location.href = '../examples/add_user.php';
});
</script>";

//send the message, check for errors
if (!$mail->send()) {


} else {


  
}
      

    }

 
        // end of referal email

?>