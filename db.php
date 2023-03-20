<?php
date_default_timezone_set('Asia/Kolkata');


$host = 'localhost';
$dbname = 'users';
$username = 'root';
$password = '';
$timezone = "+05:30"; // set timezone to IST

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("SET time_zone='$timezone';"); // set timezone for the current session to IST
?>
