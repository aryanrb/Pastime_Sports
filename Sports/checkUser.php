<?php
    include 'connection.php';

    $newUser = $_GET['txtValue'];
    $query_checkUser = "SELECT * FROM memberprofile WHERE uname = '$newUser'";

    $getUser = $connection->query($query_checkUser);
    if($getUser->num_rows == 1)
    {
        echo "User exists";
    }

?>