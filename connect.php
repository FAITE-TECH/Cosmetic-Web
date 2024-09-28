<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost:3308"; // usually 'localhost' or provided by your hosting provider
$username = "root";
$password = "";
$dbname = "cosmetic_shop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "Connected Unsuccessfully";
}

?>
