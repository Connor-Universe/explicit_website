<?php
 include("../../include/config.php");
if(isset($_POST['first1'])){
    $first = $_POST['first'];
    $id = $_POST['id'];

    $update_user = "UPDATE users SET first_name = '$first' where id = $id";
    $run_user = mysqli_query($connect, $update_user);
    header("location:edit_user.php?id=$id#first");
}elseif(isset($_POST['last1'])){
    $last = $_POST['last'];
    $id = $_POST['id'];

    $update_user = "UPDATE users SET last_name = '$last' where id = $id";
    $run_user = mysqli_query($connect, $update_user);
    header("location:edit_user.php?id=$id#last");
}elseif(isset($_POST['email1'])){
    $email = $_POST['email'];
    $id = $_POST['id'];

    $update_user = "UPDATE users SET email = '$email' where id = $id";
    $run_user = mysqli_query($connect, $update_user);
    header("location:edit_user.php?id=$id#email");
}elseif(isset($_POST['wallet1'])){
    $wallet = $_POST['wallet'];
    $id = $_POST['id'];

    $update_user = "UPDATE users SET wallet = '$wallet' where id = $id";
    $run_user = mysqli_query($connect, $update_user);
    header("location:edit_user.php?id=$id#wallet");
}elseif(isset($_POST['username1'])){
    $username = $_POST['username'];
    $id = $_POST['id'];

    $update_user = "UPDATE users SET username = '$username' where id = $id";
    $run_user = mysqli_query($connect, $update_user);
    header("location:edit_user.php?id=$id#username");
}elseif(isset($_POST['country1'])){
    $country = $_POST['country'];
    $id = $_POST['id'];

    $update_user = "UPDATE users SET country = '$country' where id = $id";
    $run_user = mysqli_query($connect, $update_user);
    header("location:edit_user.php?id=$id#country");
}elseif(isset($_POST['password1'])){
    $password = $_POST['password'];
    $id = $_POST['id'];

    $update_user = "UPDATE users SET password_user = '$password' where id = $id";
    $run_user = mysqli_query($connect, $update_user);
    header("location:edit_user.php?id=$id#password");
}elseif(isset($_POST['ip1'])){
    $ip = $_POST['ip'];
    $id = $_POST['id'];

    $update_user = "UPDATE users SET ip = '$ip' where id = $id";
    $run_user = mysqli_query($connect, $update_user);
    header("location:edit_user.php?id=$id#ip");
}elseif(isset($_POST['status1'])){
    $status = $_POST['status'];
    $id = $_POST['id'];
    $get_users = "Select * from users where id = $id";
    $run_users = mysqli_query($connect,$get_users);
    $row_users = mysqli_fetch_array($run_users);
    $statuses = $row_users['Status'];
    $id_nos = $row_users['id_no'];
    $update_user = "UPDATE users SET status= '$status' where id = $id";
    $run_user = mysqli_query($connect, $update_user);
 
    header("location:edit_user.php?id=$id#status");
    if($statuses == "block" && $status != "block"){

        $update_users = "UPDATE users SET status= '$status' where id = $id";
        $run_users = mysqli_query($connect, $update_users);
        $delete_status = "DELETE FROM block_user where id_no = $id_nos";
        $run_delete_status = mysqli_query($connect,$delete_status);
        header("location:edit_user.php?id=$id#status");
    }elseif($status == "block" && $statuses != "block"){
        $get_block_user = "SELECT * from users where id = $id";
        $run_block_user = mysqli_query($connect,$get_block_user);
        $row_block_user = mysqli_fetch_array($run_block_user);
        $first_name = $row_block_user['first_name'];
        $last_name = $row_block_user['last_name'];
        $id_no = $row_block_user['id_no'];
        $ip = $row_block_user['ip'];
        $status_user = $row_block_user['Status'];
        if($row_block_user == 0){
      
       }else{
        $insert_user = "INSERT INTO block_user (first_name,last_name,id_no,ip) VALUES ('$first_name','$last_name','$id_no','$ip')";
        $run_insert_user = mysqli_query($connect,$insert_user);
        header("location:edit_user.php?id=$id#status");
       }
    }

}

?>