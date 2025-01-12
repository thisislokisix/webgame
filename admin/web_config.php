<?php include_once('page/header.php') ?>
<?php
include_once '../db/connect.php';
$configData = $dbh->query("SELECT * FROM `config`")->fetchAll();
$loadedConfig = array();
foreach ($configData as $configItem) {
    $loadedConfig[$configItem['key']] = $configItem['value'];
}

$configurations = array(
    array(
        'key' => 'home_banner_1',
        'title' => 'Ảnh Banner 1'
    ),
    array(
        'key' => 'home_banner_1_link',
        'title' => 'Link Ảnh Banner 1'
    ),
    array(
        'key' => 'home_banner_2',
        'title' => 'Ảnh Banner 2'
    ),
    array(
        'key' => 'home_banner_2_link',
        'title' => 'Link Ảnh Banner 2'
    ),
    array(
        'key' => 'home_banner_3',
        'title' => 'Ảnh Banner 3'
    ),
    array(
        'key' => 'home_banner_3_link',
        'title' => 'Link Ảnh Banner 3'
    ),
);
?>
    <link rel="stylesheet" href="/admin/js/plugins/datetimepicker/jquery.datetimepicker.css"/>
    <script src="/admin/js/plugins/datetimepicker/jquery.datetimepicker.js"></script>
    <form action="manage/web_config.php" method="post">
        <div class="row-fluid">
            <div class="span12">
                <div class="head">
                    <div class="isw-documents"></div>
                    <h1>Chỉnh sửa Slider</h1>
                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <?php foreach ($configurations as $configuration): ?>
                        <div class="row-form">
                            <div class="span3"><?php echo $configuration['title'] ?>:</div>
                            <div class="span9">
                                <?php if ($configuration['type'] == 'textarea'): ?>
                                    <textarea name="<?php echo $configuration['key'] ?>" <?php if ($configuration['class']): ?> class="<?php echo $configuration['class'] ?>"<?php endif; ?>><?php echo $loadedConfig[$configuration['key']] ?></textarea>
                                <?php else: ?>
                                    <input type="text" name="<?php echo $configuration['key'] ?>" value="<?php echo $loadedConfig[$configuration['key']] ?>"<?php if ($configuration['class']): ?> class="<?php echo $configuration['class'] ?>"<?php endif; ?> />
                                <?php endif; ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="dr"><span></span></div>
        <button class="btn btn-large btn-primary" type="submit">Lưu thiết lập</button>
    </form>
    <script>
        jQuery(function($) {
            if ($('.datetime_picker').length) {
                $('.datetime_picker').datetimepicker({format: 'Y-m-d H:i:s'});
            }
        });
    </script>
<?php include_once('page/footer.php') ?>
