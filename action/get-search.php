<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';
// jika request method get biasa
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['param']) && !empty($_GET['param']) && $_GET['param'] == "legal") {
        $sql = "SELECT p.*
                 FROM legal_objects_table p";
        $result = $conn->query($sql);
        $result_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $result_table[] = $row;
            }
        }
        // debugVarDump($result_table);
        $result_table = json_encode($result_table);
        header('Content-Type: application/json');
        echo $result_table;
    } elseif (isset($_GET['param']) && !empty($_GET['param']) && $_GET['param'] == "room") {
        $sql = "SELECT rm.*, p.*, m.id as organizer_id, m.organizer_name, m.organizer_address, m.organizer_city, m.organizer_head, lp.parcel_id, lp.building
        FROM rooms_table rm
        LEFT JOIN legal_objects_table p ON rm.legal_object_id = p.id
        LEFT JOIN managements_table m ON m.id = rm.organizer_id
        LEFT JOIN land_parcel_table lp ON p.parcel_id = lp.parcel_id
        ORDER BY LOWER(rm.room_id) ASC";
        $result = $conn->query($sql);
        $result_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $result_table[] = $row;
            }
        }
        // debugVarDump($result_table);
        $result_table = json_encode($result_table);
        header('Content-Type: application/json');
        echo $result_table;
    } elseif (isset($_GET['param']) && !empty($_GET['param']) && $_GET['param'] == "parcel") {
        $sql = "SELECT * FROM land_parcel_table";
        $result = $conn->query($sql);
        $result_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $result_table[] = $row;
            }
        }
        // debugVarDump($result_table);
        $result_table = json_encode($result_table);
        header('Content-Type: application/json');
        echo $result_table;
    }
}



mysqli_close($conn);
