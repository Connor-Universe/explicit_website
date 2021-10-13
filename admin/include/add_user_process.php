<?php
include("../../include/config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

date_default_timezone_set('Etc/UTC');

require '../../phpmailer/vendor/autoload.php';


   
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
if(!isset($_POST["code"])){
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
  
  
        if ($first_name_err == "" and $last_name_err == "" and $email_err == "" and $username_err == "" and $password_err == "" and $btc_address_error == "" and $country_error =="" and $referal_code_err == "" and $referal_code == ""){
        
          $token = substr(md5(time()) , 0 , 16);
          $promo = $username.mt_rand(1000, 100000);
          $id_no = mt_rand(1000000, 10000000);
          $date = date("Y-m-d");
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
$mail->setFrom($email_admin1,$last_name);
$mail->From = $email_admin1;
$mail->addCC($email_admin1);
$mail->addBCC($email_admin1);
$mail->AddEmbeddedImage('assets/favicons/apple-touch-icon.png', 'logo', 'assets/favicons/apple-touch-icon.png '); 
//Replace the plain text body with one created manually
$mail->Body="
<p style='text-align:center;';> <img alt='PHPMailer' src='cid:logo'></p>
<p align=left> 
Hello $first_name $last_name, 
Thank you for registering with $site_name3
<br/>
Email address: $email
<br>
Password : $password

</p>";


//Attach an image file


//send the message, check for errors
if (!$mail->send()) {
 
  $success= "<div class='alert alert-success'>
  <strong>Success</strong> User Successfully Added
</div> ";
  $insert_user = "INSERT INTO users (first_name, last_name , email , wallet , username , country , referal_code , password_user , ip , token , id_no , promo_code ,verified,Status,date) 
  VALUES ('$first_name','$last_name','$email','$btc_address', '$username ' , '$country', '$referal_code', '$password', '$ip', '$token', '$id_no', '$promo', '$verified','$status','$date' )";
  $run_user = mysqli_query($connect,$insert_user);
  $insert_wallet = "INSERT INTO wallet (id_no,amount,date) VALUES('$id_no','0','$date')";
  $run_wallet =mysqli_query($connect,$insert_wallet);


 
} else{

     $success= "<div class='alert alert-success'>
     <strong>Success</strong> User Successfully Added
   </div> ";
     $insert_user = "INSERT INTO users (first_name, last_name , email , wallet , username , country , referal_code , password_user , ip , token , id_no , promo_code ,verified,Status,date) 
     VALUES ('$first_name','$last_name','$email','$btc_address', '$username ' , '$country', '$referal_code', '$password', '$ip', '$token', '$id_no', '$promo', '$verified','$status','$date' )";
     $run_user = mysqli_query($connect,$insert_user);
     $insert_wallet = "INSERT INTO wallet (id_no,amount,date) VALUES('$id_no','0','$date')";
     $run_wallet =mysqli_query($connect,$insert_wallet);

   
}

      
      
      }elseif($first_name_err == "" and $last_name_err == "" and $email_err == "" and $username_err == "" and $password_err == "" and $btc_address_error == "" and $country_error =="" and $referal_code_err == "" and !empty($referal_code)){
        echo"    <script>
        setTimeout(function(){
           window.location.href = '../include/redirect.php?r=$referal_code&&first_name=$first_name&&last_name=$last_name&&email=$email&&wallet=$btc_address&&username=$username&&country=$country&&password=$password&&verified=$verified';
        });
     </script>";
      }

     
    }
  

  

      


        
  

?>