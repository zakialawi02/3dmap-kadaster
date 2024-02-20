<?php
// Include the database connection file
include_once 'db_connect.php';

use HTMLPurifier\HTMLPurifier;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['uri']) && !empty($_GET['uri'])) {
        $slug = $_GET['uri'];
        // get data uri_table where slug = $slug
        $sql = "SELECT * FROM uri_table WHERE slug = '$slug'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $uri_table = $result->fetch_assoc();
        }
    } else {
        // get data uri_table
        $sql = "SELECT * FROM uri_table ORDER BY word_name";
        $result = $conn->query($sql);
        $uri_table = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $uri_table[] = $row;
            }
        }
    }
}

// echo "<pre>";
// print_r($uri_table);

mysqli_close($conn);

if (!isset($uri_table)) {
    header("Location: /404.php");
    exit();
}
