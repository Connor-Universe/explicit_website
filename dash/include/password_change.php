<?php

include("../../include/config.php");
date_default_timezone_set('Etc/UTC');




   
 $success = $password_err =  "";
    $password ="";
    



if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
 
  $id_no_user = $_POST['id'];
  
  
 //check for unique password 



 //check for unique username
 $column2 = array();
 $get_password = "select password_user from users";
 $run_password = mysqli_query($connect,$get_password);
 while($column_password = mysqli_fetch_array($run_password)){
   $column2[] = $column_password[0];
 }
 

 
  //the next code is for checking the form data
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  if (empty($_POST["password"])) {
    $password_err = "<div class='alert alert-primary'>
    <strong>ERROR:</strong> Password is required
  </div>";
  } else {
    $password = test_input($_POST["password"]);
    // check if name only contains letters and whitespace
    if($password != $password2){
        $password_err = "<div class='alert alert-primary'>
        <strong>ERROR:</strong> Passwords are not the same
      </div> ";
      } elseif(in_array($password,$column2)){
        $password_err = "<div class='alert alert-primary'>
        <strong>ERROR:</strong> This password is already in use 
      </div>";
    }
  }

  //if validation is satified then create a token for the user 
  
  
        if ( $password_err ==""){
        


      $date = date("Y-m-d H:i:s");
         
  $success= "<div class='alert alert-info'>
  <strong>Success</strong> Password Updated!
</div> ";
        $update_user = "UPDATE users SET password_user = '$password' where id_no = $id_no_user";
        $run_user = mysqli_query($connect,$update_user);
        $insert_feed = "INSERT INTO live_feed (date,type,description,id_no) VALUES('$date','PASSWORD-CHANGE','You made a password change','$id_no_user')";
        $run_feed =mysqli_query($connect,$insert_feed);
        }
}




  

  




        
  

?>