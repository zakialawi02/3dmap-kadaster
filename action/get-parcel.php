<?php
include_once 'db_connect.php';

// jika request method get biasa
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['parcel']) && !empty($_GET['parcel'])) {
        $parcel_id = $_GET['parcel'];
        // get data parcel_table where
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
                WHERE p.parcel_id = '$parcel_id'
                GROUP BY p.id, p.parcel_id, p.parcel_name, p.parcel_occupant";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $parcel_table = $result->fetch_assoc();
        }
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
                GROUP BY p.id, p.parcel_id, p.parcel_name, p.parcel_occupant";
        $result = $conn->query($sql);
        $parcel_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $parcel_table[] = $row;
            }
        }
        $parcel_table = json_encode($parcel_table);
        header('Content-Type: application/json');
        echo $parcel_table;
    } else {
        // get data parcel_table
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
                GROUP BY p.id, p.parcel_id, p.parcel_name, p.parcel_occupant";
        $result = $conn->query($sql);
        $parcel_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $parcel_table[] = $row;
            }
        }
    }
    if (!isset($parcel_table)) {
        header("Location: /404.php");
        exit();
    }
}

// jika request ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    if (isset($_GET['objectId']) && !empty($_GET['objectId'])) {
        $objectID = $_GET['objectId'];
        // get data parcel_table where
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
                WHERE p.id = $objectID
                GROUP BY p.id, p.parcel_id, p.parcel_name, p.parcel_occupant
                ORDER BY p.parcel_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $parcel_table = $result->fetch_assoc();
        }
        $parcel_table = json_encode($parcel_table);
        header('Content-Type: application/json');
        echo $parcel_table;
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
