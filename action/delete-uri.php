<?php
// Include the database connection file
include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    print_r($_POST);

    // Get the parcel_id from the POST request
    $UriId = $_POST['uri_id'];
    echo $UriId;
    // SQL query to delete the parcel
    $sql = "DELETE FROM uri_table WHERE id_keyword = $UriId";

    if ($conn->query($sql) === TRUE) {
        echo "Data deleted successfully";
        // Set success message
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// echo "<pre>";
// print_r($parcel_table);

// Close the database connection
$conn->close();

header("Location: /data/uri");
exit();
