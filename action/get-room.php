<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';

// jika request method get biasa
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['room']) && !empty($_GET['room']) && isset($_GET['legal']) && !empty($_GET['legal'])) {
        // get with param
        $RoomId = $_GET['room'];
        $LegalId = $_GET['legal'];
        $sql = "SELECT rm.*, p.*, m.id as organizer_id, m.organizer_name, m.organizer_address, m.organizer_city, m.organizer_head, lp.parcel_id, lp.building
        FROM rooms_table rm
        LEFT JOIN legal_objects_table p ON rm.legal_object_id = p.id
        LEFT JOIN managements_table m ON m.id = rm.organizer_id
        LEFT JOIN land_parcel_table lp ON p.parcel_id = lp.parcel_id
        WHERE rm.room_id = '$RoomId' AND rm.legal_object_id = $LegalId
        LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $rooms_table = $result->fetch_assoc();
        }
        // debugVarDump($rooms_table);
    } elseif (isset($_GET['get']) && !empty($_GET['get'])) {
        // 

    } else {
        // ge all data
        $sql = "SELECT rm.*, p.*, m.id as organizer_id, m.organizer_name, m.organizer_address, m.organizer_city, m.organizer_head, lp.parcel_id, lp.building
        FROM rooms_table rm
        LEFT JOIN legal_objects_table p ON rm.legal_object_id = p.id
        LEFT JOIN managements_table m ON m.id = rm.organizer_id
        LEFT JOIN land_parcel_table lp ON p.parcel_id = lp.parcel_id
        ORDER BY LOWER(rm.room_id) ASC";
        $result = $conn->query($sql);
        $rooms_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rooms_table[] = $row;
            }
        }
        // debugVarDump($rooms_table);
    }
    if (!isset($rooms_table)) {
        header("Location: /404.php");
        exit();
    }
}

// jika request ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    if (isset($_GET['']) && !empty($_GET[''])) {
        # code...
    } else {
        // get without parameter
        // get all
        $sql = "SELECT rm.*, p.*, m.id as organizer_id, m.organizer_name, m.organizer_address, m.organizer_city, m.organizer_head, lp.parcel_id, lp.building
        FROM rooms_table rm
        LEFT JOIN legal_objects_table p ON rm.legal_object_id = p.id
        LEFT JOIN managements_table m ON m.id = rm.organizer_id
        LEFT JOIN land_parcel_table lp ON p.parcel_id = lp.parcel_id
        ORDER BY LOWER(rm.legal_object_id) DESC";
        $result = $conn->query($sql);
        $rooms_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rooms_table[] = $row;
            }
        }
        $rooms_table = json_encode($rooms_table);
        header('Content-Type: application/json');
        echo $rooms_table;
    }
}

// echo "<pre>";
// print_r($legal_objects_table);

mysqli_close($conn);
