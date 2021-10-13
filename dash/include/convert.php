<?php

include("../../include/config.php");





   
    $amount= "";
    $verified = 0;
    
    



if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $amount= $_POST['amount'];
  $coin = $_POST['coin'];
$get_krypto = "select * from crypto_wallet where abb = '$coin'";
$run_krypto = mysqli_query($connect,$get_krypto);
$row_krypto = mysqli_fetch_array($run_krypto);
$coin1 = $row_krypto['name'];
  $ramount = $amount * $amount_settings/100;
  $plan_id = $_POST['id'];
  $get_user = "select * from users where token = '$_SESSION[token]'";
  $run_user = mysqli_query($connect,$get_user);
  $row_user = mysqli_fetch_array($run_user);
 
  $first_name2 = $row_user['first_name'];
  $last_name2 = $row_user['last_name'];
  $email2= $row_user['email'];
  $wallet2 = $row_user['wallet'];
  $username2 = $row_user['username'];
  $country2 = $row_user['country'];
  $password2 = $row_user['password_user'];
  $id_no2 = $row_user['id_no'];
  $referal_code2 = $row_user['referal_code'];
  $reference_id = mt_rand(10000000 , 99999999);

  $get_request = "select * from investment_request where referal_code = '$referal_code2' and id_no = $id_no2 and verified = 1";
