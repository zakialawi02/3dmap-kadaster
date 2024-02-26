<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['user']) && !empty($_GET['user'])) {
        $userid = $_GET['user'];
        // get data users_table where userid = $userid
        $sql = "SELECT * FROM users WHERE id = '$userid'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $users_table = $result->fetch_assoc();
        }
    } else {
        // get data users_table
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        $users_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users_table[] = $row;
            }
        }
    }
}

// echo "<pre>";
// print_r($users_table);

mysqli_close($conn);

if (!isset($users_table)) {
    header("Location: /404.php");
    exit();
}
