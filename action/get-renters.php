<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';

// jika request method get biasa
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['parcel']) && !empty($_GET['parcel'])) {
        // get with param

    } else {
        // ge all data
        $sql = "SELECT rt.id as renter2room_id, rt.room_id, rt.due_started, rt.due_finished, rt.tenure_status, rm.*, t.*
        FROM renters_tenants rt
        LEFT JOIN rooms_table rm ON rt.room_id = rm.room_id
        LEFT JOIN tenants_table t ON rt.tenant_id = t.id
        ORDER BY LOWER(rt.room_id) DESC";
        $result = $conn->query($sql);
        $renters_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $renters_table[] = $row;
            }
        }
        // debugVarDump($renters_table);
    }
    if (!isset($renters_table)) {
        header("Location: /404.php");
        exit();
    }
}

// jika request ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    if (isset($_GET['source']) && !empty($_GET['source']) && $_GET['source'] == "map") {
        $sql = "SELECT rt.id as renter2room_id, rt.room_id, rt.due_started, rt.due_finished, rt.tenure_status, rm.*, t.*
        FROM renters_tenants rt
        LEFT JOIN rooms_table rm ON rt.room_id = rm.room_id
        LEFT JOIN tenants_table t ON rt.tenant_id = t.id
        ORDER BY LOWER(rt.room_id) DESC";
        $result = $conn->query($sql);
        $renters_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $renters_table[] = $row;
            }
        }
        $renters_table = json_encode($renters_table);
        header('Content-Type: application/json');
        echo $renters_table;
    }
}

// echo "<pre>";
// print_r($legal_objects_table);

mysqli_close($conn);
