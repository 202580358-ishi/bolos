<?php
$host = "localhost";
$dbname = "el_nido_haven";
$username = "root";
$password = "";
$port = 3307; // XAMPP MySQL port

$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
