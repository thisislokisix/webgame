<?php
session_start();
define("APP_ID", "685928554885534");
define("SECRET_KEY", "2ec4802324d77fc2a206b3d626921964");

require_once '../lib/facebook-php-sdk/src/facebook.php';
$facebook = new Facebook(array(
    'appId'  => APP_ID,
    'secret' => SECRET_KEY,
));

// Get User ID
$fbUserId = $facebook->getUser();
$status = true;
if ($fbUserId) {
    try {
        $user_profile = $facebook->api('/me');
        $userIdentify = 'fb_' . $fbUserId;
        if (isset($user_profile['id']) && !empty($user_profile['id'])) {
            include_once '../db/connect.php';
            $username = $user_profile['email'];
            $resultCount = $dbh->query("SELECT id FROM `user` WHERE `username` = '{$username}'")->rowCount();
            $resultCountNew = $dbh->query("SELECT id FROM `user` WHERE `username` = '{$userIdentify}'")->rowCount();
            if (!$resultCount && !$resultCountNew) {
                try {
                    date_default_timezone_set("Asia/Ho_Chi_Minh");
                    $dbh->prepare("INSERT INTO `user` (username, email, refer, created_at) VALUES (?, ?, ?, ?)")
                        ->execute(array($userIdentify, $username, $_SESSION['refer'], date('Y-m-d H:i:s')));
                } catch (Exception $e) {
                    $status = false;
                }
            }

            if ($status === true) {
                $_SESSION['login'] = true;
                if (!$resultCount) {
                    $_SESSION['username'] = $userIdentify;
                } else {
                    $_SESSION['username'] = $username;
                }
                $_SESSION['login_type'] = 'social';
                echo '<script>
                if (window.opener.document.body.className == "intro-page") {
                    var serverId = window.opener.document.body.id;
                    window.opener.location.href = "/choi-game/" + serverId;
                } else {
                    window.opener.location.reload(true);
                }
                window.close();
                </script>';
            }
        }
    } catch (FacebookApiException $e) {
        $status = false;
    }
} else {
    $status = false;
}

if (!$status) {
    $loginUrl = $facebook->getLoginUrl(array('scope' => 'email'));
    header('Location: ' . $loginUrl);
}



?>