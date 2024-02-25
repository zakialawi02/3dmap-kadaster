<?php
include 'db_connect.php';

// jika request method get biasa
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['']) && !empty($_GET[''])) {
        // 

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
    if (isset($_GET['']) && !empty($_GET[''])) {
        # code...
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


mysqli_close($conn);
