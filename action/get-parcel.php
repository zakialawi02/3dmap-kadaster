<?php
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
                FROM parcel_table p
                LEFT JOIN linked_uri lu ON p.id = lu.object_id
                LEFT JOIN uri_table u ON lu.id_keyword = u.id_keyword
                WHERE p.id = $object
                GROUP BY p.id, p.parcel_name";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $parcel_table = $result->fetch_assoc();
        }
        // debugVarDump($parcel_table);
    } else {
        // get all data parcel_table
        $sql = "SELECT p.*, 
                JSON_ARRAYAGG(
                    JSON_OBJECT(
                        'id_keyword', u.id_keyword,
                        'word_name', u.word_name,
                        'slug', u.slug,
                        'isUrl', u.isUrl
                        )
                    ) AS tag
                FROM parcel_table p
                LEFT JOIN linked_uri lu ON p.id = lu.object_id
                LEFT JOIN uri_table u ON lu.id_keyword = u.id_keyword
                GROUP BY p.id, p.parcel_name";
        $result = $conn->query($sql);
        $parcel_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $parcel_table[] = $row;
            }
        }
        // debugVarDump($parcel_table);
    }
    if (!isset($parcel_table)) {
        header("Location: /404.php");
        exit();
    }
}

// jika request ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    // 

}


mysqli_close($conn);
