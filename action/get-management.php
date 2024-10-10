<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';

// jika request method get biasa
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        // get by id
        $sql = "SELECT * FROM managements_table WHERE id = " . $_GET['id'] . " LIMIT 1";
        $result = $conn->query($sql);
        $organizer_table = [];
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $organizer_table = $result->fetch_assoc();
        }
    } else {
        // get all data land_parcel
        $sql = "SELECT * FROM managements_table";
        $result = $conn->query($sql);
        $organizer_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $organizer_table[] = $row;
            }
        }
        // debugVarDump($organizer_table);
    }
    if (!isset($organizer_table)) {
        header("Location: /404.php");
        exit();
    }
}

// jika request ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    if (isset($_GET['source']) && !empty($_GET['source']) && $_GET['source'] == "map" && isset($_GET['organizer'])) {
        $organizer_id = $_GET['organizer'];
        $sql = "SELECT * FROM managements_table
                WHERE id = $organizer_id
                LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $organizer_table = $result->fetch_assoc();
        }
        $organizer_table = json_encode($organizer_table);
        header('Content-Type: application/json');
        echo $organizer_table;
    } else {
        // get without parameter
        // get all
        $sql = "SELECT * FROM managements_table";
        $result = $conn->query($sql);
        $organizer_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $organizer_table[] = $row;
            }
        }
        $organizer_table = json_encode($organizer_table);
        header('Content-Type: application/json');
        echo $organizer_table;
    }
}

// print_r($organizer_table);

mysqli_close($conn);
