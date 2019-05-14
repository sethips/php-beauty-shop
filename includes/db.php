<?php
    require_once "mydbpassword.php";
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = $mydbpassword;
    $dbName = "phptestproject";

    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);    
