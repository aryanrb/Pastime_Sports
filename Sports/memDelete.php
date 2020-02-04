<?php
include'connection.php';

$query = "DELETE FROM members WHERE id = '".$_GET['dId']."'";
if($connection->query($query)){
    header("location: memberRequest.php");
}
die("Error". $conn->error);
?>