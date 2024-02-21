<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
// Include the database connection file
include 'db_connect.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // save old form data
    $address = [
        'district' => $_POST['district_address'],
        'city' => $_POST['city_address'],
        'province' => $_POST['province_address']
    ];
    $oldForm = [
        'resident_type' => $_POST['resident_type'],
        'resident_entity' => $_POST['resident_entity'],
        'resident_name' => $_POST['resident_name'],
        'resident_code' => $_POST['resident_code'] ?? $_POST['resident_codeNew'] ?? "",
        'job' => $_POST['job'],
        'job_title' => $_POST['job_title'],
        'phone_number' => $_POST['phone_number'],
        'religion' => $_POST['religion'],
        'address' => $address,
        'started' => $_POST['started'],
        'finished' => $_POST['finished'],
    ];
    $_SESSION['oldForm'] = $oldForm;

    if (isset($_GET['resident']) && !empty($_GET['resident'])) {
        // update data lama
        $resident_id = $_GET['resident']; //old resident id

    } else {
        // save data baru
        $resident_type = $_POST['resident_type'];
        $resident_entity = (($resident_type == "Entity" ? $_POST['resident_entity'] : ""));
        $resident_code = $_POST['resident_code'];
        $resident_name = $_POST['resident_name'];
        $job_title = (($resident_type == "Entity" ? $_POST['job_title'] : ""));
        $job = $_POST['job'];
        $phone_number = $_POST['phone_number'];
        $religion = $_POST['religion'];
        $address = [
            'district' => $_POST['district_address'],
            'city' => $_POST['city_address'],
            'province' => $_POST['province_address']
        ];
        $address = json_encode($address);
        $started = $_POST['started'];
        $finished = $_POST['finished'];
        // Prepare and execute the SQL query
        $sqlInsertResident = "INSERT INTO residents_table (resident_type, resident_entity, resident_code, resident_name, phone_number, job_title, resident_job, resident_religion, resident_address, started, finished) VALUES ('$resident_type', '$resident_entity', '$resident_code', '$resident_name', '$phone_number', '$job_title', '$job', '$religion', '$address', " . (!empty($started) ? "'$started'" : "NULL") . " , " . (!empty($finished) ? "'$finished'" : "NULL") . ")";
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
