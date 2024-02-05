<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // save old form data
    $oldForm = [
        'resident_code' => $_POST['resident_code'] ?? $_POST['resident_codeNew'] ?? "",
        'resident_name' => $_POST['resident_name'],
        'phone_number' => $_POST['phone_number'],
        'started' => $_POST['started'],
        'finished' => $_POST['finished'],
    ];
    $_SESSION['oldForm'] = $oldForm;
    if (isset($_GET['resident']) && !empty($_GET['resident'])) {
        // update data lama
        $resident_id = $_GET['resident']; //old resident id
        $resident_code = $_POST['resident_code'];
        $resident_name = $_POST['resident_name'];
        $phone_number = $_POST['phone_number'];
        $started = $_POST['started'];
        $finished = $_POST['finished'];
        // update data
        $sqlUpdateResident = "UPDATE residents_table SET resident_code = '$resident_code', resident_name = '$resident_name', phone_number = '$phone_number', started = '$started', finished = '$finished' WHERE id_resident = $resident_id";
        $resultSql = mysqli_query($conn, $sqlUpdateResident);
        if ($resultSql) {
            setFlashMessage('success', 'Data updated successfully');
        } else {
            setFlashMessage('error', 'Data update failed');
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // save data baru
        $resident_code = $_POST['resident_code'];
        $resident_name = $_POST['resident_name'];
        $phone_number = $_POST['phone_number'];
        $started = $_POST['started'];
        $finished = $_POST['finished'];
        // Prepare and execute the SQL query
        $sqlInsertResident = "INSERT INTO residents_table (resident_code, resident_name, phone_number, started, finished) VALUES ('$resident_code', '$resident_name', '$phone_number', '$started', '$finished')";
        $resultSql = mysqli_query($conn, $sqlInsertResident);
        if ($resultSql) {
            setFlashMessage('success', 'Data saved successfully');
        } else {
            setFlashMessage('error', 'Failed to save data');
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();

header("Location: /data/residents");
exit();
