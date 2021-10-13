<?php
include("../../include/config.php");
if(isset($_GET['id'])){
    
    $id = $_GET['id'];

    $delete_plan = "DELETE FROM plans where id = $id";
    $run_plan = mysqli_query($connect,$delete_plan);

    header("location:edit-investment.php");
}


?>