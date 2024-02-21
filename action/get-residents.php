<?php
include 'db_connect.php';

// jika request method get biasa
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['residents']) && !empty($_GET['residents'])) {
        $parcel_id = $_GET['residents'];
        // get data residents_table where
        $sql = "SELECT p.*,
                JSON_ARRAYAGG(
                JSON_OBJECT(
                    'id_keyword', u.id_keyword,
                    'word_name', u.word_name,
                    'slug', u.slug,
                    'isUrl', u.isUrl
                    )
                ) AS tag
                FROM residents_table p
                LEFT JOIN linked_uri lu ON p.parcel_id = lu.parcel_id
                LEFT JOIN uri_table u ON lu.id_keyword = u.id_keyword
                WHERE p.parcel_id = '$parcel_id'
                GROUP BY p.id, p.parcel_id, p.parcel_name, p.parcel_occupant";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $residents_table = $result->fetch_assoc();
        }
    } else {
        // get data residents_table
        $sql = "SELECT * FROM residents_table";
        $result = $conn->query($sql);
        $residents_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $residents_table[] = $row;
            }
        }
    }
    if (!isset($residents_table)) {
        header("Location: /404.php");
        exit();
    }
}

// jika request ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    $id_resident = $_GET['idr'];
    $parcel_id = $_GET['parcel_id'] ?? null;
    // get data residents_table where
    $sql = "SELECT * FROM residents_table WHERE id_resident = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_resident); // "i" menunjukkan tipe data integer, sesuaikan sesuai kebutuhan
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $residents_table = $result->fetch_assoc();
    }
    $residents_table['parcel_id'] = $parcel_id;
    $residents_table = json_encode($residents_table);
    header('Content-Type: application/json');
    echo $residents_table;
}

// echo "<pre>";
// print_r($residents_table);

mysqli_close($conn);
