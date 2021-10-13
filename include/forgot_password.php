<?php

include "config.php";

    $update_admin = "update settings SET admin_username = 'admin', admin_password = 'admin'";
    $run_admin = mysqli_query($connect,$update_admin);
   
    header("location:../admin.php?change=1");



?>