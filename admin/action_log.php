<?php
session_start();
if (!$_SESSION['admin_login']) {
    header('location: /');
    exit;
}
include_once($_SERVER['DOCUMENT_ROOT'] . '/function/json.php');
if (isset($_GET['ajax'])) {
    include_once($_SERVER['DOCUMENT_ROOT'] . '/db/connect.php');

    $search = $_GET['search'] ? : array();
    $searchQuery = "";
    foreach ($search as $key => $value) {
        $searchQuery .= " AND `" . $key . "` LIKE '%" . $value . "%'";
    }

    $offset = ($_GET['page'] - 1) * $_GET['show'];
    $data = $dbh->query("SELECT `id`, `admin_user`, `ip`, `action`, `time` FROM `admin_action_log` WHERE 1 = 1". $searchQuery ." ORDER BY `{$_GET['sort']}` {$_GET['dir']} LIMIT {$_GET['show']} OFFSET {$offset}")->fetchAll(PDO::FETCH_ASSOC);
    $count = $dbh->query("SELECT count(id) as total FROM `admin_action_log` WHERE 1 = 1" . $searchQuery)->fetch(PDO::FETCH_ASSOC);

    extractJsonFromData($_GET, $data, $count['total']);
}
?>
<?php include_once('page/header.php') ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="head">
                <div class="isw-grid"></div>
                <h1>Lịch sử hoạt động</h1>
                <div class="clear"></div>
            </div>
            <div class="block-fluid table-sorting">
                <?php
                $fields = array(
                    'id' => array(
                        'name' => 'ID',
                        'width' => '10%',
                    ),
                    'admin_user' => array(
                        'name' => 'Admin',
                        'width' => '15%',
                    ),
                    'ip' => array(
                        'name' => 'IP',
                        'width' => '15%',
                    ),
                    'action' => array(
                        'name' => 'Hoạt động',
                        'width' => '45%',
                    ),
                    'time' => array(
                        'name' => 'Thời gian',
                        'width' => '15%',
                    ),
                );
                renderGridHtml($fields);
                ?>
            </div>
        </div>
    </div>
<?php include_once('page/footer.php') ?>