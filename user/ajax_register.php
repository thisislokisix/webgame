<?php
include_once '../function/xss_clean.php';
$username = strtolower(trim($_POST['username']));
$password = trim($_POST['password']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$bypassPhone = $_POST['bypassphone'];
$refer = $_POST['refer'];
if (function_exists('xss_clean')) {
    $username = xss_clean($username);
    $password = xss_clean($password);
    $email = xss_clean($email);
    $phone = xss_clean($phone);
    $bypassPhone = xss_clean($bypassPhone);
    $refer = xss_clean($refer);
}
$json = array();

if (hasSC(array($username, $password, $email, $phone, $bypassPhone, $refer))) {
    $json['status'] = false;
    $json['msg'] = 'Không nhập ký tự đặc biệt!';
    echo json_encode($json);
    exit;
}

if (strlen($username) > 24) {
    $json['status'] = false;
    $json['msg'] = 'Tên đăng nhập không quá 24 ký tự!';
    echo json_encode($json);
    exit;
}

if (empty($username) || empty($password) || empty($email) || (empty($phone) && $bypassPhone != 1)) {
    $json['status'] = false;
    $json['msg'] = 'Vui lòng điền vào các trường!';
} else {
    include_once '../db/connect.php';
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $hashPassword = sha1($password);
    $result = $dbh->query("SELECT id FROM `user` WHERE `username` = '{$username}'")->fetchAll();
    if (!count($result)) {
        try {
            $dbh->prepare("INSERT INTO `user` (username, email, phone, password, refer, created_at) VALUES (?, ?, ?, ?, ?, ?)")
                ->execute(array($username, $email, $phone, sha1($password), $refer, date('Y-m-d H:i:s')));
            $json['status'] = true;
			$json['msg'] = 'Đăng ký thành công!';
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['login_type'] = 'original';
            $_SESSION['username'] = $username;
        } catch (Exception $e) {
            $json['status'] = false;
            $json['msg'] = 'Đăng ký lỗi!';
        }
    } else {
        $json['status'] = false;
        $json['msg'] = 'Tên tài khoản đã tồn tại!';
    }
}
echo json_encode($json);