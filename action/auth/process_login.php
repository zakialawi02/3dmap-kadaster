<?php
// Start or resume the session
session_start();
// Include the database connection file
include '../db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/fucntion.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    echo $email;
    echo $password;

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) < 1) {
        setFlashMessage('error', 'Email or Password is incorrect');
        header("Location: /auth/login.php");
        exit();
    }
    if ($result) {
        // User found, check if the password is correct
        $user = mysqli_fetch_assoc($result);
        $hashedPassword = $user['password'];
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, login successful, set session
            $_SESSION['islogin']['status'] = true;
            $_SESSION['islogin']['userid'] = $user['id'];
            echo "Login successful!";
            header("Location: /dashboard");
            exit();
        } else {
            // Password is incorrect
            setFlashMessage('error', 'Email or Password is incorrect');
            header("Location: /auth/login.php");
            exit();
        }
    } else {
        // User not found
        echo "User not found!";
        header("Location: /auth/login.php");
        exit();
    }
}

$conn->close();

die;
