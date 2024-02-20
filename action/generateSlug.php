<?php
// Include the database connection file
include_once 'db_connect.php';

use Ausi\SlugGenerator\SlugGenerator;

$generator = new SlugGenerator;

// jika request ajax
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    $uriname = $_GET['uriname'];
    $resultSlug = $generator->generate($uriname);

    // check resultSlug is exist in database
    $sql = "SELECT * FROM uri_table WHERE slug = '$resultSlug'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $resultSlug = $resultSlug . "-" . rand(1, 100);
    }

    header('Content-Type: application/json');
    echo json_encode($resultSlug);
}
