<?php

    include 'connection.php';
// open modal with php
    if(isset($_POST['btnSignUp']))
    {
        
        $sFname = $_POST['sFname'];
        $sLname = $_POST['sLname'];
        $sEmail = $_POST['sEmail'];
        $sDob = $_POST['sDob'];
        $sPaddress = $_POST['sPaddress'];
        $sPcode = $_POST['sPcode'];
        $sUser = $_POST['sUser'];
        $sPass = $_POST['sPass'];
        $sType = "user";
        $query_signup = "INSERT INTO memberprofile VALUES ('', '$sFname', '$sLname', '$sDob', '$sEmail', '$sPaddress',
                                                             '$sPcode', '$sUser', '$sPass', '$sType')";
        $data = $connection->query($query_signup);

        header('location:index.php');
        echo"<script> alert'User Registered';</script>";
        echo"<data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>";

    }
?>