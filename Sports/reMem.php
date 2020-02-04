<?php
    session_start();
    include 'connection.php';

    $user = $_SESSION['user'];
    $query_sel = "SELECT * FROM members WHERE user = '$user'";
    $res = $connection->query($query_sel);
    $data = $res->fetch_assoc();

    $today = date("Y-m-d");
    $edate = $data['endDate'];
    $edate = strtotime($edate);
    $edate = strtotime('+1 year', $edate);
    $expDate = date('Y-m-d', $edate);
    $query = "UPDATE members SET renewedDate='$today', endDate='$expDate' WHERE user = '$user'";
    if(!$connection->query($query))
    {
        die("Sorry Error Occured:".$connection->connect_error);
    }
    header('location:index.php');
?>