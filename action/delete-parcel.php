<?php
// Include the database connection file
include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    print_r($_POST);

    // Get the parcel_id from the POST request
    $parcelId = $_POST['parcel_id'];

    // SQL query to delete the parcel
    $sql = "DELETE FROM parcel_table WHERE id = $parcelId";

    if ($conn->query($sql) === TRUE) {
        echo "Data deleted successfully";
        // Set success message
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

header("Location: /data/parcel");
exit();
