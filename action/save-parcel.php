<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // save old form data
    $oldForm = [
        'parcel_id' => $_POST['parcel_id'] ?? $_POST['parcelIdNew'] ?? "",
        'parcel_name' => $_POST['parcelName'],
        'parcel_occupant' => $_POST['parcelOccupant'],
        'tag' => implode(", ", $_POST['multiSelectTag'] ?? [])
    ];
    $_SESSION['oldForm'] = $oldForm;
    if (isset($_GET['parcel']) && !empty($_GET['parcel'])) {
        // update data lama
        $parcel_id = $_GET['parcel']; //old parcel id
        // Perform a database query
        $query = "SELECT * FROM parcel_table WHERE parcel_id = '$parcel_id'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $parcel_table = $result->fetch_assoc();
        }
        $parcelId = $parcel_table['id'];
        $parcelIdNew = $_POST['parcelIdNew'];
        $parcelName = $_POST['parcelName'];
        $parcelOccupant = !empty($_POST['parcelOccupant']) ? $_POST['parcelOccupant'] : "null";
        if ($parcel_id != $parcelIdNew) {
            // cek duplikat parcel id jika parcel_id lama diubahs
            $query = "SELECT * FROM parcel_table WHERE parcel_id = '$parcelIdNew'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                setFlashMessage('error', 'Parcel id already exists');
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
            $sqlDeleteLinkedUri = "DELETE FROM linked_uri WHERE parcel_id = '$parcel_id'";
            $resultSql = mysqli_query($conn, $sqlDeleteLinkedUri);
            foreach ($_POST['multiSelectTag'] as $tagId) {
                $sqlInsert = "INSERT INTO linked_uri (parcel_id, id_keyword) VALUES ('$parcel_id', '$tagId')";
                $resultSql = mysqli_query($conn, $sqlInsert);
            }
            // update data
            $sqlUpdateParcel = "UPDATE parcel_table SET parcel_id = '$parcelIdNew', parcel_name = '$parcelName', parcel_occupant = $parcelOccupant WHERE id = $parcelId";
            $resultSql = mysqli_query($conn, $sqlUpdateParcel);
        } else {
            $sqlDeleteLinkedUri = "DELETE FROM linked_uri WHERE parcel_id = '$parcel_id'";
            $resultSql = mysqli_query($conn, $sqlDeleteLinkedUri);
            if (!empty($_POST['multiSelectTag'])) {
                foreach ($_POST['multiSelectTag'] as $tagId) {
                    $sqlInsert = "INSERT INTO linked_uri (parcel_id, id_keyword) VALUES ('$parcel_id', '$tagId')";
                    $resultSql = mysqli_query($conn, $sqlInsert);
                }
            }
            // update data
            $sqlUpdateParcel = "UPDATE parcel_table SET parcel_id = '$parcel_id', parcel_name = '$parcelName', parcel_occupant = $parcelOccupant WHERE id = $parcelId";
            $resultSql = mysqli_query($conn, $sqlUpdateParcel);
        }
        if ($resultSql) {
            setFlashMessage('success', 'Data updated successfully');
        } else {
            setFlashMessage('error', 'Data update failed');
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // save data baru
        $parcel_id = $_POST['parcel_id'];
        $parcelName = $_POST['parcelName'];
        $parcelOccupant = !empty($_POST['parcelOccupant']) ? $_POST['parcelOccupant'] : "null";
        // cek duplikat parcel id
        $query = "SELECT * FROM parcel_table WHERE parcel_id = '$parcel_id'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            setFlashMessage('error', 'Parcel id already exists');
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        // Prepare and execute the SQL query
        $sqlInsertParcel = "INSERT INTO parcel_table (parcel_id, parcel_name, parcel_occupant) VALUES ('$parcel_id', '$parcelName', $parcelOccupant)";
        $resultSql = mysqli_query($conn, $sqlInsertParcel);
        foreach ($_POST['multiSelectTag'] as $tagId) {
            $sqlInsert = "INSERT INTO linked_uri (parcel_id, id_keyword) VALUES ('$parcel_id', '$tagId')";
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

header("Location: /data/parcel");
exit();
