<?php session_start();
if (!$_SESSION['login']) exit("<script> alert('Vui lòng đăng nhập!');location.href='/';</script>");
?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/page/header.php'); ?>
<link rel="stylesheet" type="text/css" href="/frontend/css/pagedonate.css">
<link rel="stylesheet" type="text/css" href="/frontend/css/skin_payments.css">
<link rel="stylesheet" type="text/css" href="/frontend/css/baokim.css">
<div class="box-b" style="padding: 0 10px; width:730px;">
<div class="box-head" style="background:#2F4244; line-height:22px;">
		<h3><i class="icon-before"></i>NẠP THẺ</h3>
			<div class="breadcrumb">
				<a href="/">Trang chủ</a> &gt;
				<a href="/nap-the" class="active">Nạp thẻ</a>
			</div>
	</div>
	<div class="line"></div>
<div class="content-detail">
    <div class="box_donate">
        <div class="wapper">
            <div class="card-row">
                <div class="frm-nap">
                    <div class="title-card">NẠP THẺ BẰNG THẺ CÀO</div>
                    <form action="transaction.php" method="post" id="form_charge">
                        <p>
                            <span class="frm-label">Chọn loại thẻ : <font color="red">*</font></span>
                                <select name="chonmang">
									<option value="">-- Chọn nhà mạng --</option>
                                    <option value="VIETEL">Viettel</option>
                                    <option value="MOBI">Mobifone</option>
                                    <option value="VINA">Vinaphone</option>
                                    <option value="GATE">Gate</option>
                                </select>
                        </p>
                        <p>
                            <span class="frm-label">Chọn máy chủ : <font color="red">*</font></span>
                            <?php generateServerSelect(); ?>
                        </p>
                        <p><span class="frm-label">Nhập số Seri : <font color="red">*</font></span><input class="frm-input" id="txtseri" name="txtseri" type="text" required></p>
                        <p><span class="frm-label">Nhập mã Pin : <font color="red">*</font></span><input class="frm-input" id="txtpin" name="txtpin" type="text" required></p>
                        <p><span class="frm-label">&nbsp;</span>
				<input type="submit" name="napthe" value="NẠP THẺ" class="bt-nap btn_napthe_2016">
				</p>
                        <p class="ketqua-kiemtra" style="text-align: center; width: 100%;  color: red; font-size: 14px"> </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
   .detail_page .title h3{line-height: 56px;}
</style>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/page/footer.php'); ?>