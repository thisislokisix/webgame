<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/page/header.php'); ?>
<div class="box-b" style="padding: 0 10px; width:730px;">
<div class="box-head" style="background:#2F4244; line-height:22px;">
		<h3><i class="icon-before"></i>QUÊN MẬT KHẨU</h3>
			<div class="breadcrumb">
				<a href="/">Trang chủ</a> &gt;
				<a href="/quen-mat-khau" class="active">Quên mật khẩu</a>
			</div>
	</div>
	<div class="line"></div>
<div class="content-detail">
    <div class="infomation">
        <form id="changepwdform" action="/user/reset_password.php" method="post">
            <p style="margin:auto;font-size:14px;color:red;font-weight:bold;text-align:center;">
                                    <?php
                                    if ($_SESSION['global_message']) {
                                        echo $_SESSION['global_message'];
                                        unset($_SESSION['global_message']);
                                    }
                                    ?>
            </p>
            <p><label for="Tên tài khoản">Tên tài khoản:</label><input name="name" id="name" type="text" required></p>
            <p><label for="Địa chỉ Email">Địa chỉ Email:</label><input name="email" id="email" type="text" required></p>
            <p><label for="Số điện thoại">Số điện thoại:</label><input name="phone" id="phone" type="text" required></p>
			<p><label for="Mật khẩu cũ">Mật khẩu mới:</label><input name="new_pass" id="new_pass" type="password" required></p>
            <p><label for="Mật khẩu cũ">Nhập lại mật khẩu:</label><input name="new_pass_confirm" id="new_pass_confirm" type="password" required></p>
            <p><label for="Mật khẩu cũ">&nbsp;</label><input style="padding: 2px 20px;" type="submit" id="forgetPass" value="Lấy"></p>
        </form>
    </div>
</div>

<style type="text/css">
    .title h3{text-align: center; color: #fff; font-size: 14px}
    .infomation{margin: 0 auto;}
    .mss_u_fg{font-size: 13px;}
    .detail_page .title h3{line-height: 56px;}
    .infomation p{height: 30px; line-height: 30px; margin: 0; color: #fff; width: 100%; margin-bottom: 10px;}
    .infomation p label{display: block; width: 160px; float: left; height: 30px; line-height: 30px; font-size: 14px; color: #A0AFB7; padding-left: 100px;}
    .infomation p input{float: left; width: 200px; padding: 2px 4px; height: 28px; color: #A0AFB7;}
    #forgetPass{width: 80px; background: #428bca; border: 1px solid #357ebd; color: #fff; font-weight: bold; height: 30px;}
</style>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/page/footer.php'); ?>