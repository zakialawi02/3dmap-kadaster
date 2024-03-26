<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php';

// Mendapatkan waktu saat ini
$waktu_saat_ini = time();

// Tampilkan tanggal yang diformat
echo timeIDN();
echo "</br>";
echo timeIDN("hari tahun");
echo "</br>";
echo timeIDN("tanggal, bulan tahun");
echo "</br>";
