<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include_once '../db_connect.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    echo $email;
    echo $hashed_password;

    // Prepare and execute the SQL query
    // Add the missing import statement
    include_once '../db_connect.php';

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        setFlashMessage('error', 'Email already exists');
        header("Location: /data/user/add-user.php");
        exit();
    }
    $sqlInsertUser = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";
    $resultSql = mysqli_query($conn, $sqlInsertUser);
    if ($resultSql) {
        setFlashMessage('success', 'Data saved successfully');
    } else {
        setFlashMessage('error', 'Failed to save data');
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();


header("Location: /data/user/");
exit();
