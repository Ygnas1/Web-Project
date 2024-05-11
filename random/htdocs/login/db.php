<?php
// Database credentials
$dbhost = "localhost";  // or the IP address of your database server
$user_name = "user_name";
$password = "password";
$dbname = "login_sample_db";

// Create a MySQL connection
$conn = new mysqli($dbhost, $user_name, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, you could also set the character set to ensure proper encoding
$conn->set_charset("utf8");