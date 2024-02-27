<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';

// jika request method get biasa
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['parcel']) && !empty($_GET['parcel'])) {
        // get where by object_id
        $object = $_GET['parcel'];
        $sql = "SELECT p.*, 
                JSON_ARRAYAGG(
                    JSON_OBJECT(
                        'id_keyword', u.id_keyword,
                        'word_name', u.word_name,
                        'slug', u.slug,
                        'isUrl', u.isUrl
                        )
                    ) AS tag
                FROM legal_objects_table p
                LEFT JOIN linked_uri lu ON p.id = lu.object_id
                LEFT JOIN uri_table u ON lu.id_keyword = u.id_keyword
                WHERE p.id = $object
                GROUP BY p.id, p.parcel_name";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $legal_objects_table = $result->fetch_assoc();
        }
        // debugVarDump($legal_objects_table);
    } else {
        // get all data legal_objects_table
        $sql = "SELECT p.*, 
                JSON_ARRAYAGG(
                    JSON_OBJECT(
                        'id_keyword', u.id_keyword,
                        'word_name', u.word_name,
                        'slug', u.slug,
                        'isUrl', u.isUrl
                        )
                    ) AS tag
                FROM legal_objects_table p
                LEFT JOIN linked_uri lu ON p.id = lu.object_id
                LEFT JOIN uri_table u ON lu.id_keyword = u.id_keyword
                GROUP BY p.id, p.parcel_name";
        $result = $conn->query($sql);
        $legal_objects_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $legal_objects_table[] = $row;
            }
        }
        // debugVarDump($legal_objects_table);
    }
    if (!isset($legal_objects_table)) {
        header("Location: /404.php");
        exit();
    }
}

// jika request ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    if (isset($_GET['source']) && !empty($_GET['source']) && $_GET['source'] == "map" && isset($_GET['objectId'])) {
        $objectId = $_GET['objectId'];
        $sql = "SELECT lo.parcel_id, lo.parcel_name, lp.building, 
               rm.room_id, rm.organizer_id, rm.room_name, rm.space_usage, rm.rent_fee,
               lu.object_id, rt.id AS renters_id, rt.due_started, rt.due_finished, rt.tenure_status, tt.*, tt.id as tenant_id,
               JSON_ARRAYAGG(
                   JSON_OBJECT(
                       'id_keyword', u.id_keyword,
                       'word_name', u.word_name,
                       'slug', u.slug,
                       'isUrl', u.isUrl
                   )
               ) AS tag
                FROM legal_objects_table lo
                LEFT JOIN land_parcel_table lp ON lp.parcel_id = lo.parcel_id
                LEFT JOIN linked_uri lu ON lu.object_id = lo.id
                LEFT JOIN uri_table u ON lu.id_keyword = u.id_keyword
                LEFT JOIN rooms_table rm ON rm.legal_object_id = lo.id
                LEFT JOIN renters_tenants rt ON rt.room_id = rm.room_id
                LEFT JOIN tenants_table tt ON tt.id = rt.tenant_id
                WHERE lo.id = $objectId 
                GROUP BY lo.id, lo.parcel_id, lo.parcel_name, lp.building, 
                        rm.room_id, rm.organizer_id, rm.room_name, rm.space_usage, rm.rent_fee,
                        lu.object_id,
                        rt.id, rt.due_started, rt.due_finished, rt.tenure_status,
                        tt.tenant_name, tt.name_number, tt.tenant_job
                ORDER BY LOWER(rt.id) DESC
                LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $legal_objects_table = $result->fetch_assoc();
        }
        $legal_objects_table = json_encode($legal_objects_table);
        header('Content-Type: application/json');
        echo $legal_objects_table;
    } else {
        // get without parameter
        // get all
        $sql = "SELECT lo.*, lp.building
        FROM legal_objects_table lo
        LEFT JOIN land_parcel_table lp ON lp.parcel_id = lo.parcel_id
        ORDER BY LOWER(lo.parcel_id) DESC";
        $result = $conn->query($sql);
        $legal_objects_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $legal_objects_table[] = $row;
            }
        }
        $legal_objects_table = json_encode($legal_objects_table);
        header('Content-Type: application/json');
        echo $legal_objects_table;
    }
}


mysqli_close($conn);
