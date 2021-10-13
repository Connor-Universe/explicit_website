<?php
session_start();
include("../../include/config.php");

$get_id = "select * from users where token='$_SESSION[token]'";
$run_id = mysqli_query($connect,$get_id);
$row_id = mysqli_fetch_array($run_id);
$id_no = $row_id['id_no'];
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
header("location:../examples/wallet.php");

?>