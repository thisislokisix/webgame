<?php session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/db/connect.php'); 
include_once($_SERVER['DOCUMENT_ROOT'] . '/function/server.php');
$username = $_SESSION['username']; 
$userInfo = $dbh->query("SELECT * FROM user WHERE `username` = '{$username}'")->fetch(); 
$ip = "127.0.0.1";
$port = "18192";
$port2 = "1007";
$url = "tqsg/s1.php?account=".$username."&ip=".$ip."&port=".$port."&port2=".$port2;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="index,follow" />
	<meta name="revisit-after" content="1days" />
	<title>Armored Kingdom | Web-based Online RPG</title>
	<meta name="description" content="Webgame nhập vai thiết kỵ hàng đầu Việt Nam theo cốt truyện tam quốc chí với giao diện 2D cùng hàng loạt kỹ xảo 3D đẹp mắt chân thực. Thấy là thích, chơi là mê! Tham gia Thiết Kỵ Tam Quốc nào!"/>
	<meta name="keywords" content="Thiết kỵ, game nhập vai thiết kỵ tam quốc, game nhập vai thiết kỵ, game tam quốc, game nhap vai, thiet ky tam quoc, game thiet ky tam quoc, webgame, webgame nhập vai, web game nhap vai, web game moi, game tam quoc, game không môn phái, game tam quốc"/>
	<meta property="og:title" content="TKTQ - game tam quốc chiến đấu thiết kỵ chân thực nhất" />				
	<meta property="og:url" content="/" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="/frontend/images/fb-299-share.jpg" />				
	<meta property="og:description" content="Webgame nhập vai thiết kỵ hàng đầu Việt Nam theo cốt truyện tam quốc chí với giao diện 2D cùng hàng loạt kỹ xảo 3D đẹp mắt chân thực. Thấy là thích, chơi là mê! Tham gia Thiết Kỵ Tam Quốc nào!" />
	<link rel="icon" href="/frontend/images/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="/frontend/css/swiper.min.css">
    <link rel="stylesheet" href="/frontend/css/style.css">
	<link rel="stylesheet" href="/frontend/css/account.css">
    <link rel="stylesheet" href="/frontend/fancybox/fancybox-css.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/frontend/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/frontend/css/jquery.alert.css">
    <script type="text/javascript" src="/frontend/js/jquery.js"></script>
</head>
<body>
<div style="display: none" id="account">
	<ul>
		<li><a data-link="dk" href="javascript:;" class="dky active">ĐĂNG KÝ</a></li>
		<li><a data-link="dn" href="javascript:;" class="dnhap">ĐĂNG NHẬP</a></li>
	</ul>
	<div class="tab-register tab-account" id="dk">
		<form id="form-register" onsubmit="return false;">
			<input class="user keydown-rg"  placeholder="Username " type="text" name="username" id="username-rg">
			<input class="lock keydown-rg"  placeholder="Password " type="password" name="password" id="password-rg">
			<input class="email keydown-rg" placeholder="Email "  type="text" name="email" id="email-rg">
			<input class="phone keydown-rg" placeholder="Phone "  type="text" name="phone" id="phone-rg">
			<p class="notice kq-rg"></p>
			<a class="btn_dk bt-dk id_dangky" href="javascript:;" id="btn-regisnew" onclick="registerUser('#form-register','.kq-rg');"></a>
		</form>
	</div>
	<div class="tab-login tab-account" id="dn">
		<form id="form-login" onsubmit="return false;">
			<input class="user keydown"  placeholder="Username " type="text" name="username" id="user-login">
			<input class="lock keydown"  placeholder="Password " type="password" name="password" id="pass-login">
			<a class="q-mk" href="/quen-mat-khau">Forgot password?</a>
			<p class="notice kq-login"></p>
			<a class="btn_dn" href="javascript:;" id="btn-login" onclick="loginUser('#form-login','.kq-login');"></a>
		</form>
				<p class="n2"></p>
		
			</div>
</div>

<div class="wrap">
    <div class="swiper-container" style="margin: 0 auto; position: relative; top: 0px; left: 0px; width: 100%; height: 650px;">
        <div class="swiper-wrapper">
		<?php
		$slideData = $dbh->query("SELECT * FROM `config` WHERE `key` LIKE 'home_banner_%'")->fetchAll();
		$slides = array();
		foreach ($slideData as $slideItem) {
		$slides[$slideItem['key']] = $slideItem['value'];
		}
		$slideImages = array();
		foreach ($slides as $key => $value) {
		if (strpos($key, '_link') === false && !empty($slides[$key . '_link'])) {
        $slideImages[] = array(
            'url' => $value,
            'link' => $slides[$key . '_link']
        );
		    }
		}
		?>
		<?php foreach ($slideImages as $image): ?>
            <div class="swiper-slide">
                <a href="<?php echo $image['link'] ?>"><img class="center-img" src="<?php echo $image['url'] ?>" /></a>
            </div>
        <?php endforeach; ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>

    <div class="logo">
        <div class="content">
            <a href="/"><img src="/frontend/images/logo.png" alt=""></a>
        </div>
    </div>
