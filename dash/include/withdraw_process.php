<?php

include("../../include/config.php");





   
    $amount= "";
    $verified = 0;
    $wallet = "";
    



if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $amount= $_POST['amount'];
  $wallet = $_POST['wallet'];
  $coin = $_POST['coin'];
  $get_krypto = "select * from crypto_wallet where abb = '$coin'";
$run_krypto = mysqli_query($connect,$get_krypto);
$row_krypto = mysqli_fetch_array($run_krypto);
$coin1 = $row_krypto['name'];
  $get_user = "select * from users where token = '$_SESSION[token]'";
  $run_user = mysqli_query($connect,$get_user);
  $row_user = mysqli_fetch_array($run_user);
 
  $first_name2 = $row_user['first_name'];
  $last_name2 = $row_user['last_name'];
  $id_no2 = $row_user['id_no'];
  $date = date("Y-m-d H:i:s");

  $reference_id = mt_rand(10000000 , 99999999);
  $trans_id = mt_rand(10000000 , 99999999);
  
  $dollars=$amount;
     $url = 'https://pro-api.coinmarketcap.com/v1/tools/price-conversion';
                          $parameters = [
                            'amount' => $dollars,
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
                          $dollars =  $price["data"]["quote"][$coin]["price"];
                          curl_close($curl); // Close request
                      
 

   
        

         
        $insert_request = "INSERT INTO withdraw_request (first_name , last_name , wallet , id_no , amount , btc , reference_no , verified,transaction_id,date,coin) 
        VALUES ('$first_name2','$last_name2','$wallet','$id_no2','$amount','$dollars','$reference_id','$verified','$trans_id','$date','$coin1')";
        $run_request = mysqli_query($connect,$insert_request);
        $insert_feed = "INSERT INTO live_feed (date,type,description,id_no) VALUES('$date','WITHDRAW-REQUEST','You made a withdrawal request of $dollars $coin1(waiting approval)','$id_no2')";
        $run_feed =mysqli_query($connect,$insert_feed);
        $_SESSION['reference_no'] = $reference_id;
        echo "<script>window.open('../examples/withdraw-invoice.php','_self')</script>";
        
}




  

  




        
  

?>