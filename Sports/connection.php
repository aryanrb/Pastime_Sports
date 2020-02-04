<?php
    $connection = new mysqli("localhost","root","","pastime_sports");
    if($connection->connect_error)
    {
        die("Connection Failed".$connection->connect_error);
    }
?>