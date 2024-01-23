<?php
// Start or resume the session
session_start();
// Include the database connection file
include 'db_connect.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['parcel']) && !empty($_GET['parcel'])) {
        $parcel_id = $_GET['parcel'];
        // Perform a database query
        $query = "SELECT * FROM parcel_table WHERE parcel_id = '$parcel_id'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $parcel_table = $result->fetch_assoc();
        }
        $parcelId = $parcel_table['id'];
        $parcelName = $_POST['parcelName'];
        $parcelOccupant = $_POST['parcelOccupant'];

        // Prepare and execute the SQL query
        $sqlDeleteLinkedUri = "DELETE FROM linked_uri WHERE parcel_id = '$parcel_id'";
        $resultSql = mysqli_query($conn, $sqlDeleteLinkedUri);
        foreach ($_POST['multiSelectTag'] as $tagId) {
            $sqlInsert = "INSERT INTO linked_uri (parcel_id, id_keyword) VALUES ('$parcel_id', '$tagId')";
            $resultSql = mysqli_query($conn, $sqlInsert);
        }
        $sqlUpdateParcel = "UPDATE parcel_table SET parcel_id = '$parcel_id', parcel_name = '$parcelName', parcel_occupant = '$parcelOccupant' WHERE id = $parcelId";
        $resultSql = mysqli_query($conn, $sqlUpdateParcel);
        if ($resultSql) {
            echo "Data saved successfully";
            // Set success message
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Get the form data
        $parcel_id = $_POST['parcel_id'];
        $parcelName = $_POST['parcelName'];
        $parcelOccupant = $_POST['parcelOccupant'];

        // Prepare and execute the SQL query
        $sqlInsertParcel = "INSERT INTO parcel_table (parcel_id, parcel_name, parcel_occupant) VALUES ('$parcel_id', '$parcelName', '$parcelOccupant')";
        $resultSql = mysqli_query($conn, $sqlInsertParcel);
        foreach ($_POST['multiSelectTag'] as $tagId) {
            $sqlInsert = "INSERT INTO linked_uri (parcel_id, id_keyword) VALUES ('$parcel_id', '$tagId')";
            $resultSql = mysqli_query($conn, $sqlInsert);
        }
        if ($resultSql) {
            echo "Data saved successfully";
            // Set success message
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();

header("Location: /data/parcel");
exit();
