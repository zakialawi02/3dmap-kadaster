<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';

use Mpdf\Mpdf;

// Include the database connection file
include 'db_connect.php';

// jika request method get biasa
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['Tenant']) && !empty($_GET['Tenant']) && isset($_GET['Room']) && !empty($_GET['Room'])) {
        $tenantID = $_GET['Tenant'];
        $roomID = $_GET['Room'];
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
            $legalID = $renter_table['legal_object_id'];
            $sql = "SELECT rm.room_id, lo.id as legalID, lo.parcel_id, lo.parcel_name, lp.building
                    FROM rooms_table rm 
                    LEFT JOIN legal_objects_table lo ON rm.legal_object_id = lo.id
                    LEFT JOIN land_parcel_table lp ON lo.parcel_id = lp.parcel_id
                    WHERE lo.id = '$legalID'";
            $result = $conn->query($sql);
            $parcel = $result->fetch_assoc();
            $html = $_SERVER['DOCUMENT_ROOT'] . "/generateSertifikatPDF.html";
            $htmlContent = file_get_contents($html);

            // Ganti placeholder dengan data dari database
            $htmlContent = str_replace('{type}', "Occupancy", $htmlContent);
            $htmlContent = str_replace('{place}', $parcel['building'], $htmlContent);
            $htmlContent = str_replace('{tenant_name}', $renter_table['tenant_name'], $htmlContent);
            $htmlContent = str_replace('{room_id}', $renter_table['room_id'], $htmlContent);
            $htmlContent = str_replace('{marriage_status}', $renter_table['marriage_status'] ?? "NULL", $htmlContent);
            $htmlContent = str_replace('{number_residents}', $renter_table['number_residents'] ?? "NULL", $htmlContent);
            $htmlContent = str_replace('{agreement_number}', $renter_table['agreement_number'] ?? "NULL", $htmlContent);
            $htmlContent = str_replace('{due_finished}', !empty($renter_table['due_finished']) ? (new DateTime($renter_table['due_finished']))->format('j-M-Y') : "-", $htmlContent);
            $htmlContent = str_replace('{date_now}', date("j F Y"), $htmlContent);
            $htmlContent = str_replace('{organizer_city}', $renter_table['organizer_city'], $htmlContent);
            $htmlContent = str_replace('{organizer_city2}', strtoupper($renter_table['organizer_city']), $htmlContent);
            $htmlContent = str_replace('{organizer_name}', strtoupper($renter_table['organizer_name']), $htmlContent);
            $htmlContent = str_replace('{organizer_head}', $renter_table['organizer_head'], $htmlContent);

            $mpdf = new Mpdf(['orientation' => 'L', 'format' => 'A4-L']);
            // $mpdf->WriteHTML('<h1>Hello world!</h1>');
            $mpdf->WriteHTML($htmlContent);

            // Simpan PDF ke folder server
            $fileName = $_GET['fileName'] ?? "sertifikat.pdf";
            $fileName = $fileName;
            $filePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/PDF/certificate/' . $fileName;
            $mpdf->Output($filePath, 'F');

            $sqlUpdateRenter = "UPDATE renters_tenants SET permit_flats = '$fileName' WHERE tenant_id = $tenantID";
            $resultSql = mysqli_query($conn, $sqlUpdateRenter);
        } else {
            header("Location: /404.php");
            exit();
        }
    }
}


mysqli_close($conn);
