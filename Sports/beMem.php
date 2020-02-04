<?php
    include 'connection.php';

    session_start();

    $user = $_SESSION['user'];
    $query_sel = "SELECT * FROM members WHERE user = '$user'";
    $data_sel = $connection->query($query);

    if($data_sel->num_rows >= 1)
    {
        header('location:index.php');
    }
    else
    {
        $query = "INSERT INTO members VALUES('','$user','0000-00-00','0000-00-00','0000-00-00','5000','Requested')";
        if(!$connection->query($query))
        {
            die("Sorry Error Occured:".$connection->connect_error);
        }
    }
    header('location:index.php');
?>