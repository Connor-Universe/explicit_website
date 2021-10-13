<?php
 include("../../include/config.php");
if(isset($_POST['edit'])){
    $name = $_POST['name'];
    $percentage = $_POST['percentage'];
    $lower = $_POST['lower'];
    $upper = $_POST['upper'];
    $day = $_POST['day'];
    $id = $_POST['id'];

    $update_plan = "UPDATE plans SET name = '$name' , lower_amount = $lower, upper_amount = $upper , percentage = $percentage , day = $day where id = $id";
    $run_update = mysqli_query($connect,$update_plan);

    header("location:edit_plan.php?id=$id#edit");
}


?>