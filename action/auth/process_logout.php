<?php
// Start or resume the session
session_start();
// Include the database connection file
include '../db_connect.php';
// Check if the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     session_destroy();
//     header("Location: /");
//     exit();
// }

session_destroy();
header("Location: /");
exit();

$conn->close();
