<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';

use HTMLPurifier\HTMLPurifier;

// Include the database connection file
include '../action/db_connect.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    print_r($_POST);
    $critics = $_POST['critics'];
    $sqlInsertResident = "INSERT INTO critics (critics) VALUES ('$critics')";
    $resultSql = mysqli_query($conn, $sqlInsertResident);
    if ($resultSql) {
        setFlashMessage('success', 'Data saved successfully');
        header("Location: /thanks.php");
        exit();
    } else {
        setFlashMessage('error', 'Failed to save data');
        echo "Error: " . $sql . "<br>" . $conn->error;
        header("Location: /failed.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // get data critics_table
    $sql = "SELECT * FROM critics";
    $result = $conn->query($sql);
    $critics_table = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $critics_table[] = $row;
        }
    }
}
// Close the database connection
$conn->close();
