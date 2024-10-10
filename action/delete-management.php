<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user from the POST request
    $id = $_POST['id'];

    // SQL query to delete the parcel
    $sql = "DELETE FROM managements_table WHERE id = '$id'";
    $conn->query($sql);
    if (mysqli_affected_rows($conn) > 0) {
        setFlashMessage('success', 'Data deleted successfully');
    } else {
        setFlashMessage('error', 'Data delete failed');
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

header("Location: /data/organizer/");
exit();
