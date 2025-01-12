<?php
session_start();
if (!$_SESSION['admin_login']) {
    header('location: /admin/login.php');
    exit;
}
include_once($_SERVER['DOCUMENT_ROOT'] . '/function/json.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/db/connect.php');
if (isset($_GET['ajax'])) {
    $search = $_GET['search'] ? : array();
    $searchQuery = "";
    foreach ($search as $key => $value) {
        if ($key == 'server_id' && !empty($value)) {
            $serverIdInt = intval(preg_replace('/[^0-9]+/', '', $value));
            if ($serverIdInt) {
                $searchQuery .= " AND `server_id` = '" . $serverIdInt . "'";
            }
        } else {
            $searchQuery .= " AND `" . $key . "` LIKE '%" . $value . "%'";
        }
    }

    $offset = ($_GET['page'] - 1) * $_GET['show'];
    $data = $dbh->query("SELECT id, account, card_pin, card_serial, service, date, cost, CONCAT('s', server_id) as server_id FROM `card_transaction` WHERE 1 = 1". $searchQuery ." ORDER BY `{$_GET['sort']}` {$_GET['dir']} LIMIT {$_GET['show']} OFFSET {$offset}")->fetchAll(PDO::FETCH_ASSOC);
    $count = $dbh->query("SELECT count(id) as total FROM `card_transaction` WHERE 1 = 1" . $searchQuery)->fetch(PDO::FETCH_ASSOC);

    extractJsonFromData($_GET, $data, $count['total']);
}
?>
<?php include_once('page/header.php') ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="head">
                <div class="isw-grid"></div>
                <h1>Thẻ cào</h1>
                <div class="clear"></div>
            </div>
            <div class="block">
                <div class="row-form">
                    <div class="span3">
                        <?php
                        $card = array();
                        $card['Viettel'] = $dbh->query("SELECT SUM(cost) as total FROM card_transaction WHERE service = 'Viettel'")->fetch(PDO::FETCH_OBJ)->total ? : 0;
                        $card['Vina'] = $dbh->query("SELECT SUM(cost) as total FROM card_transaction WHERE service = 'Vinaphone'")->fetch(PDO::FETCH_OBJ)->total ? : 0;
                        $card['Mobi'] = $dbh->query("SELECT SUM(cost) as total FROM card_transaction WHERE service = 'Mobifone'")->fetch(PDO::FETCH_OBJ)->total ? : 0;
                        $card['Gate'] = $dbh->query("SELECT SUM(cost) as total FROM card_transaction WHERE service = 'Gate'")->fetch(PDO::FETCH_OBJ)->total ? : 0;
                        $card['VTC'] = $dbh->query("SELECT SUM(cost) as total FROM card_transaction WHERE service = 'VTC'")->fetch(PDO::FETCH_OBJ)->total ? : 0;
                        $total = $dbh->query("SELECT SUM(cost) as total FROM card_transaction")->fetch(PDO::FETCH_ASSOC);
                        $todayDate = date("Y-m-d");
                        $today = $dbh->query("SELECT SUM(cost) as total FROM card_transaction WHERE date(`date`) = '{$todayDate}'")->fetch(PDO::FETCH_OBJ)->total;
                        ?>
                        <table style="width:100%">
                            <tr>
                                <td><b>Hôm nay:</b></td>
                                <td><?php echo number_format($today) ?></td>
                            </tr>
                            <tr>
                                <td><b>Tổng:</b></td>
                                <td><?php echo number_format($total['total']) ?></td>
                            </tr>
                            <tr>
                                <td><b>Viettel:</b></td>
                                <td><?php echo number_format($card['Viettel']) ?></td>
                            </tr>
                            <tr>
                                <td><b>Vina:</b></td>
                                <td><?php echo number_format($card['Vina']) ?></td>
                            </tr>
                            <tr>
                                <td><b>Mobi:</b></td>
                                <td><?php echo number_format($card['Mobi']) ?></td>
                            </tr>
                            <tr>
                                <td><b>Gate:</b></td>
                                <td><?php echo number_format($card['Gate']) ?></td>
                            </tr>
                            <tr>
                                <td><b>VTC:</b></td>
                                <td><?php echo number_format($card['VTC']) ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="span9">
                        <div id="pie-chart" style="height:300px;"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="block-fluid table-sorting">
                <?php
                $fields = array(
                    'id' => array(
                        'name' => 'ID',
                        'width' => '10%',
                    ),
                    'account' => array(
                        'name' => 'Tài khoản',
                        'width' => '15%',
                    ),
                    'card_pin' => array(
                        'name' => 'Mã thẻ cào',
                        'width' => '15%',
                    ),
                    'card_serial' => array(
                        'name' => 'Số serial',
                        'width' => '15%',
                    ),
                    'service' => array(
                        'name' => 'Nhà mạng',
                        'width' => '10%',
                    ),
                    'date' => array(
                        'name' => 'Ngày',
                        'width' => '15%',
                    ),
                    'cost' => array(
                        'name' => 'Mệnh giá',
                        'width' => '10%',
                    ),
                    'server_id' => array(
                        'name' => 'Server',
                        'width' => '10%',
                    )
                );
                renderGridHtml($fields);
                ?>
            </div>
        </div>
    </div>
    <script>
        jQuery(function($) {
            var cardData = [];
            <?php $i = 0; foreach ($card as $key => $value): ?>
            cardData[<?php echo $i++; ?>] = {label: "<?php echo $key ?>", data: <?php echo $value ?>};
            <?php endforeach; ?>
            //referData[<?php echo $i; ?>] = {label: "Khác", data: <?php echo $otherRefer['count'] ?>};
            $.plot(
                $("#pie-chart"),
                cardData,
                {
                    series: {
                        pie: { show: true }
                    },
                    legend: { show: false }
                }
            );
        });
    </script>
<?php include_once('page/footer.php') ?>