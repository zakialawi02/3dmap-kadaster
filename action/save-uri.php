<?php
// Start or resume the session
session_start();
// Include the database connection file
include 'db_connect.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    print_r($_POST);

    // Get the form data
    $URIname = $_POST['URIname'];
    $isUrl = $_POST['isUrl'];
    $URIcontent = $_POST['URIcontent'];

    echo $URIname . "<br>";
    echo $isUrl . "<br>";
    echo $URIcontent . "<br>";

    // Prepare and execute the SQL query
    $sql = "INSERT INTO uri_table (word_name, uri_content, isUrl) VALUES ('$URIname', '$URIcontent', '$isUrl')";

    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();

    // header("Location: /data/uri.php");
    // exit();
}
