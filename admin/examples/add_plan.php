<?php
include("../include/config.php");
if(isset($_POST['Add'])){
    $name = $_POST['name'];
    $percentage = $_POST['percentage'];
    $lower = $_POST['lower'];
    $upper = $_POST['upper'];
    $day = $_POST['day'];


    $add_plan = "INSERT INTO plans (name,lower_amount,upper_amount,percentage,day) VALUES('$name','$lower','$upper','$percentage','$day')";
    $run_plan = mysqli_query($connect,$add_plan);

    header("location:investment_package.php");
}


?>