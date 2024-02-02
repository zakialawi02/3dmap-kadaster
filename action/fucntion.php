<?php
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
