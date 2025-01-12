<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/page/header.php'); ?>
<div class="box-b" style="padding: 0 10px; width:730px;">
	<div class="box-head" style="background:#2F4244; line-height:22px;">
		<h3><i class="icon-before"></i>SỰ KIỆN</h3>
			<div class="breadcrumb">
				<a href="/">Trang chủ</a> &gt;
				<a href="/su-kien" class="active">Sự kiện</a>
			</div>
	</div>
	<div class="line"></div>
	<ul class="news before">
    <?php
    $page = $_GET['p'] ? $_GET['p'] : 1;
    $pageSize = 20;
    $currentOffset = ($page - 1) * $pageSize;
    $totalPage = $dbh->query("SELECT COUNT(id) AS total FROM cms WHERE type = 'sukien'")->fetch();
    $pageLimit = floor($totalPage['total'] / $pageSize) + 1;
        if ($currentOffset >= $totalPage['total']) {
            echo '<script>location.href = "/su-kien?p=' . $pageLimit . '"</script>';
            exit;
        }
    $sqlQuery = "
        SELECT * FROM cms WHERE type = 'sukien'
        ORDER BY id DESC
        LIMIT $currentOffset,$pageSize
        ";
    $sukien = $dbh->query($sqlQuery)->fetchAll();
    foreach ($sukien as $item):
    ?>	
		<li><a href="/su-kien/<?php echo $item['slug'] ?>"><?php echo $item['title'] ?></a><span><?php echo $item['date'] ?></span></li>
    <?php endforeach; ?>
	</ul>
	<div class="clear"></div>
    <ul class="pagination">   
    <?php for ($i = 1; $i <= $pageLimit; $i++): ?>
	<?php if ($i == $page): ?>
        <a><?php echo $i ?></a>
	<?php else: ?>
	    <a href="/su-kien?p=<?php echo $i ?>"><?php echo $i ?></a>
	<?php endif; ?>
    <?php endfor; ?>
    </ul>		
</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/page/footer.php'); ?>