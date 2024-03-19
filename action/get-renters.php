<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';

// jika request method get biasa
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['Tenant']) && !empty($_GET['Tenant']) && isset($_GET['Room']) && !empty($_GET['Room'])) {
        // get with param
        $tenantID = $_GET['Tenant'];
        $roomID = $_GET['Room'];
        $sql = "SELECT rt.id as renter2room_id, rt.tenant_id, rt.room_id, rt.due_started, rt.due_finished, rt.tenure_status, rt.agreement_number, rt.permit_flats, rm.*, t.*
        FROM renters_tenants rt
        LEFT JOIN rooms_table rm ON rt.room_id = rm.room_id
        LEFT JOIN tenants_table t ON rt.tenant_id = t.id
        WHERE rt.tenant_id = $tenantID";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $renters_table = $result->fetch_assoc();
        }
        // debugVarDump($renters_table);
    } else {
        // ge all data
        $sql = "SELECT rt.id as renter2room_id, rt.tenant_id, rt.room_id, rt.due_started, rt.due_finished, rt.tenure_status, rt.agreement_number, rt.permit_flats, rm.*, t.*, lo.id as legal_id, lp.id as lp_id, lp.building
        FROM renters_tenants rt
        LEFT JOIN rooms_table rm ON rt.room_id = rm.room_id
        LEFT JOIN tenants_table t ON rt.tenant_id = t.id
        LEFT JOIN legal_objects_table lo ON rm.legal_object_id = lo.id
        LEFT JOIN land_parcel_table lp ON lo.parcel_id = lp.parcel_id
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
        // 

    }
}

// echo "<pre>";
// print_r($legal_objects_table);

mysqli_close($conn);
