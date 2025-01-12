<?php
session_start();
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$new_pass = trim($_POST['new_pass']);
$new_pass_confirm = trim($_POST['new_pass_confirm']);

include_once '../function/xss_clean.php';
if (function_exists('xss_clean')) {
    $name = xss_clean($name);
    $email = xss_clean($email);
    $phone = xss_clean($phone);
	$new_pass = xss_clean($new_pass);
    $new_pass_confirm = xss_clean($new_pass_confirm);
}

if (hasSC(array($name, $email, $phone, $new_pass, $new_pass_confirm))) {
    $_SESSION['global_message'] = 'Vui lòng không nhập ký tự đặc biệt';
    header('location: /quen-mat-khau');
    exit;
}

if (empty($name) || empty($email) || empty($phone) || empty($new_pass) || empty($new_pass_confirm)) {
    $_SESSION['global_message'] = 'Vui lòng nhập đủ các trường';
    header('location: /quen-mat-khau');
    exit;
}

if ($new_pass != $new_pass_confirm) {
    $_SESSION['global_message'] = 'Hai mật khẩu không khớp';
    header('location: /quen-mat-khau');
    exit;
}

include_once '../db/connect.php';
$reset_pass = sha1($new_pass);
$checkInfo = $dbh->query("SELECT `id`, `status` FROM `user` WHERE `username` = '{$name}' AND `email` = '{$email}' AND `phone` = '{$phone}' LIMIT 1")->fetch();
if ($checkInfo === false) {
    $_SESSION['global_message'] = 'Thông tin tài khoản không đúng!';
    header('location: /quen-mat-khau');
    exit;
}
try {
    $result = $dbh->prepare("UPDATE `user` SET `password` = '{$reset_pass}' WHERE `username` = '{$name}'")->execute();
    $_SESSION['global_message'] = 'Lấy lại mật khẩu thành công!';
} catch (Exception $e) {
    $_SESSION['global_message'] = 'Lỗi: ' . $e->getMessage();
}
header('location: /quen-mat-khau');
