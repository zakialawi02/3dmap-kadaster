<?php
function base_url(string $uri = ''): string
{
    global $BASE_URL;
    return rtrim($BASE_URL, '/') . '/' . ltrim($uri, '/');
}

function timeIDN($format = 'hari, tanggal bulan tahun')
{
    include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';
    // Array nama hari dalam Bahasa Indonesia
    $nama_hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    // Array nama bulan dalam Bahasa Indonesia
    $nama_bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    // Mendapatkan informasi hari, tanggal, bulan, dan tahun
    $hari = date('w'); // Mendapatkan hari dalam angka (0 = Minggu, 1 = Senin, dst.)
    $tanggal = date('d');
    $bulan = date('m'); // Mendapatkan bulan dalam angka (1-12)
    $tahun = date('Y');

    // Menyesuaikan format yang diminta
    $format = str_replace("hari", $nama_hari[$hari], $format);
    $format = str_replace("tanggal", $tanggal, $format);
    $format = str_replace("bulan", $nama_bulan[$bulan - 1], $format);
    $format = str_replace("tahun", $tahun, $format);

    return $format;
}





function checkIsLogin()
{
    if (!isset($_SESSION['islogin'])) {
        header("Location: /auth/login.php");
        exit;
    }
}

function setFlashMessage($type = 'success', $message = 'success')
{
    $_SESSION['flashMessage'] = [
        'type' => $type,
        'message' => $message,
    ];
}

function getFlashMessage()
{
    if (isset($_SESSION['flashMessage'])) {
        $message = $_SESSION['flashMessage'];
        unset($_SESSION['flashMessage']);
        return $message;
    }
    return null;
}
$flashMessage = getFlashMessage();

function old($name)
{
    if (isset($_SESSION['oldForm'][$name])) {
        return $_SESSION['oldForm'][$name];
    }
    return null;
}

function debugVarDump($variable, $die = true)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    $die ? die : '';
}

use Mpdf\Mpdf;

function generateAgreement($tenantID, $roomID)
{
    include 'db_connect.php';
    $query = "SELECT rm.room_id, rm.legal_object_id, lo.id as objectId, lo.parcel_id, lp.id as buildingId, lp.parcel_id
    FROM rooms_table rm
    LEFT JOIN legal_objects_table lo ON rm.legal_object_id = lo.id
    LEFT JOIN land_parcel_table lp ON lp.parcel_id = lo.parcel_id
    WHERE rm.room_id = '$roomID' 
    LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        $from = $result->fetch_assoc();
    }
    $from = $from['buildingId'];
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
    $tenantNumber = str_pad($tenantID, 4, '0', STR_PAD_LEFT);
    $agrementNumber = $tenantNumber . "/1679/" . $placeNumber . "/" . $date;
    $fileName = str_replace('/', '.', $agrementNumber);

    // debugVarDump($fileName);

    $sqlUpdateRenter = "UPDATE renters_tenants SET agreement_number = '$agrementNumber' WHERE tenant_id = $tenantID";
    $resultSql = mysqli_query($conn, $sqlUpdateRenter);
    if ($resultSql) {
        $agrementNumber = json_encode($agrementNumber);
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
    $htmlContent = str_replace('{date_now}', date("l, j F Y"), $htmlContent);
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

    $mpdf = new Mpdf(['orientation' => 'P', 'format' => 'A4-P']);

    $mpdf->WriteHTML($htmlContent);
    // $mpdf->AddPage();
    // $mpdf->WriteHTML($htmlContent2);

    // Simpan PDF ke folder server
    $fileName = $fileName . '.pdf';
    $filePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/PDF/agreement/' . $fileName;
    $mpdf->Output($filePath, 'F');

    $urlToRun = base_url() . "/action/sertifikat.php?Tenant=" . $tenantID . "&Room=" . $roomID . "&fileName=S_" .  $fileName;
    echo "<br>";
    echo $urlToRun;
    $response = file_get_contents($urlToRun);
}
