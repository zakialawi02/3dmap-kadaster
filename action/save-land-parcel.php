<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // jika request ajax
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        if (isset($_GET['source']) && !empty($_GET['source']) && $_GET['source'] == "add-legal") {
            $parcel_id = $_POST['parcel_id'];
            $building = $_POST['building'];
            $sqlInsertParcel = "INSERT INTO land_parcel_table (parcel_id, building) VALUES ('$parcel_id', '$building')";
            try {
                $resultSql = mysqli_query($conn, $sqlInsertParcel);
                if ($resultSql) {
                    $status = ['code' => "200", 'status' => 'success', 'message' => "Data saved successfully"];
                }
            } catch (\Throwable $th) {
                $status = ['code' => "500", 'status' => 'error', 'message' => "Failed to save data, Parcel ID must Unique"];
            }
            header('Content-Type: application/json');
            echo json_encode($status);
        }
    }
}
