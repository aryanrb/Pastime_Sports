<?php
// To check if the user wants to delete his answer
    
    include'connection.php';

    $ansDel = $_GET['ansDId'];
    $query_delAns = "DELETE FROM forumanswer WHERE ansId = '$ansDel'";
    $connection->query($query_delAns);
    header ('location:forum.php');

?>