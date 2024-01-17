<?php
// Start or resume the session
session_start();

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

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rrrcadastre";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query
    $sql = "INSERT INTO parcel_table (parcel_id, parcel_name, parcel_occupant, tag) VALUES ('$parcelId', '$parcelName', '$parcelOccupant', '$tag')";

    // Create a message object
    $message = new stdClass();

    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully";
        // Set success message
        $message['status'] = "success";
        $message['text'] = "Data anda berhasil disimpan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $message['status'] = "error";
        $message['text'] = "Terjadi kesalahan saat menyimpan data.";
    }

    // Store the message object in the session
    $_SESSION['message'] = $message;

    // Close the database connection
    $conn->close();

    // header("Location: /data/add-parcel.php");
    // exit();
}
