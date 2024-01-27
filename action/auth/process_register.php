<?php
// Start or resume the session
session_start();
// Include the database connection file
include '../db_connect.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    echo $email;
    echo $hashed_password;

    // Prepare and execute the SQL query
    $sqlInsertUser = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";
    $resultSql = mysqli_query($conn, $sqlInsertUser);
    if ($resultSql) {
        echo "Data saved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

header("Location: /data/user/add-user.php");
exit();
