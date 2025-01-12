<?php session_start();
if (!$_SESSION['login']) exit("<script> alert('Vui lòng đăng nhập!');location.href='/';</script>");
?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/page/header.php'); ?>
<div class="box-b" style="padding: 0 10px; width:730px;">
<div class="box-head" style="background:#2F4244; line-height:22px;">
		<h3><i class="icon-before"></i>THÔNG TIN TÀI KHOẢN</h3>
			<div class="breadcrumb">
				<a href="/">Trang chủ</a> &gt;
				<a href="/thong-tin-tai-khoan" class="active">Thông tin tài khoản</a>
			</div>
	</div>
	<div class="line"></div>
<div class="content-detail">
    <div class="infomation">
            <p><label>Tên đăng nhập:</label><?php echo $username ?></p>
            <p><label>Địa chỉ Emal:</label><?php echo $userInfo['email'] ?></p>
            <p><label>Số điện thoại:</label><?php echo $userInfo['phone'] ?></p>
            <p><label>Máy chủ vừa chọn:</label>Máy chủ S<?php echo $userInfo['last_server'] ?></p>
			<p><label>&nbsp;</label><a style="padding: 5px 20px;" id="change-pass" href="/doi-mat-khau" target="_blank">Đổi mật khẩu</a></p>
    </div>
</div>

<style type="text/css">
    .title h3{text-align: center; color: #fff; font-size: 14px}
    .infomation{margin: 0 auto;}
    .mss_u_fg{font-size: 13px;}
    .detail_page .title h3{line-height: 56px;}
    .infomation p{height: 30px; line-height: 30px; margin: 0; color: #fff; width: 100%; margin-bottom: 10px;font-size: 14px;}
    .infomation p label{display: block; width: 160px; float: left; height: 30px; line-height: 30px; font-size: 14px; color: #A0AFB7; padding-left: 100px;}
    .infomation p input{float: left; width: 200px; padding: 2px 4px; height: 28px; color: #A0AFB7;}
    #change-pass{width: 80px; background: #428bca; border: 1px solid #357ebd; color: #fff; font-weight: bold; height: 30px;}
</style>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/page/footer.php'); ?>