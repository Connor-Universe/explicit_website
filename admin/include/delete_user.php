<?php


	 include("../../include/config.php");
  $id_no = $_GET['id_no'];
	$delete = "DELETE FROM users WHERE id_no=$id_no";
    $run = mysqli_query($connect,$delete);
    
    $delete1 = "DELETE FROM wallet WHERE id_no=$id_no";
    $run1 = mysqli_query($connect,$delete1);
    $delete2 = "DELETE FROM add_funds WHERE id_no=$id_no";
    $run2 = mysqli_query($connect,$delete2);
    $delete3 = "DELETE FROM remove_funds WHERE id_no=$id_no";
    $run3 = mysqli_query($connect,$delete3);
    $delete4 = "DELETE FROM investments WHERE id_no=$id_no";
    $run4 = mysqli_query($connect,$delete4);
    $delete5 = "DELETE FROM withdraws WHERE id_no=$id_no";
    $run5 = mysqli_query($connect,$delete5);
    $delete6 = "DELETE FROM referals WHERE id_no=$id_no";
    $run6 = mysqli_query($connect,$delete6);
    $delete7 = "DELETE FROM bonus WHERE id_no=$id_no";
    $run7 = mysqli_query($connect,$delete7);
    $delete8 = "DELETE FROM penalty WHERE id_no=$id_no";
    $run8 = mysqli_query($connect,$delete8);


     
      header("location:../examples/members.php?success=true");
   
           
		
?>