$run_request = mysqli_query($connect,$get_request);
$row_request = mysqli_fetch_array($run_request);
$get_refer_user = "select * from users where promo_code = '$referal_code2'";
$run_refer_user = mysqli_query($connect,$get_refer_user);
$row_refer_user = mysqli_fetch_array($run_refer_user);
$email5 = $row_refer_user['email'];
$first_name5 = $row_refer_user['first_name'];
$last_name5 = $row_refer_user['last_name'];
$wallet5= $row_refer_user['wallet'];
$id_no3 = $row_refer_user['id_no'];
$date = date("Y-m-d H:i:s");
   
  if($row_request == ""){
    if(isset($id_no3)){

      $insert_referal = "insert into referals (id_no,amount,date) VALUES('$id_no3','$ramount','$date')";
      $run_referal = mysqli_query($connect,$insert_referal);
      $insert_feed = "INSERT INTO live_feed (date,type,description,id_no) VALUES('$date','COMMISSION','You received an affliate commission from your referal','$id_no3')";
        $run_feed =mysqli_query($connect,$insert_feed);
    }

$reference_id = mt_rand(10000000 , 99999999);

  $get_plan = "select name from plans where id = '$plan_id'";
  $run_plan = mysqli_query($connect,$get_plan);
  $row_plan = mysqli_fetch_array($run_plan);

  $plan_name = $row_plan['name'];
                           
                          $url = 'https://pro-api.coinmarketcap.com/v1/tools/price-conversion';
                          $parameters = [
                            'amount' => $amount,
                            'symbol' => 'USD',
                            'convert' => $coin
                          ];
                          
                          $headers = [
                            'Accepts: application/json',
                            'X-CMC_PRO_API_KEY: 520f4f7a-6d18-4db0-84cd-483a28eaa755'
                          ];
                          $qs = http_build_query($parameters); // query string encode the parameters
                          $request = "{$url}?{$qs}"; // create the request URL
                          
                          
                          $curl = curl_init(); // Get cURL resource
                          // Set cURL options
                          curl_setopt_array($curl, array(
                            CURLOPT_URL => $request,            // set the request URL
                            CURLOPT_HTTPHEADER => $headers,     // set the headers 
                            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
                          ));
                          
                          $response = curl_exec($curl);
                           // Send the request, save the response
                          $price = json_decode($response,true); // print json decoded response
                          $dollars= $price["data"]["quote"][$coin]["price"];
                          curl_close($curl); // Close request
                      
   
   
        

         
        $insert_request = "INSERT INTO investment_request (first_name , last_name , email , referal_code , country , wallet , id_no , plan , amount_invest , verified  , btc , reference_id,date,coin) 
        VALUES ('$first_name2','$last_name2','$email2','$referal_code2','$country2','$wallet2','$id_no2','$plan_name','$amount','$verified','$dollars','$reference_id','$date','$coin1')";
        $run_request = mysqli_query($connect,$insert_request);
        $insert_feed = "INSERT INTO live_feed (date,type,description,id_no) VALUES('$date','DEPOSIT-REQUEST','You made a deposit request of $dollars $coin1(waiting approval)','$id_no2')";
        $run_feed =mysqli_query($connect,$insert_feed);
        $_SESSION['reference_id'] = $reference_id;
        header("location:../examples/invoice.php");



  //if validation is satified then create a token for the user 
  
         
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



//Set who the message is to be sent from
//For gmail, this generally needs to be the same as the user you logged in as
$mail->setFrom($email_admin1,$last_name);

//Set who the message is to be sent to
$mail->addAddress($email5,"Mr/Mrs $last_name5");

//Set the subject line
$mail->Subject = 'Referal bonus email: Luma Exhcnage Plc';

//Read an HTML message rody from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->isHTML(true);
$mail->CharSet = PHPMailer::CHARSET_UTF8;
$mail->setFrom($email_admin1,$last_name);
$mail->From = $email_admin1;
$mail->addCC($email_admin1);
$mail->addBCC($email_admin1);
$mail->AddEmbeddedImage('../../assets/images/logo.png', 'logo', '../../assets/images/logo.png '); 
//Replace the plain text body with one created manually
$mail->Body="
<p style='text-align:center;';> <img alt='PHPMailer' src='cid:logo'></p>
<p align=left> 
Hello $first_name5 $last_name5,</p> <p> Thank you for referring $first_name2 $last_name2 ,Your referee has invested $amount into their wallet, So you will be getting a 5% comission on their referal </p>
<p> You will receive $ramount into your wallet $wallet5 . Thank you for your referal , we hope to see more from you in the future</p>
<p> Regards From </p>
<p> Luma Exchange Plc </p>";


//Attach an image file


//send the message, check for errors

     }else{

         $referal_code2 = "";  
          $get_plan = "select name from plans where id = '$plan_id'";
  $run_plan = mysqli_query($connect,$get_plan);
  $row_plan = mysqli_fetch_array($run_plan);

  $plan_name1 = $row_plan['name'];
  
$url = 'https://pro-api.coinmarketcap.com/v1/tools/price-conversion';
                          $parameters = [
                            'amount' => $amount,
                            'symbol' => 'USD',
                            'convert' => $coin
                          ];
                          
                          $headers = [
                            'Accepts: application/json',
                            'X-CMC_PRO_API_KEY: 520f4f7a-6d18-4db0-84cd-483a28eaa755'
                          ];
                          $qs = http_build_query($parameters); // query string encode the parameters
                          $request = "{$url}?{$qs}"; // create the request URL
                          
                          
                          $curl = curl_init(); // Get cURL resource
                          // Set cURL options
                          curl_setopt_array($curl, array(
                            CURLOPT_URL => $request,            // set the request URL
                            CURLOPT_HTTPHEADER => $headers,     // set the headers 
                            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
                          ));
                          
                          $response = curl_exec($curl);
                           // Send the request, save the response
                          $price = json_decode($response,true); // print json decoded response
                          $dollars1 = $price["data"]["quote"][$coin]["price"];
                          curl_close($curl); // Close request
                      
  
        

        $insert_request = "INSERT INTO investment_request (first_name , last_name , email , referal_code , country , wallet , id_no , plan , amount_invest , verified  , btc , reference_id,date,coin) 
        VALUES ('$first_name2','$last_name2','$email2','$referal_code2','$country2','$wallet2','$id_no2','$plan_name1','$amount','$verified','$dollars1','$reference_id','$date','$coin1')";
        $run_request = mysqli_query($connect,$insert_request);
        $insert_feed = "INSERT INTO live_feed (date,type,description,id_no) VALUES('$date','DEPOSIT-REQUEST','You made a deposit request of $dollars1 $coin1 (waiting approval)','$id_no2')";
        $run_feed =mysqli_query($connect,$insert_feed);
    
        $_SESSION['reference_id'] = $reference_id;
        header("location:../examples/invoice.php");
     }   
}




  

  




        
  

?>