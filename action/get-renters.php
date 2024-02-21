<?php
include 'db_connect.php';

// jika request method get biasa
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['parcel']) && !empty($_GET['parcel'])) {
        // get with param

    } elseif (isset($_GET['get']) && !empty($_GET['get'])) {
        // 

    } else {
        // ge all data
        $sql = "SELECT rt.*, rm.*, t.*
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
    if (isset($_GET['roomId']) && !empty($_GET['roomId'])) {


        $renters_table = json_encode($renters_table);
        header('Content-Type: application/json');
        echo $renters_table;
    } elseif (isset($_GET['get']) && !empty($_GET['get'])) {
        $sql = "SELECT p.*, r.*,
                JSON_ARRAYAGG(
                JSON_OBJECT(
                    'id_keyword', u.id_keyword,
                    'word_name', u.word_name,
                    'slug', u.slug,
                    'isUrl', u.isUrl
                    )
                ) AS tag
                FROM parcel_table p
                LEFT JOIN linked_uri lu ON p.parcel_id = lu.parcel_id
                LEFT JOIN residents_table r ON p.parcel_occupant = r.id_resident
                LEFT JOIN uri_table u ON lu.id_keyword = u.id_keyword
                GROUP BY p.id, p.parcel_id, p.parcel_name, p.parcel_occupant
                ORDER BY p.parcel_id";
        $result = $conn->query($sql);
        $parcel_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $parcel_table[] = $row;
            }
        }
        echo json_encode($parcel_table);
    }
}

// echo "<pre>";
// print_r($parcel_table);

mysqli_close($conn);
