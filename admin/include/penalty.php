<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\OAuth;
 use League\OAuth2\Client\Provider\Google;
 include("../../include/config.php");
  $get_admin ="select * from settings";
 $run_email = mysqli_query($connect,$get_admin);
 $row_email = mysqli_fetch_array($run_email);
 $email_admin = $row_email['email'];
 if(!isset($row_email['email'])){
     $email_admin = "";
 }
if(isset($_POST['add'])){
   
require '../../phpmailer/vendor/autoload.php';
    $amount = $_POST['amount'];
    $id_no = $_POST['id'];
    $get_user = "select * from users where id_no = $id_no";
    $run_user = mysqli_query($connect,$get_user);
    $row_user = mysqli_fetch_array($run_user);
    $first_name = $row_user['first_name'];
    $last_name = $row_user['last_name'];
    $email = $row_user['email'];
    $wallet = $row_user['wallet'];
    $reference_id = mt_rand(10000000 , 999999999);
    $date12 = date("Y-m-d H:i:s");

    date_default_timezone_set('Etc/UTC');


  
        
//Create a new PHPMailer instance
$mail = new PHPMailer;

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


//Set who the message is to be sent to
$mail->addAddress($email);

//Set the subject line
$mail->Subject = "Penalty Notification: $first_name $last_name";

//Read an HTML message rody from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->isHTML(true);
$mail->CharSet = PHPMailer::CHARSET_UTF8;
$mail->setFrom($email_admin,$last_name);
$mail->From = $email_admin;
$mail->addCC($email_admin);
$mail->addBCC($email_admin);
$mail->AddEmbeddedImage('../../assets/images/logo.png', 'logo', '../../assets/images/logo.png '); 
//Replace the plain text body with one created manually
$mail->Body="
<p style='text-align:center;';> <img alt='PHPMailer' src='cid:logo'></p>
<p align=left> 
Hello $first_name $last_name,</p> <p> A Penalty has been deducted from your wallet! Here is your penalty information</p>
<p> Amount:$amount </p>
<p> Wallet : $wallet</p>
<p> Reference Id : $reference_id</p>
<p> Regards From </p>
<p> $site_name3</p>";


//Attach an image file


//send the message, check for errors
if (!$mail->send()) {
 
    $fail = 'Message not sent, try again later'; 
} else {

    $success = 'Message has sent,thank you ';
}

    $insert_bonus = "INSERT INTO penalty (id_no,amount,reference_id,date) VALUES('$id_no','$amount','$reference_id','$date12')";
    $run_bonus = mysqli_query($connect, $insert_bonus);
    $investments = "select * from investments where id_no = $id_no";
$run_investments = mysqli_query($connect,$investments);
$row_invest = mysqli_fetch_array($run_investments);
$amount = $row_invest['amount'];
$percentage = $row_invest['percentage'];
$date = $row_invest['date'];
$days = $row_invest['day'];

$reference = $row_invest['reference_id'];
$date_end = $row_invest['date_end'];
$complete = $row_invest['complete'];
if(isset($percentage) && isset($amount)){
    $divide = $amount / $percentage ;
}else{
    $divide=0;
}

// Set end date
$start = time();
$end = strtotime($date_end);

$elapsed = $end - $start; // elapsed seconds since start

$counts = floor(($days*60*60*24)/$elapsed); // number of 40 minutes that has elapsed

$total = $amount + ($divide*$counts);

if($start == $end){
    $elapsed = 1;
    $complete = 1;
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
$insert_feed = "INSERT INTO live_feed (date,type,description,id_no) VALUES('$date12','PENALTY','A Penalty of $$amount USD has Been sent to your wallet ','$id_no')";
$run_feed =mysqli_query($connect,$insert_feed);
    header("location:../examples/add_penalty.php?success=true#$id_no");
}

?>