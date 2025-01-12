<?php
session_start();
if (!$_SESSION['login']) {
    header('Location: /');
    exit;
}
$username = $_SESSION['username'];
$passwordOld = trim($_POST['password-old']);
$passwordNew = trim($_POST['password-new']);
$passwordNew1 = trim($_POST['password1-new']);

include_once '../function/xss_clean.php';
if (function_exists('xss_clean')) {
    $username = xss_clean($username);
    $passwordOld = xss_clean($passwordOld);
    $passwordNew = xss_clean($passwordNew);
    $passwordNew1 = xss_clean($passwordNew1);
}

if (hasSC(array($username, $passwordOld, $passwordNew, $passwordNew1))) {
    $_SESSION['global_message'] = 'Vui lòng không nhập ký tự đặc biệt';
    header('location: /doi-mat-khau');
    exit;
}

if (empty($passwordOld) || empty($passwordNew) || empty($passwordNew1)) {
    $_SESSION['global_message'] = 'Vui lòng nhập đủ các trường';
    header('location: /doi-mat-khau');
    exit;
}

if ($passwordOld == $passwordNew) {
    $_SESSION['global_message'] = 'Mật khẩu cũ trùng với mật khẩu mới';
    header('location: /doi-mat-khau');
    exit;
}

if ($passwordNew != $passwordNew1) {
    $_SESSION['global_message'] = 'Mật khẩu không khớp';
    header('location: /doi-mat-khau');
    exit;
}

include_once '../db/connect.php';
$hashPassword = sha1($passwordNew);
$hashPasswordOld = sha1($passwordOld);
$checkOldPass = $dbh->query("SELECT `id`, `status` FROM `user` WHERE `username` = '{$username}' AND `password` = '{$hashPasswordOld}' LIMIT 1")->fetch();
if ($checkOldPass === false) {
    $_SESSION['global_message'] = 'Mật khẩu vui lòng nhập đúng mật khẩu cũ!';
    header('location: /doi-mat-khau');
    exit;
}
try {
    $result = $dbh->prepare("UPDATE `user` SET `password` = '{$hashPassword}' WHERE `username` = '{$username}'")->execute();
    $_SESSION['global_message'] = 'Đổi mật khẩu thành công!';
} catch (Exception $e) {
    $_SESSION['global_message'] = 'Lỗi: ' . $e->getMessage();
}
header('location: /doi-mat-khau');
