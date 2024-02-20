<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';

use Mpdf\Mpdf;

// Include the database connection file
include_once 'db_connect.php';

$objectID = $_GET['objectId'];
$residentID = $_GET['idr'];
// get data parcel_table where
$sql = "SELECT p.*, r.*,
                JSON_ARRAYAGG(
                JSON_OBJECT(
                    'id_keyword', u.id_keyword,
                    'word_name', u.word_name,
                    'slug', u.slug,
                    'isUrl', u.isUrl
                    )
                ) AS tag
                FROM parcel_table p
                LEFT JOIN linked_uri lu ON p.parcel_id = lu.parcel_id
                LEFT JOIN residents_table r ON p.parcel_occupant = r.id_resident
                LEFT JOIN uri_table u ON lu.id_keyword = u.id_keyword
                WHERE r.id_resident = $residentID AND p.parcel_id = '$objectID'
                GROUP BY p.id, p.parcel_id, p.parcel_name, p.parcel_occupant";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $parcel_table = $result->fetch_assoc();

    $html = $_SERVER['DOCUMENT_ROOT'] . "/generatepdfcontent.html";
    $htmlContent = file_get_contents($html);

    // Ganti placeholder dengan data dari database
    $htmlContent = str_replace('{resident_code}', $parcel_table['resident_code'], $htmlContent);
    $htmlContent = str_replace('{resident_name}', $parcel_table['resident_name'], $htmlContent);
    $htmlContent = str_replace('{parcel_id}', $parcel_table['parcel_id'], $htmlContent);
    $htmlContent = str_replace('{started}', !empty($parcel_table['started']) ? (new DateTime($parcel_table['started']))->format('j-M-Y') : "-", $htmlContent);
    $htmlContent = str_replace('{finished}', !empty($parcel_table['finished']) ? (new DateTime($parcel_table['finished']))->format('j-M-Y') : "-", $htmlContent);

    $mpdf = new Mpdf(['orientation' => 'L']);
    $mpdf->AddPage('A4');
    // $mpdf->WriteHTML('<h1>Hello world!</h1>');
    $mpdf->WriteHTML($htmlContent);

    header('Content-Type: application/pdf');
    $mpdf->Output('sertifikat.pdf', 'I');
} else {
    header("Location: /404.php");
    exit();
}




// Close the database connection
$conn->close();
