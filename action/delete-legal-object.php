<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the object_id from the POST request
    $object_id = $_POST['object_id'];

    // SQL query to delete the parcel
    $sql = "DELETE FROM legal_objects_table WHERE id = $object_id";
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

header("Location: /data/legal");
exit();
