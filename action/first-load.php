<?php
session_start();
if (!isset($_SESSION['islogin'])) {
    header("Location: /auth/login.php");
}
