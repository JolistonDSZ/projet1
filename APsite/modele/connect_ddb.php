<?php
$host = "localhost"; 
$username = "root";
$password = "";
$dbname = "pegasus";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {

    die("Connection echoué: " . mysqli_connect_error());
    }
?>