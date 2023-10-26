<?php

$localhost = "localhost";
$username = "root";
$password = "";
$database_name = "sr";

$con = mysqli_connect($localhost, $username, $password, $database_name);

if (!$con) {
    echo ("Not Conncected ");
} 
