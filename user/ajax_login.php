<?php
include_once '../function/xss_clean.php';
$username = strtolower(trim($_POST['username']));
$password = trim($_POST['password']);
if (function_exists('xss_clean')) {
    $username = xss_clean($username);
    $password = xss_clean($password);
}
$json = array();

if (hasSC(array($username, $password))) {
    $json['status'] = false;
    $json['msg'] = 'Vui lòng không nhập ký tự đặc biệt!';
    echo json_encode($json);
    exit;
}

if (empty($username) || empty($password)) {
    $json['status'] = false;
    $json['msg'] = 'Vui lòng điền vào các trường!';
} else {
    include_once '../db/connect.php';
    $hashPassword = sha1($password);
    $result = $dbh->query("SELECT `id`, `status` FROM `user` WHERE `username` = '{$username}' AND `password` = '{$hashPassword}' LIMIT 1")->fetch();
    if ($result !== false) {
        if ($result['status'] == '1') {
            $json['status'] = true;
			$json['msg'] = 'Đăng nhập thành công!';
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['login_type'] = 'original';
        } else {
            $json['status'] = false;
            $json['msg'] = 'Tài khoản này đã bị khóa!';
        }
    } else {
        $json['status'] = false;
        $json['msg'] = 'Đăng nhập thất bại!';
    }
}
echo json_encode($json);