<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // jika request ajax
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        if (isset($_GET['source']) && !empty($_GET['source'])) {
            // 

        }
    } else {
        // save old form data
        $oldForm = [
            'room_id' => $_POST['room_id'],
            'legal_object_id' => $_POST['legal_object_id'],
            'room_name' => $_POST['room_name'],
            'organizer' => $_POST['organizer'],
            'rent_fee' => $_POST['rent_fee'],
        ];
        $_SESSION['oldForm'] = $oldForm;
        if (isset($_GET['parcel']) && !empty($_GET['parcel'])) {
            // update data lama

            if ($resultSql) {
                setFlashMessage('success', 'Data updated successfully');
            } else {
                setFlashMessage('error', 'Data update failed');
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            // save data baru
            $room_id = $_POST['room_id'];
            $legal_object_id = $_POST['legal_object_id'];
            $room_name = $_POST['room_name'];
            $space_usage = $_POST['space_usage'];
            $organizer = $_POST['organizer'];
            $rent_fee = $_POST['rent_fee'];
            // cek duplikat room id 
            $query = "SELECT * FROM rooms_table WHERE room_id = '$room_id'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                setFlashMessage('error', 'Room Id already exists');
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
            // cek duplikat legal_object_id 
            $query = "SELECT * FROM rooms_table WHERE legal_object_id = '$legal_object_id'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                setFlashMessage('error', 'This legal object or parcel is already assigned to a room.');
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
            $sqlInsertRoom = "INSERT INTO rooms_table (room_id, legal_object_id, room_name, organizer_id, space_usage, rent_fee) VALUES ('$room_id', '$legal_object_id', '$room_name', '$organizer', '$space_usage', '$rent_fee')";
            $resultSql = mysqli_query($conn, $sqlInsertRoom);
            if ($resultSql) {
                setFlashMessage('success', 'Data saved successfully');
            } else {
                setFlashMessage('error', 'Failed to save data');
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
// Close the database connection
$conn->close();

header("Location: /data/room");
exit();
