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
    $mappingData = [
        "1" => "3578071",
        "siola" => "3578071",
        "2" => "3578071",
        "balaipemuda" => "3578071",
        "3" => "3573403",
        "rusunawaburing2" => "3573403",
    ];
    if (isset($mappingData[$from])) {
        $placeNumber = $mappingData[$from];
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

    $sql = "SELECT rt.id as renter2room_id, rt.tenant_id, rt.room_id, rt.due_started, rt.due_finished, rt.tenure_status, rt.agreement_number, rt.permit_flats, t.*, rm.*, m.id as organizer_id, m.organizer_name, m.organizer_address, m.organizer_city, m.organizer_head
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
    if ($from == "1" || $from == "2") {
        $html = $_SERVER['DOCUMENT_ROOT'] . "/generateAgreementSurabayaPDF.html";
        $htmlContent = file_get_contents($html);

        // Ganti placeholder dengan data dari database
        if ($from == "1") {
            $t = "SIOLA";
            $c = "Kota Surabaya";
            $a = "Jl. Tunjungan No.1, Genteng, Kec. Genteng, Surabaya";
        } elseif ($from == "2") {
            $t = "BALAI PEMUDA";
            $c = "Kota Surabaya";
            $a = "Jl. Gubernur Suryo No.15, Embong Kaliasin, Kec. Genteng, Surabaya";
        } elseif ($from == "3") {
            $t = "RUSUNAWA BURING 2";
            $c = "Kota Malang";
            $uu = "821.2/166/35.73.502 /2022";
        }
        $htmlContent = str_replace('{room_id}', $roomID, $htmlContent);
        $htmlContent = str_replace('{building}', $t, $htmlContent);
        $htmlContent = str_replace('{building_address}', $a, $htmlContent);
        $htmlContent = str_replace('{agreement_number}', json_decode($agrementNumber), $htmlContent);
        $htmlContent = str_replace('{date_now}', timeIDN('tanggal bulan tahun'), $htmlContent);
        $htmlContent = str_replace('{due_started}', timeIDN('tanggal bulan tahun', $renter_table['due_started']), $htmlContent);
        $htmlContent = str_replace('{pemakaian_ruang}', $renter_table['room_name'], $htmlContent);
        $htmlContent = str_replace('{organizer_head}', $renter_table['organizer_head'], $htmlContent);
        $htmlContent = str_replace('{organizer_name}', $renter_table['organizer_name'], $htmlContent);

        $mpdf = new Mpdf(['orientation' => 'P', 'format' => 'A4-P']);

        $mpdf->WriteHTML($htmlContent);

        // Simpan PDF ke folder server
        $fileName = $fileName . '.pdf';
        $filePath1 = $_SERVER['DOCUMENT_ROOT'] . '/assets/PDF/agreement/' . $fileName;
        $filePath2 = $_SERVER['DOCUMENT_ROOT'] . '/assets/PDF/certificate/S_' . $fileName;
        $mpdf->Output($filePath1, 'F');
        $mpdf->Output($filePath2, 'F');

        $sqlUpdateRenter = "UPDATE renters_tenants SET permit_flats = 'S_" . $fileName . "' WHERE tenant_id = " . $tenantID;
        $resultSql = mysqli_query($conn, $sqlUpdateRenter);


        // $urlToRun = base_url() . "/action/sertifikatSurabayaBuilding.php?Tenant=" . $tenantID . "&Room=" . $roomID . "&fileName=S_" .  $fileName;
        // $response = file_get_contents($urlToRun);
    } elseif ($from == "3") {
        $html = $_SERVER['DOCUMENT_ROOT'] . "/generateAgreementRusunPDF.html";
        $htmlContent = file_get_contents($html);
        $html = $_SERVER['DOCUMENT_ROOT'] . "/generateAgreementRusunPDF2.html";
        $htmlContent2 = file_get_contents($html);

        // Ganti placeholder dengan data dari database
        if ($from == "1") {
            $t = "SIOLA";
            $c = "Kota Surabaya";
            $uu = "821.2/166/35.78.071 /2021";
        } elseif ($from == "2") {
            $t = "BALAI PEMUDA";
            $c = "Kota Surabaya";
            $uu = "821.2/166/35.78.071 /2021";
        } elseif ($from == "3") {
            $t = "RUSUNAWA BURING 2";
            $c = "Kota Malang";
            $uu = "821.2/166/35.73.502 /2022";
        }
        $htmlContent = str_replace('{place}', $t, $htmlContent);
        $htmlContent = str_replace('{room_id}', $roomID, $htmlContent);
        $htmlContent = str_replace('{agreement_number}', json_decode($agrementNumber), $htmlContent);
        $htmlContent = str_replace('{date_now}', timeIDN(), $htmlContent);
        $htmlContent = str_replace('{agrement_place}', $c, $htmlContent);
        $htmlContent = str_replace('{nik}', $renter_table['name_number'], $htmlContent);
        $htmlContent = str_replace('{noUU}', $uu, $htmlContent);
        $htmlContent = str_replace('{organizer_name}', $renter_table['organizer_name'], $htmlContent);
        $htmlContent = str_replace('{organizer_city}', $renter_table['organizer_city'], $htmlContent);
        $htmlContent = str_replace('{organizer_address}', $renter_table['organizer_address'], $htmlContent);
        $htmlContent = str_replace('{organizer_head}', $renter_table['organizer_head'], $htmlContent);
        $htmlContent = str_replace('{tenant_name}', $renter_table['tenant_name'], $htmlContent);
        $htmlContent = str_replace('{kelurahan}', $renter_table['tenant_village'], $htmlContent);
        $htmlContent = str_replace('{kecamatan}', $renter_table['tenant_district'], $htmlContent);
        $htmlContent = str_replace('{alamat}', $renter_table['tenant_address'], $htmlContent);
        $htmlContent = str_replace('{rt}', $rtrw['tenant_rt'], $htmlContent);
        $htmlContent = str_replace('{rw}', $rtrw['tenant_rw'], $htmlContent);

        $htmlContent2 = str_replace('{rent_fee}', "Rp. " . $renter_table['rent_fee'] . ",-" ?? 'sesuai ketentuan yang ditetapkan', $htmlContent2);
        $htmlContent2 = str_replace('{due_finished}', $renter_table['due_finished'] ?? 'sesuai jangka waktu yang ditentukan', $htmlContent2);
        $htmlContent2 = str_replace('{tenant_name}', $renter_table['tenant_name'], $htmlContent2);
        $htmlContent2 = str_replace('{organizer_city}', strtoupper($renter_table['organizer_city']), $htmlContent2);
        $htmlContent2 = str_replace('{organizer_name}', strtoupper($renter_table['organizer_name']), $htmlContent2);
        $htmlContent2 = str_replace('{organizer_head}', $renter_table['organizer_head'], $htmlContent2);


        $mpdf = new Mpdf(['orientation' => 'P', 'format' => 'A4-P']);

        $mpdf->WriteHTML($htmlContent);
        $mpdf->AddPage();
        $mpdf->WriteHTML($htmlContent2);

        // Simpan PDF ke folder server
        $fileName = $fileName . '.pdf';
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/PDF/agreement/' . $fileName;
        $mpdf->Output($filePath, 'F');

        $urlToRun = base_url() . "/action/sertifikatRusun.php?Tenant=" . $tenantID . "&Room=" . $roomID . "&fileName=S_" .  $fileName;
        $response = file_get_contents($urlToRun);
    }
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
}


mysqli_close($conn);
