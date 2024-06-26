<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user from the POST request
    $id = $_POST['id'];

    // SQL query to get aggrement data
    $query = "SELECT * FROM renters_tenants where tenant_id = '$id'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $agreement = $row['agreement_number'];
        $agreement = str_replace("/", ".", $agreement);
        $permit = $row['permit_flats'];

        // Hapus file
        $fileName = $agreement . '.pdf';
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/PDF/agreement/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $fileName = $permit;
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/PDF/certificate/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    // SQL query to delete the parcel
    $sql = "DELETE FROM tenants_table WHERE id = '$id'";
    $conn->query($sql);
    if (mysqli_affected_rows($conn) > 0) {
        setFlashMessage('success', 'Data deleted successfully');
    } else {
        setFlashMessage('error', 'Data delete failed');
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

header("Location: /data/renters/");
exit();
