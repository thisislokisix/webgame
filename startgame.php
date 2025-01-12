<?php

header('Content-type: text/html; charset=utf-8');
session_start();
$serverId = strtolower($_GET['server']);
if (!$_SESSION['login'] || empty($serverId) || empty($_SESSION['username'])) {
    echo '<script>alert("Vui lòng đăng nhập để vào game!");location.href="/"</script>';
    exit;
}
$username = $_SESSION['username'];
$_SESSION['server_id'] = $serverId;
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once($_SERVER['DOCUMENT_ROOT'] . '/function/server.php');


if (!in_array($serverId, array_keys($servers)) || !isset($servers[$serverId]['ip'])) {
    header('location: /');
    exit;
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/db/connect.php');
$userQ = $dbh->query("SELECT id FROM user WHERE username = '{$username}' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$uid = $userQ['id'];
if (!$uid) {
    echo '<script>alert("Thông tin truy cập không hợp lệ!");location.href="/"</script>';
    exit;
}
include_once($_SERVER['DOCUMENT_ROOT'] . '/function/ip.php');
$playIp = getUserIp();
$serverIdInt = preg_replace('/[^0-9]+/', '', $serverId);
$dbh->prepare("UPDATE user SET last_login_ip = ?, last_login_time = ?, last_server = ? WHERE username = ?")
    ->execute(array($playIp, date('Y-m-d H:i:s'), $serverIdInt, $_SESSION['username']));

$server_name = $servers[$serverId]['name'];
$sid = $servers[$serverId]['sid'];
$play_ip = $servers[$serverId]['play_ip'];
$api_url = $servers[$serverId]['api_url'];
$api_port = $servers[$serverId]['api_port'];
$http_port = $servers[$serverId]['http_port'];
$name = $username."_".$sid;
$pay = "/nap-the";
$sign = md5($pay.$name."douge1242821087kaifuytl");
$url = "$api_url/s1.php?account=".$userkey."&ip=".$ip."&port=".$port."&port2=".$port2;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="index,follow" />
    <meta name="revisit-after" content="1days" />
    <meta name="robots" content="index,follow" />
    <meta name="revisit-after" content="1days" />
    <title><?php echo $server_name;?></title>
    <meta name="description" content="Webgame nhập vai thiết kỵ hàng đầu Việt Nam theo cốt truyện tam quốc chí với giao diện 2D cùng hàng loạt kỹ xảo 3D đẹp mắt chân thực. Thấy là thích, chơi là mê! Tham gia Thiết Kỵ Tam Quốc nào!"/>
    <meta name="keywords" content="Thiết kỵ, game nhập vai thiết kỵ tam quốc, game nhập vai thiết kỵ, game tam quốc, game nhap vai, thiet ky tam quoc, game thiet ky tam quoc, webgame, webgame nhập vai, web game nhap vai, web game moi, game tam quoc, game không môn phái, game tam quốc"/>
    <meta property="og:title" content="TKTQ - game tam quốc chiến đấu thiết kỵ chân thực nhất" />				
    <meta property="og:url" content="/" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="/frontend/images/fb-299-share.jpg" />				
    <meta property="og:description" content="Webgame nhập vai thiết kỵ hàng đầu Việt Nam theo cốt truyện tam quốc chí với giao diện 2D cùng hàng loạt kỹ xảo 3D đẹp mắt chân thực. Thấy là thích, chơi là mê! Tham gia Thiết Kỵ Tam Quốc nào!" />
    <link rel="icon" href="/frontend/images/favicon.ico" type="image/x-icon" />
    <link rel="image_src" href="/frontend/images/fb-299-share.jpg" />
    <link rel="stylesheet" href="/frontend/slide_bar/css/normalize.css">
    <link rel="stylesheet" href="/frontend/slide_bar/css/gameplay.css">
    <link rel="stylesheet" href="/frontend/slide_bar/css/jquery.alert.css" />
    <script type="text/javascript" src="/frontend/slide_bar/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/frontend/slide_bar/js/game.js"></script>
    <style>
        .gameplay { position: relative; }
    </style>
</head>
<body onload="$('.close-lb').trigger('click');">
<div class="side-bar" >
    <div class="close-lb in"></div>
    <div class="lb-logo" id="result">
        <a href="/" target="_blank"></a>
    </div>
    <div class="lb-userinfo">
        <p class="username">Xin chào,
		<?php echo $_SESSION['username']; ?>
		</p>
        <p class="profile">
            <a href="/thong-tin-tai-khoan" target="_blank">Thông tin tài khoản</a>
            <a href="/thoat" class="exit">[Thoát]</a>
        </p>
        <p>Máy chủ đang chơi</p>
        <p class="text-gold sv-play"><?php echo $server_name;?></p>
    </div>

    <div class="select_server">
        <p class="click"></p>
        <ul>
		<?php foreach ($servers as $svId => $sv): ?>
        <li><a href="/choi-game/<?php echo $svId ?>"><?php echo $sv['name'] ?></a></li>
		<?php endforeach; ?>
        </ul>
    </div>
    <div class="group-btn">
        <ul>
            <li class="napthe"><a href="/nap-the" target="_blank"></a></li>
            <li><a href="javascript:void(0)" class="btn-reward login"></a></li>
            <li><a target="_blank" href="https://www.facebook.com/game.toandaik"></a></li>
            <li><a target="_blank" href="https://www.facebook.com/game.toandaik"></a></li>
            <li><a target="_blank" href="/cam-nang"></a></li>
        </ul>
    </div>
    <div class="hotline"></div>
</div>
<div class="gameplay">
    <iframe id="iframe-play" src="<?php echo $url;?>" width="100%" height="100%" scrolling="no" frameborder="0"></iframe>
</div>
</body>
</html>