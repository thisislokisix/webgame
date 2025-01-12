<?php include_once('page/header.php') ?>
    <form id="validation" action="manage/admin_auth.php" method="post">
        <?php
        if (is_array($_SESSION['admin_area']) && !in_array('admin_user', $_SESSION['admin_area'])) {
            header('location: /admin');
            exit;
        }

        $id = $_GET['id'];
        include_once '../db/connect.php';
        $formData = $dbh->query("SELECT * FROM `admin_user` WHERE `id` = '{$id}'")->fetch();
        if ($formData == false) {
            header('location: /admin/admin_user.php');
            exit;
        }

        $isSuperAdmin = $formData['area'] == '' ? true : false;
        if (!$isSuperAdmin) {
            $authArea = (array) json_decode($formData['area']);
        }

        $areas = json_decode(file_get_contents('http://'. $_SERVER['HTTP_HOST'] .'/admin/get/navigation.php?area=1'), true);
        ?>
        <input type="hidden" name="id" value="<?php echo $id ?>" />
        <div class="row-fluid">
            <div class="span12">
                <div class="head">
                    <div class="isw-documents"></div>
                    <h1>Phân quyền admin</h1>
                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <div class="row-form">
                        <div class="span3"><?php echo $formData['username'] ?></div>
                        <div class="span9">
                            <label class="checkbox">
                                <input type="checkbox"<?php if ($isSuperAdmin): ?> checked<?php endif; ?> id="area_all" class="skip" name="area_all" value="all"/>
                                Full quyền
                            </label>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="row-form">
                        <div class="span3">&nbsp;</div>
                        <div class="span9">
                            <?php foreach ($areas as $code => $area): ?>
                                <label class="checkbox">
                                    <input type="checkbox"<?php if ($isSuperAdmin || in_array($code, $authArea)): ?> checked<?php endif; ?> class="area_item skip" name="area[]" value="<?php echo $code ?>"/>
                                    <?php echo $area; ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dr"><span></span></div>

        <button class="btn btn-large btn-primary" type="submit">Đồng ý</button>
        <a class="btn btn-large btn-default" href="/admin/admin_user.php">Quay lại</a>
    </form>
    <script>
        jQuery(function($) {
            $('#area_all').change(function() {
                var check = this.checked;
                $('.area_item').each(function(index, elem) {
                    $(elem).prop('checked', check);
                });
            });
            $('.area_item').change(function() {
                if ($('.area_item:checked').length == $('.area_item').length) {
                    $('#area_all').prop('checked', true);
                } else {
                    $('#area_all').prop('checked', false);
                }
            });
        });
    </script>
<?php include_once('page/footer.php') ?>