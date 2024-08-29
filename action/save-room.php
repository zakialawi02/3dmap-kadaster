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
            'uri_room' => $_POST['uri_room'],
            'organizer' => $_POST['organizer'],
            'rent_fee' => $_POST['rent_fee'],
            'space_usage' => $_POST['space_usage'],
            'is_public' => $_POST['is_public'],
        ];
        $_SESSION['oldForm'] = $oldForm;
        if (isset($_GET['room']) && !empty($_GET['room']) && isset($_GET['legal']) && !empty($_GET['legal'])) {
            // update data lama
            $roomId = $_GET['room'];
            $room_id = $_GET['room'];
            $room_idNEW = $_POST['room_id'];
            $legal_object_id = $_GET['legal'];
            $legal_object_idNEW = $_POST['legal_object_id'];
            $is_public = $_POST['is_public'] === 'yes' ? 1 : 0;
            $room_name = $_POST['room_name'];
            $uri_room = $_POST['uri_room'];
            $space_usage = $_POST['space_usage'];
            $organizer = $_POST['organizer'];
            $rent_fee = ($_POST['is_public'] === 'yes') ? null : $_POST['rent_fee'];
            if ($room_id != $room_idNEW) {
                // jika room_id beda/ganti
                // cek duplikat room id NEW
                $query = "SELECT * FROM rooms_table WHERE room_id = '$room_idNEW'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    setFlashMessage('error', 'Room Id already exists');
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit();
                }
                $room_id = $room_idNEW;
            }
            if ($legal_object_id != $legal_object_idNEW) {
                // jika legal_object_id beda/ganti
                // cek duplikat legal_object_id 
                $query = "SELECT * FROM rooms_table WHERE legal_object_id = '$legal_object_idNEW'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    setFlashMessage('error', 'This legal object or parcel is already assigned to a room.');
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit();
                }
                $legal_object_id = $legal_object_idNEW;
            }
            $sqlUpdateRoom = "UPDATE rooms_table SET room_id = '$room_id', legal_object_id = $legal_object_id, organizer_id = $organizer, room_name = '$room_name', uri_room = '$uri_room', space_usage = '$space_usage', rent_fee = '$rent_fee', is_public = '$is_public' WHERE room_id = '$roomId'";
            $resultSql = mysqli_query($conn, $sqlUpdateRoom);
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
            $is_public = $_POST['is_public'] === 'yes' ? 1 : 0;
            $room_name = $_POST['room_name'];
            $uri_room = $_POST['uri_room'];
            $space_usage = $_POST['space_usage'];
            $organizer = $_POST['organizer'];
            $rent_fee = ($_POST['is_public'] === 'yes') ? null : $_POST['rent_fee'];
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
            $sqlInsertRoom = "INSERT INTO rooms_table (room_id, legal_object_id, room_name, organizer_id, space_usage, rent_fee, is_public) VALUES ('$room_id', '$legal_object_id', '$room_name', $uri_room', '$organizer', '$space_usage', '$rent_fee', '$is_public')";
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