<script>
        function card_login() {
        var username = $("#username").val();
        var password = $("#password").val();
            if (!username) {
                $('.info-change').html("Username is incorrect.");
                $("#username").focus();
            } else if (!password) {
                $('.info-change').html("Password is incorrect.");
                $("#password").focus();
            }
            else
            {
                $.post(
                    '/user/ajax_login.php',
                    {
                        password : password,
                        username : username,
                    },
                    function (result){
                        if(result.status){
                            $('.info-change').html("Logged in successfully.");
                            setTimeout(function(){
                                window.location.href = '/';
                            }, 500);
                        }
                        else{
                            $('.info-change').html(result.msg);
                        }
                    },
                    'JSON'
                );
            }
        }
</script>
    <header>
        <nav class="content">
            <ul>
                <li><a href="/" class="active"><i class="icon-menu"></i> <span>Homepage</span></a></li>
                <li><a href="/tin-tuc" ><i class="icon-menu"></i> <span>News</span></a></li>
                <li><a href="/su-kien" ><i class="icon-menu"></i> <span>Events</span></a></li>
                <li class="player">
                <a href="javascript:;" onclick="popup('link','/server')">
                <object type="application/x-shockwave-flash" data="/frontend/images/chien.swf" width="142" height="107">
                <param name="wmode" value="transparent" />
                <param name="allowfullscreen" value="true" />
                <param name="scale" value="exactfit" />
                <param name="quality" value="high" />
                <param name="play" value="true" />
                <param name="movie" value="/frontend/images/chien.swf" />
                <param name="FlashVars" value="linkValue=">
                <embed type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" src="/frontend/images/chien.swf" wmode="transparent" allowfullscreen="true" scale="exactfit" quality="best" play="true" width="149" height="147"/>
                </object>
                </a>
                </li>
                <li><a href="/cam-nang" ><i class="icon-menu"></i> <span>Guides</span></a></li>
                <li><a class="" href="http://facebook.com/game.toandaik" target="_blank"><i class="icon-menu"></i> <span>Community</span></a></li>
                <li><a class="" href="http://facebook.com/game.toandaik" target="_blank"><i class="icon-menu"></i> <span>Support</span></a></li>
            </ul>
        </nav>
    </header>

