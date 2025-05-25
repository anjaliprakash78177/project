<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$servername = "sql305.infinityfree.com";
$username = "if0_39073215";
$password = "DZ8Pu4lwwOj";
$dbname = "if0_39073215_premdiary"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>