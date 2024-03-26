<?php
session_start();
$BASE_URL = "http://3dmap-kadaster.test/";

// Set timezone
date_default_timezone_set('Asia/Jakarta');
// Set bahasa menjadi Bahasa Indonesia
setlocale(LC_TIME, 'id_ID');


include_once $_SERVER['DOCUMENT_ROOT'] . '/action/fucntion.php';
