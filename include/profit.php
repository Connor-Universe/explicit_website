<?php
  $error = "";
  $profit = 0.00;
  $return = 0.00;
if($_SERVER["REQUEST_METHOD"] == "POST"){
   $invest = $_POST['invest'];
   $plan = $_POST['plan'];
   $get_info = "select * from plans where name = '$plan'";
   $run_info  = mysqli_query($connect,$get_info);
   $row_info = mysqli_fetch_array($run_info);
   $lower_amount = $row_info['lower_amount'];
   $upper_amount = $row_info['upper_amount'];
   $percentage_amount = $row_info['percentage'];
   $days_amount = $row_info['day'];
   if($plan == "select"){
       $error = "<div class='alert alert-dark'>
       <strong>ERROR:</strong> Please select a plan
     </div>";
     echo"    <script>
     setTimeout(function(){
        window.location.href = '#profit';
     });
  </script>";
   }elseif($invest > $upper_amount){
    $error = "<div class='alert alert-dark'>
    <strong>ERROR:</strong> The amount you entered is larger than your selected plan
  </div>";
  echo"    <script>
  setTimeout(function(){
     window.location.href = '#profit';
  });
</script>";
   }elseif($invest < $lower_amount){
    $error = "<div class='alert alert-dark'>
    <strong>ERROR:</strong> The amount you entered is lower than your selected plan
  </div>";
  echo"    <script>
  setTimeout(function(){
     window.location.href = '#profit';
  });
</script>";
   }else{
       $profit = ($percentage_amount/100 * $invest * $days_amount) ;
       $profit = round($profit);
       $return = ($percentage_amount/100 * $invest * $days_amount) + $invest;
       $return = round($return);
       echo"    <script>
       setTimeout(function(){
          window.location.href = '#profit';
       });
     </script>";
       return $profit;
       return $return;
      
   }
 
}
?>