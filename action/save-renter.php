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
            'tenant_name' => $_POST['tenant_name'],
            'name_number' => $_POST['name_number'],
            'tenant_job' => $_POST['tenant_job'],
            'tenant_religion' => $_POST['tenant_religion'],
            'tenant_address' => $_POST['tenant_address'],
            'tenant_village' => $_POST['tenant_village'],
            'tenant_district' => $_POST['tenant_district'],
            'tenant_city' => $_POST['tenant_city'],
            'tenant_province' => $_POST['tenant_province'],
            'tenant_rt' => $_POST['tenant_rt'],
            'tenant_rw' => $_POST['tenant_rw'],
            'due_started' => $_POST['due_started'],
            'due_finished' => $_POST['due_finished'],
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
            $tenant_name = $_POST['tenant_name'];
            $name_number = $_POST['name_number'];
            $tenant_job = $_POST['tenant_job'];
            $tenant_religion = $_POST['tenant_religion'];
            $tenant_address = $_POST['tenant_address'];
            $tenant_village = $_POST['tenant_village'];
            $tenant_district = $_POST['tenant_district'];
            $tenant_city = $_POST['tenant_city'];
            $tenant_province = $_POST['tenant_province'];
            $tenant_rt = $_POST['tenant_rt'];
            $tenant_rw = $_POST['tenant_rw'];
            $rtrw = [
                'tenant_rt' => $tenant_rt,
                'tenant_rw' => $tenant_rw
            ];
            $rtrw = json_encode($rtrw);
            $due_started = $_POST['due_started'];
            $due_finished = $_POST['due_finished'];
            // cek Room required
            if (empty($room_id)) {
                setFlashMessage('error', 'Room ID is required. Please provide a valid Room ID.');
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
            // cek duplikat nik
            $query = "SELECT * FROM tenants_table WHERE name_number = '$name_number'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                setFlashMessage('error', 'This NIK is already associated with another tenant. Please use a different NIK.');
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
            $sqlInsertTenant = "INSERT INTO tenants_table (tenant_name, name_number, tenant_job, tenant_religion, tenant_address, tenant_village, tenant_district, tenant_city, tenant_province, tenant_rt_rw) VALUES ('$tenant_name', '$name_number', '$tenant_job', '$tenant_religion', '$tenant_address', '$tenant_village', '$tenant_district', '$tenant_city', '$tenant_province', '$rtrw')";
            $resultSql = mysqli_query($conn, $sqlInsertTenant);
            if ($resultSql) {
                $tenantInsertedId = mysqli_insert_id($conn);
                $tenure_status = "lease";
            } else {
                setFlashMessage('error', 'Failed to save data');
                header("Location: /data/renters");
                exit();
            }
            // cek duplikat penyewa room id 
            $query = "SELECT * FROM renters_tenants WHERE room_id = '$room_id'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $tenure_status = "in queue";
            }
            $sqlInsertRenter = "INSERT INTO renters_tenants (tenant_id, room_id, due_started, due_finished, tenure_status) VALUES ('$tenantInsertedId', '$room_id', " . (!empty($due_started) ? "'$due_started'" : "NULL") . " , " . (!empty($due_finished) ? "'$due_finished'" : "NULL") . ", '$tenure_status')";
            $resultSql = mysqli_query($conn, $sqlInsertRenter);
            if ($resultSql) {
                setFlashMessage('success', 'Data updated successfully');
            } else {
                setFlashMessage('error', 'Data update failed');
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
// Close the database connection
$conn->close();

header("Location: /data/renters");
exit();
