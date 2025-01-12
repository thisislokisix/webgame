<?php session_start();
if (!$_SESSION['login']) exit("<script> alert('Vui lòng đăng nhập!');location.href='/';</script>");
?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/page/header.php'); ?>
<div class="box-b" style="padding: 0 10px; width:730px;">
<div class="box-head" style="background:#2F4244; line-height:22px;">
		<h3><i class="icon-before"></i>DANH SÁCH MÁY CHỦ</h3>
			<div class="breadcrumb">
				<a href="/">Trang chủ</a> &gt;
				<a href="/server" class="active">Máy chủ</a>
			</div>
	</div>
	<div class="line"></div>
<div class="content-detail">
    <div class="box-list-sv">
		<ul class="server sv-new new">
			<?php
            $newest = get1NewestServer();
            foreach ($newest as $svId => $sv):
            ?>
            <li><a class="btn-server sprite-list-server" href="/choi-game/<?php echo $svId ?>"><span><?php echo $sv['name'] ?></span></a><i class="icon-new"></i></li></ul>
            <?php endforeach; ?>
	    </ul>
		<div class="btn-group">
            <select name="" onChange="window.open('/choi-game/'+this.value,'_top');" class="list-server">
            <option value="">Chọn máy chủ</option>
		    <?php generateServerSelect1(); ?>
            </select>
            <a href="javascript:;" class="btn btn-view" >Kết nối</a>
        </div>
        <div id="list-sv-home">
            <ul class="server content-tab1" id="tab_sv1">
            <?php foreach ($servers as $svId => $sv): ?>												
            <li style="padding: 5px 0 0 0px;"><a class="btn-server sprite-list-server" href="/choi-game/<?php echo $svId ?>"><span><?php echo $sv['name'] ?></span></a></li>
			<?php endforeach; ?>
			</ul>                            
        </div>
	</div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/page/footer.php'); ?>
