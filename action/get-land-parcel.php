<?php
include 'db_connect.php';

// jika request method get biasa
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['']) && !empty($_GET[''])) {
        // 

    } else {
        // get all data land_parcel
        $sql = "SELECT * FROM land_parcel_table";
        $result = $conn->query($sql);
        $landparcel_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $landparcel_table[] = $row;
            }
        }
        // debugVarDump($landparcel_table);
    }
    if (!isset($landparcel_table)) {
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
        $sql = "SELECT * FROM land_parcel_table";
        $result = $conn->query($sql);
        $landparcel_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $landparcel_table[] = $row;
            }
        }
        $landparcel_table = json_encode($landparcel_table);
        header('Content-Type: application/json');
        echo $landparcel_table;
    }
}


mysqli_close($conn);
