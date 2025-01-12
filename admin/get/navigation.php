<?php
$navigation = array(
    array(
        'href' => 'index.php',
        'class' => 'isw-grid',
        'label' => 'Thẻ cào'
    ),
    array(
        'href' => 'admin_user.php',
        'class' => 'isw-archive',
        'label' => 'Quản lý Admin'
    ),
    array(
        'href' => 'noidung.php',
        'class' => 'isw-text_document',
        'label' => 'Quản lý tin tức',
    ),
	array(
        'href' => 'web_config.php',
        'class' => 'isw-picture',
        'label' => 'Chỉnh sửa Slider',
    ),
	array(
        'href' => 'knb.php',
        'class' => 'isw-ok',
        'label' => 'Thêm KNB',
    ),
    array(
        'href' => 'action_log.php',
        'class' => 'isw-grid',
        'label' => 'Lịch sử hoạt động',
    )
);
if (isset($_GET['area']) && $_GET['area'] = 1) {
    $areas = array();
    foreach ($navigation as $item) {
        $area = str_replace('.php', '', $item['href']);
        $areas[$area] = $item['label'];
    }
    echo json_encode($areas);
    exit;
}

echo json_encode($navigation);
