<?php

include("../../include/config.php");
date_default_timezone_set('Etc/UTC');




   
    $first_name_err = $email_err = $last_name_err = $password_err = $btc_address_error = $country_error = $username_err = "";
    $first_name = $email = $last_name = $username = $password = $btc_address = $country = $success = $fail = "";
    



if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $first_name= $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  

  $btc_address = $_POST['wallet'];
 
  $id_no_user = $_POST['id'];
  
  
 //check for unique password 



 //check for unique username
 $column1 = array();
 $get_username = "select username from users where id_no != $id_no_user";
 $run_username = mysqli_query($connect,$get_username);
 while($column_username = mysqli_fetch_array($run_username)){
   $column1[] = $column_username[0];
 }

 //check for unique email address
 $column = array(); 
 $get_email = "select email from users where id_no != $id_no_user";
 $run_email = mysqli_query($connect,$get_email);
while($column_email = mysqli_fetch_array($run_email)){
  $column[] = $column_email[0];
}
 

 
  //the next code is for checking the form data
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if (empty($_POST["first_name"])) {
    $first_name_err = "<div class='alert alert-primary'>
    <strong>ERROR:</strong> First Name is Required!
  </div>";
  } else {
    $first_name = test_input($_POST["first_name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
      $first_name_err = "<div class='alert alert-primary'>
      <strong>ERROR:</strong> Only Letters and whitespace allowed
    </div>";
    }
  }
  if (empty($_POST["last_name"])) {
    $last_name_err = "<div class='alert alert-primary'>
    <strong>ERROR:</strong> Last Name Required!
  </div>";
  } else {
    $last_name = test_input($_POST["last_name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {
      $last_name_err = "<div class='alert alert-primary'>
      <strong>ERROR:</strong> Only Letters and whitespace allowed
    </div>";
    }
  }
  
  if (empty($_POST["username"])) {
    $username_err = "<div class='alert alert-primary'>
    <strong>ERROR:</strong> Username Required
  </div>";
  } else {
    $username = test_input($_POST["username"]);
   if(in_array($username,$column1)){
        $username_err = "<div class='alert alert-primary'>
        <strong>ERROR:</strong> Username is already in use
      </div>";
    }elseif( preg_match('/\s/',$username) ){
      $username_err = "<div class='alert alert-danger'>
   <strong>ERROR:</strong> White Space In Username Is Not Allowed
 </div>";
}
    }
   
 
    if (empty($_POST["email"])) {
      $email_err = "<div class='alert alert-primary'>
      <strong>ERROR:</strong> Email Address is required
    </div>";
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "<div class='alert alert-primary'>
        <strong>ERROR:</strong> Invalid Email format
      </div>";
      }elseif(in_array($email,$column)){
        $email_err = "<div class='alert alert-primary'>
        <strong>ERROR:</strong> Email is already in use
      </div>";
    }
    }


  //if validation is satified then create a token for the user 
  
  
        if ($first_name_err == "" and $last_name_err == "" and $email_err == "" and $username_err == ""  and $btc_address_error == "" and $country_error ==""){
          $get_set = "select * from users where id_no = $id_no_user";
  $run_set = mysqli_query($connect,$get_set);
  $row_set = mysqli_fetch_array($run_set);
  $first_name_set = $row_set['first_name'];
  $last_name_set = $row_set['last_name'];
  $email_set = $row_set['email'];
  $wallet_set = $row_set['wallet'];
  $username_set = $row_set['username'];



  if(!isset($first_name)){
    $first_name = $first_name_set;
  }elseif(!isset($last_name)){
    $last_name = $last_name_set;
  }elseif(!isset($email)){
    $email  = $email_set;
  }elseif(!isset($btc_address )){
    $btc_address  = $wallet_set;
  }elseif(!isset($username)){
    $username = $username_set;
  }
  
      $date = date("Y-m-d H:i:s");
         
  $success= "<div class='alert alert-info'>
  <strong>Success</strong> Profile Settings Updated!
</div> ";
        $update_user = "UPDATE users SET first_name = '$first_name', last_name = '$last_name' , email ='$email' , wallet= '$btc_address' , username =  '$username' where id_no = $id_no_user";
        $run_user = mysqli_query($connect,$update_user);
        $insert_feed = "INSERT INTO live_feed (date,type,description,id_no) VALUES('$date','PROFILE-CHANGE','You made a profile change','$id_no_user')";
        $run_feed =mysqli_query($connect,$insert_feed);
        }
}




  

  




        
  

?>