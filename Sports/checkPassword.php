<?php
include 'connection.php';
session_start();

$user = $_SESSION['user'];
$pass = $_GET['oldPass'];
$qry = "SELECT * FROM memberprofile WHERE password = '$pass' AND uname = '$user'";
$res = $connection->query($qry);

if($res->num_rows>0){
  echo"<span style='color: green'>Matched</span>";
}
else{
  echo"<span style='color: red'>Didnot Matched</span>";
}
?>