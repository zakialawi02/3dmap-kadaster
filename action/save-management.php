<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // jika request ajax
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        if (isset($_GET['source']) && !empty($_GET['source']) && $_GET['source'] == "add-room") {
            $organizer_name = $_POST['organizer_name'];
            $organizer_address = $_POST['organizer_address'];
            $organizer_city = $_POST['organizer_city'];
            $organizer_head = $_POST['organizer_head'];
            $sqlInsertParcel = "INSERT INTO managements_table (organizer_name, organizer_address, organizer_city, organizer_head) VALUES ('$organizer_name', '$organizer_address', '$organizer_city', '$organizer_head')";
            try {
                $resultSql = mysqli_query($conn, $sqlInsertParcel);
                if ($resultSql) {
                    $status = ['code' => "200", 'status' => 'success', 'message' => "Data saved successfully"];
                }
            } catch (\Throwable $th) {
                $status = ['code' => "500", 'status' => 'error', 'message' => "Failed to save data"];
            }
            header('Content-Type: application/json');
            echo json_encode($status);
        }
    } else {
        $oldForm = [
            'organizer_name' => $_POST['organizer_name'],
            'organizer_address' => $_POST['organizer_address'],
            'organizer_city' => $_POST['organizer_city'],
            'organizer_head' => $_POST['organizer_head'],
            'uri_organizer' => $_POST['uri_organizer']
        ];
        $_SESSION['oldForm'] = $oldForm;
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            // update data
            $id = $_GET['id'];
            $organizer_name = $_POST['organizer_name'];
            $organizer_address = $_POST['organizer_address'];
            $organizer_city = $_POST['organizer_city'];
            $organizer_head = $_POST['organizer_head'];
            $uri_organizer = $_POST['uri_organizer'];

            $sqlUpdate = "UPDATE managements_table SET organizer_name = '$organizer_name', organizer_address = '$organizer_address', organizer_city = '$organizer_city', organizer_head = '$organizer_head', uri_organizer = '$uri_organizer' WHERE id = $id";

            if (mysqli_query($conn, $sqlUpdate)) {
                setFlashMessage('success', 'Data updated successfully');
            } else {
                setFlashMessage('error', 'Data update failed');
            }
        } else {
            // save data baru
            $organizer_name = $_POST['organizer_name'];
            $organizer_address = $_POST['organizer_address'];
            $organizer_city = $_POST['organizer_city'];
            $organizer_head = $_POST['organizer_head'];
            $uri_organizer = $_POST['uri_organizer'];

            $sqlInsert = "INSERT INTO managements_table (organizer_name, organizer_address, organizer_city, organizer_head, uri_organizer) VALUES ('$organizer_name', '$organizer_address', '$organizer_city', '$organizer_head', '$uri_organizer')";

            if (mysqli_query($conn, $sqlInsert)) {
                setFlashMessage('success', 'Data saved successfully');
            } else {
                setFlashMessage('error', 'Data save failed');
            }
        }
    }
}
// Close the database connection
$conn->close();

header("Location: /data/organizer");
exit();
