<?php
// autoload composer
require_once __DIR__ . '../../vendor/autoload.php';
// db_connect.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rrrcadastre";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "Database Connection Failed!...";
    die("Connection failed: " . $conn->connect_error);
}
