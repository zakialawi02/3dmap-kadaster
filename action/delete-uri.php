<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    print_r($_POST);

    // Get the parcel_id from the POST request
    $UriId = $_POST['uri_id'];
    echo $UriId;
    // SQL query to delete the parcel
    $sql = "DELETE FROM uri_table WHERE id_keyword = $UriId";
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

header("Location: /data/uri");
exit();
