<?php 
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'ta_toko';
$mysqli = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName)
        or die('Error Connecting to MySQL DataBase');