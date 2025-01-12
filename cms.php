<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/page/header.php'); ?>
<?php 
$slug = $_GET['slug'];
$type = $_GET['type'];
$result = $dbh->query("SELECT * FROM `cms` WHERE `slug` = '{$slug}' AND `type` LIKE '{$type}%' LIMIT 1")->fetch();
if ($result === false) {
    exit;
}
$latest = $dbh->query("SELECT `type`, `slug`, `title`, `date` FROM `cms` WHERE `type` LIKE '{$type}%' AND `slug` != '{$slug}' ORDER BY `id` DESC LIMIT 10")->fetchAll();
?>
<div class="box-b">
	<div class="box-head" style="background:#2F4244; line-height:22px;">
		<h3><i class="icon-before"></i><?php if ($type == 'tintuc'): ?>TIN TỨC<?php elseif ($type == 'sukien'): ?>SỰ KIỆN<?php else: ?>CẨM NANG<?php endif; ?></h3>
        <div class="breadcrumb"> <a href="/"> Trang chủ</a> › <?php if ($type == 'tintuc'): ?><a href="/tin-tuc"> Tin tức </a><?php elseif ($type == 'sukien'): ?><a href="/su-kien"> Sự kiện </a><?php else: ?><a href="/cam-nang"> Cẩm nang </a><?php endif; ?></div>
	</div>
	<div class="line"></div>
	<div class="content-detail">				
		<div class="content-news ">
			<h2 class="title_new"><?php echo $result['title']?></h2>
			<p class="date-pbublish">Ngày đăng: <?php echo $result['date']?></p>
			<div style="border-top: 1px solid #43413e;padding-bottom: 20px;"></div>		
        <p>
		<?php echo $result['content'] ?>
		</p>
        <h5><span style="font-size:12px;">Tiểu Kiều kính bút!</span><br>
        </h5>
        <div class="line"></div>
		</div>
    </div>
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/page/footer.php'); ?>