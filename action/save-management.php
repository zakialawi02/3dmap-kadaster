<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // jika request ajax
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        if (isset($_GET['source']) && !empty($_GET['source']) && $_GET['source'] == "add-room") {
            $organizer_name = $_POST['organizer_name'];
            $organizer_address = $_POST['organizer_address'];
            $organizer_city = $_POST['organizer_city'];
            $organizer_head = $_POST['organizer_head'];
            $sqlInsertParcel = "INSERT INTO managements_table (organizer_name, organizer_address, organizer_city, organizer_head) VALUES ('$organizer_name', '$organizer_address', '$organizer_city', '$organizer_head')";
            try {
                $resultSql = mysqli_query($conn, $sqlInsertParcel);
                if ($resultSql) {
                    $status = ['code' => "200", 'status' => 'success', 'message' => "Data saved successfully"];
                }
            } catch (\Throwable $th) {
                $status = ['code' => "500", 'status' => 'error', 'message' => "Failed to save data"];
            }
            header('Content-Type: application/json');
            echo json_encode($status);
        }
    }
}
