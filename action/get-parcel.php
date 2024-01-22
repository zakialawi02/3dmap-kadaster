<?php
// Include the database connection file
include 'db_connect.php';

// jika request method get biasa
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['parcel']) && !empty($_GET['parcel'])) {
        $parcel_id = $_GET['parcel'];
        // get data parcel_table where
        $sql = "SELECT * FROM parcel_table WHERE parcel_id = '$parcel_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $parcel_table = $result->fetch_assoc();
        }
    } else {
        // get data parcel_table
        $sql = "SELECT * FROM parcel_table";
        $result = $conn->query($sql);
        $parcel_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $parcel_table[] = $row;
            }
        }
    }
}

// jika request ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    $parcel_id = $_GET['parcel'];
    // get data parcel_table where
    $sql = "SELECT * FROM parcel_table WHERE parcel_id = '$parcel_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $parcel_table = $result->fetch_assoc();
    }
    $parcel_table = json_encode($parcel_table);
    header('Content-Type: application/json');
    echo $parcel_table;
}

// echo "<pre>";
// print_r($parcel_table);


mysqli_close($conn);
