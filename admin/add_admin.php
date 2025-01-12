<?php include_once('page/header.php') ?>
    <form id="validation" action="manage/add_admin.php" method="post">
        <?php
        $id = $_GET['id'];
        $formData = array();
        if ($_GET['id']) {
            include_once '../db/connect.php';
            $formData = $dbh->query("SELECT * FROM `admin_user` WHERE `id` = '{$id}'")->fetch();
        }
        ?>
        <?php if ($formData !== false && $id): ?>
            <input type="hidden" name="id" value="<?php echo $id ?>" />
        <?php else: ?>
            <?php $formData = array() ?>
        <?php endif; ?>
        <div class="row-fluid">
            <div class="span12">
                <div class="head">
                    <div class="isw-documents"></div>
                    <h1>Thêm admin</h1>
                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <div class="row-form">
                        <div class="span3">Tên đăng nhập:</div>
                        <div class="span9"><input type="text" name="username" class="validate[required]" value="<?php echo $formData['username'] ?>"/></div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="block-fluid">
                    <div class="row-form">
                        <div class="span3">Mật khẩu:</div>
                        <div class="span9"><input type="password" name="password" class="validate[required]" value=""/></div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="block-fluid">
                    <div class="row-form">
                        <div class="span3">Nhập lại mật khẩu:</div>
                        <div class="span9"><input type="password" name="cpassword" class="validate[required]" value=""/></div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>

        <button class="btn btn-large btn-primary" type="submit">
            <?php if ($formData !== false && $id): ?>
                Cập nhật
            <?php else: ?>
                Đồng ý
            <?php endif; ?>
        </button>
        <?php if ($formData !== false && $id): ?>
            <a class="btn btn-large btn-default" href="/admin/admin_user.php">Quay lại</a>
        <?php endif; ?>
    </form>
<?php include_once('page/footer.php') ?>