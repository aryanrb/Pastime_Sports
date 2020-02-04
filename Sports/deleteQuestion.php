<?php
    // To check if the user wants to delete his question
    include'connection.php';
    $qnDel = $_GET['qnDId'];
    $query_delQn = "DELETE FROM forumquestion WHERE qnId = '$qnDel'";
    $connection->query($query_delQn);
    header ('location:forum.php');

?>