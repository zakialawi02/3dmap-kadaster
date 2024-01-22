<?php
// Start or resume the session
session_start();
// Include the database connection file
include 'db_connect.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $parcelId = $_POST['parcelId'];
    $parcelName = $_POST['parcelName'];
    $parcelOccupant = $_POST['parcelOccupant'];
    $tag = $_POST['multiSelectTag'];

    if (!empty($tag)) {
        $tag = implode(', ', $tag);
    } else {
        $tag = "";
    }

    echo $parcelId . "<br>";
    echo $parcelName . "<br>";
    echo $parcelOccupant . "<br>";
    echo $tag . "<br>";

    // Prepare and execute the SQL query
    $sql = "INSERT INTO parcel_table (parcel_id, parcel_name, parcel_occupant, tag) VALUES ('$parcelId', '$parcelName', '$parcelOccupant', '$tag')";

    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully";
        // Set success message
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();

    header("Location: /data/add-parcel.php");
    exit();
}
