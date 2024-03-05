<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';

use Mpdf\Mpdf;

// Include the database connection file
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tenantID = $_POST['tenant_id'];
    $roomID = $_POST['room_id'];
    $from = $_POST['place'];

    $tenantNumber = str_pad($tenantID, 4, '0', STR_PAD_LEFT);
    if ($from == "3") {
        $placeNumber = "3573403";
    } else {
        $placeNumber = "XXXXXXX";
    }
    $date = date("Y");
    $agrementNumber = $tenantNumber . "/1679/" . $placeNumber . "/" . $date;
    $fileName = str_replace('/', '.', $agrementNumber);

    $sqlUpdateRenter = "UPDATE renters_tenants SET agreement_number = '$agrementNumber' WHERE tenant_id = $tenantID";
    $resultSql = mysqli_query($conn, $sqlUpdateRenter);
    if ($resultSql) {
        $agrementNumber = json_encode($agrementNumber);
        header('Content-Type: application/json');
        echo $agrementNumber;
    }

    $sql = "SELECT rt.id as renter2room_id, rt.tenant_id, rt.room_id, rt.due_started, rt.due_finished, rt.tenure_status, rt.agreement_number, rt.permit_flats, t.*, rm.*, m.id as organizer_id, m.organizer_name, m.organizer_city, m.organizer_head
                FROM renters_tenants rt
                LEFT JOIN rooms_table rm ON rt.room_id = rm.room_id
                LEFT JOIN tenants_table t ON rt.tenant_id = t.id
                LEFT JOIN managements_table m ON rm.organizer_id = m.id
                WHERE rt.tenant_id = $tenantID && rt.room_id = $roomID
                LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $renter_table = $result->fetch_assoc();
        $rtrw = json_decode($renter_table['tenant_rt_rw'], true);
    }

    // Generate PDF
    $html = $_SERVER['DOCUMENT_ROOT'] . "/generateAgreementPDF.html";
    $htmlContent = file_get_contents($html);
    $html = $_SERVER['DOCUMENT_ROOT'] . "/generateAgreementPDF2.html";
    $htmlContent2 = file_get_contents($html);

    // Ganti placeholder dengan data dari database
    $htmlContent = str_replace('{place}', "RUSUNAWA BURING 2", $htmlContent);
    $htmlContent = str_replace('{room_id}', $roomID, $htmlContent);
    $htmlContent = str_replace('{agreement_number}', json_decode($agrementNumber), $htmlContent);
    $htmlContent = str_replace('{date_now}', date("l, j F Y"), $htmlContent);
    $htmlContent = str_replace('{agrement_place}', "Kota Malang", $htmlContent);
    $htmlContent = str_replace('{nik}', $renter_table['name_number'], $htmlContent);
    $htmlContent = str_replace('{organizer_head}', $renter_table['organizer_head'], $htmlContent);
    $htmlContent = str_replace('{tenant_name}', $renter_table['tenant_name'], $htmlContent);
    $htmlContent = str_replace('{kelurahan}', $renter_table['tenant_village'], $htmlContent);
    $htmlContent = str_replace('{kecamatan}', $renter_table['tenant_district'], $htmlContent);
    $htmlContent = str_replace('{alamat}', $renter_table['tenant_address'], $htmlContent);
    $htmlContent = str_replace('{rt}', $rtrw['tenant_rt'], $htmlContent);
    $htmlContent = str_replace('{rw}', $rtrw['tenant_rw'], $htmlContent);

    $mpdf = new Mpdf(['orientation' => 'P', 'format' => 'A4-P']);

    $mpdf->WriteHTML($htmlContent);
    $mpdf->AddPage();
    $mpdf->WriteHTML($htmlContent2);

    // Simpan PDF ke folder server
    $fileName = $fileName . '.pdf';
    $filePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/PDF/agreement/' . $fileName;
    $mpdf->Output($filePath, 'F');

    $urlToRun = "http://3dmap-kadaster.test/action/sertifikat.php?Tenant=" . $tenantID . "&Room=" . $roomID . "&fileName=" . $fileName;
    $response = file_get_contents($urlToRun);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $tenantID = $_GET['tenant_id'];
    $roomID = $_GET['room_id'];
    $sql = "SELECT rt.id as renter2room_id, rt.tenant_id, rt.room_id, rt.due_started, rt.due_finished, rt.tenure_status, rt.agreement_number, t.*, rm.*, m.id as organizer_id, m.organizer_name, m.organizer_city, m.organizer_head
    FROM renters_tenants rt
    LEFT JOIN rooms_table rm ON rt.room_id = rm.room_id
    LEFT JOIN tenants_table t ON rt.tenant_id = t.id
    LEFT JOIN managements_table m ON rm.organizer_id = m.id
    WHERE rt.tenant_id = $tenantID && rt.room_id = $roomID
    LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $renter_table = $result->fetch_assoc();
    }
    debugVarDump($renter_table);
}


mysqli_close($conn);
