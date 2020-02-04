<?php
    include 'connection.php';

    $cdate = date("Y-m-d");
    $edate = date("Y-m-d", strtotime('+1 years'));
    
    $query = "UPDATE members SET startDate='$cdate',endDate='$edate' WHERE id='".$_GET['uId']."'";
    if($connection->query($query)){
        header("location: memberRequest.php");
    }
    die("Error". $conn->error);
?>