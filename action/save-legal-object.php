<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // save old form data
    $oldForm = [
        'object_id' => $_POST['object_id'] ?? "",
        'parcel_id' => $_POST['parcel_id'],
        'parcel_name' => $_POST['parcel_name'],
        'tag' => implode(", ", $_POST['multiSelectTag'] ?? [])
    ];
    $_SESSION['oldForm'] = $oldForm;
    if (isset($_GET['parcel']) && !empty($_GET['parcel'])) {
        // update data lama
        $object_id = $_GET['parcel'];
        $parcel_id = $_POST['parcel_id'];
        $parcelName = $_POST['parcel_name'];

        $sqlDeleteLinkedUri = "DELETE FROM linked_uri WHERE object_id = '$object_id'";
        $resultSql = mysqli_query($conn, $sqlDeleteLinkedUri);
        if (!empty($_POST['multiSelectTag'])) {
            foreach ($_POST['multiSelectTag'] as $tagId) {
                $sqlInsert = "INSERT INTO linked_uri (object_id, id_keyword) VALUES ('$object_id', '$tagId')";
                $resultSql = mysqli_query($conn, $sqlInsert);
            }
        }
        // update data
        $sqlUpdateLegalObject = "UPDATE legal_objects_table SET id = '$object_id', parcel_id = '$parcel_id', parcel_name = '$parcelName' WHERE id = $object_id";
        $resultSql = mysqli_query($conn, $sqlUpdateLegalObject);
        if ($resultSql) {
            setFlashMessage('success', 'Data updated successfully');
        } else {
            setFlashMessage('error', 'Data update failed');
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // save data baru
        $object_id = $_POST['object_id'];
        $parcel_id = $_POST['parcel_id'];
        $parcelName = $_POST['parcel_name'];
        // cek duplikat object id
        $query = "SELECT * FROM legal_objects_table WHERE id = '$object_id'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            setFlashMessage('error', 'Parcel id already exists');
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        // validasi empty
        if (empty($parcel_id)) {
            setFlashMessage('error', 'Parcel ID is required');
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        // Prepare and execute the SQL query
        $sqlInsertLegalObject = "INSERT INTO legal_objects_table (id, parcel_id, parcel_name) VALUES ('$object_id', '$parcel_id', '$parcelName')";
        $resultSql = mysqli_query($conn, $sqlInsertLegalObject);
        foreach ($_POST['multiSelectTag'] as $tagId) {
            $sqlInsert = "INSERT INTO linked_uri (object_id, id_keyword) VALUES ('$object_id', '$tagId')";
            $resultSql = mysqli_query($conn, $sqlInsert);
        }
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

header("Location: /data/legal");
exit();