<div class="content content-main">
<section class="section_1">
    <div class="w250 register">
        <div class="box-head">
            <a href="javascript:;" onclick="popup('link','/server')" class="btn"><span class="btn-head">LOGIN</span></a>
        </div>
    <div class="main-login">
	<?php if(@$_SESSION['username']){ ?>
	<div class="box-user">
        <p class="username">Welcome, 
            <span title="<?php echo $_SESSION['username'];?>" ><?php echo $_SESSION['username'];?>.</span>
        </p>
        <p class="profile">
            <a href="/thong-tin-tai-khoan">Account Information</a>
            <span>|</span>
            <a href="/thoat">Logout</a>
        </p>
        <p><a class="btn-his-play" href="/server"></a></p>
        <div class="his-play">
            <p>Playing on Server</p>
                <ul class="server">
                    <li><a>Darkwood <?php echo $userInfo['last_server'] ?></a><i class="icon-new"></i></li>
				</ul>
        </div>
                </div><!--end .box-user-->
    <?php }else { ?>
	<div class="box-login" style="">
    <form id="login-home" onsubmit="card_login();return false;">
	<p class="info-change" style="text-align: center; color: red; font-size: 13px;"></p>
	<div class="form-input">
		<input id="username" name="username" type="text" placeholder="Username">
		<input id="password" type="password" name="password" value="" placeholder="Password">
	</div>
    <!-- <a href="javascript:void(0);" class="pull-right btn-login" title="Login"></a> -->
    <input type="submit" class="pull-right btn-login" title="Login" value="" /><!-- btn đăng nhập-->
    <p><a href="/quen-mat-khau" class="btn-fogot">Forgot password?</a></p>
    <div class="line"></div>
    <div class="openid">
		<a href="javascript:;" onclick="window.open('','Login Google','menubar=1,resizable=1,width=550,height=350')"></a>
		<a href="javascript:;" onclick="window.open('','Login Facebook','menubar=1,resizable=1,width=750,height=550')"></a>
		<a href="javascript:;" onclick="window.open('','Login Google','menubar=1,resizable=1,width=550,height=350')"></a>
		<a href="javascript:;" onclick="window.open('','Login Facebook','menubar=1,resizable=1,width=750,height=550')"></a>
		<a href="javascript:;" onclick="window.open('','Login Google','menubar=1,resizable=1,width=550,height=350')"></a>
		<label for="">Login with:</label>
    </div>
</form>
<!-- /.box-login -->
                </div><!--end .box-login-->
    <?php } ?>				
        </div><!--end .main-login-->
    </div><!--end .register-->

    <div class="w250 napcard">
        <div class="box-head">
            <a href="javascript:;" onclick="popup('link','/nap-the')" class="btn nap-the" title="Media"><span class="btn-head">MEDIA</span></a>
        </div>
        <div class="box-video">
            <a class="fancybox-media fancybox.iframe" href="https://www.youtube.com/watch?v=ztKHUVBxIao?autoplay=1">
                <img src="/frontend/images/bg-video.png" alt="">
            </a>
        </div>
    </div><!--end .nap-card-->

    <div class=" w500 box-server">
        <div class="box-head">
            <h3><i class="icon-before"></i>SERVER LIST <a href="javascript:;" onclick="popup('link','/server')" class="icon-plus">+</a></h3>
        </div>
        <div class="box-list-sv">
            <ul class="server sv-new new">
			<?php
            $newest = get1NewestServer();
            foreach ($newest as $svId => $sv):
            ?>
            <li><a class="btn-server sprite-list-server" href="<?php echo $url ?>"><span><?php echo $sv['name'] ?></span></a><i class="icon-new"></i></li></ul>
            <?php endforeach; ?>
			</ul>
            <ul class="server sv-new hot">
            </ul>
            <div class="btn-group">
                <select name="" onChange="window.open('/choi-game/'+this.value,'_top');" class="list-server">
                <option value="">Select Server</option>
				<?php generateServerSelect1(); ?>
                </select>
                <a href="javascript:;" onclick="popup('link','/server')" class="btn btn-view" >Connect</a>
            </div>
    <div id="list-sv-home">
                <ul class="sb-pagination">
                </ul>
        <div class="content-tab">
            <div id="tab1" class="tab-content">
                 <ul class="server content-tab" id="tab_sv1">
				 <?php
				 $newest = get8sv();
				 foreach ($newest as $svId => $sv):
				 ?>
				 <li><a class="btn-server sprite-list-server" href="/choi-game/<?php echo $svId ?>"><span><?php echo $sv['name'] ?></span></a></li>
                 <?php endforeach; ?>
				 </ul>
            </div><!--end #list-sv-home-->
        </div>
    </div><!--end .box-server-->

</section><!--end .section_1-->

<section class="section_2">
    <div class="box-item">
        <a href="javascript:;" title="mini client"><img src="/frontend/images/miniclient.png" alt=""></a>
    </div>
    <div class="box-item">
        <a href="javascript:void(0);" data-id="1" title="Giftcode" data-user="" data-url="" class="btn-reward login">
            <img src="/frontend/images/giftcode.png" alt="">
        </a>
    </div>
    <div class="box-item">
        <a href="/cam-nang" title="Functions"><img src="/frontend/images/tinhnang.png" alt=""></a>
    </div>
    <div class="box-item">
        <a href="/cam-nang" title="Advanced"><img src="/frontend/images/nangcao.png" alt=""></a>
    </div>
    <div class="box-item">
        <a href="/cam-nang" title="Featured"><img src="/frontend/images/dacsac.png" alt=""></a>
    </div>
</section><!--end .section_2-->

<section class="section_3">
    <div class="w250 box-a">
        <span class="bg-box-a"></span>
        <div class=" box-cskh">
            <div class="box-head">
                <h3><i class="icon-before"></i> CUSTOMER CARE </h3>
            </div>
            <div class="line"></div>
            <a href="https://www.facebook.com/" class="cskh" title="Customer Care" target="_blank"></a>
            <img src="/frontend/images/cskh-hotline.png" alt="" style="display: block; margin:0 auto;">
        </div><!--end .box-cskh-->

        <div class="box-fanpage">
            <div class="box-head">
                <h3>FANPAGE</h3>
            </div>
            <div class="line"></div>
            <div class="fanpage">
                <div class="fb-page" data-href="https://www.facebook.com/" data-tabs="timeline" data-width="236" data-height="285" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="" class="fb-xfbml-parse-ignore">
                        <a href="https://www.facebook.com/game.toandaik">Fanpage</a>
                    </blockquote>
                </div>
            </div>
        </div><!--end .fanpage-->
        <span class="bg-box-a"></span>
    </div><!--end .box-a-->

