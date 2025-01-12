<?php include_once('page/header.php') ?>
    <link rel="stylesheet" href="/admin/js/plugins/datetimepicker/jquery.datetimepicker.css"/>
    <script src="/admin/js/plugins/datetimepicker/jquery.datetimepicker.js"></script>
    <form id="validation" action="manage/add_noidung.php" method="post">
        <?php
        $id = $_GET['id'];
        $formData = array();
        if ($_GET['id']) {
            include_once '../db/connect.php';
            $formData = $dbh->query("SELECT * FROM `cms` WHERE `id` = '{$id}'")->fetch(PDO::FETCH_ASSOC);
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
                    <h1>Đăng bài mới</h1>
                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <div class="row-form">
                        <div class="span3">Thể loại:</div>
                        <div class="span9">
                            <select name="type" class="validate[required]">
                                <option value="">choose a option...</option>
                                <option value="sukien"<?php if ($formData['type'] == 'sukien'): ?> selected<?php endif; ?>>Sự kiện</option>
                                <option value="tintuc"<?php if ($formData['type'] == 'tintuc'): ?> selected<?php endif; ?>>Tin tức</option>
                                <option value="camnang"<?php if ($formData['type'] == 'camnang'): ?> selected<?php endif; ?>>Cẩm nang</option>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="row-form">
                        <div class="span3">Tiêu đề:</div>
                        <div class="span9"><input type="text" name="title" class="validate[required]" value="<?php echo $formData['title'] ?>"/></div>
                        <div class="clear"></div>
                    </div>

                    <div class="row-form">
                        <div class="span3">Ngày đăng:</div>
                        <div class="span9"><input type="text" name="date" class="validate[required]" id="mask_date" value="<?php echo empty($formData['date']) ? date('d/m/Y') : $formData['date'] ?>"/></div>
                        <div class="clear"></div>
                    </div>

                    <div class="row-form">
                        <div class="span3">Ngày xuất bản:</div>
                        <div class="span9"><input type="text" id="published_time" name="published_time" value="<?php echo empty($formData['published_time']) ? '0000-00-00 00:00:00' : $formData['published_time'] ?>" required/></div>
                        <div class="clear"></div>
                    </div>

                    <div class="row-form">
                        <div class="span3">Upload ảnh:</div>
                        <div class="span9">
                            <button type="button" id="manage_media">Quản lý ảnh upload</button>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-favorite"></div>
                    <h1>Nội dung</h1>
                    <div class="clear"></div>
                </div>
                <div class="block-fluid" id="wysiwyg_container">
                    <textarea id="wysiwyg" name="content" style="height: 300px;"><?php echo $formData['content'] ?></textarea>
                </div>
            </div>

        </div>

        <button class="btn btn-large btn-primary" type="submit">
            <?php if ($formData !== false && $id): ?>
                Cập nhật bài đăng
            <?php else: ?>
                Đăng bài
            <?php endif; ?>
        </button>
        <?php if ($formData !== false && $id): ?>
            <a class="btn btn-large btn-default" href="/admin/noidung.php">Quay lại</a>
        <?php endif; ?>
    </form>
    <script>
        jQuery(function($) {
            $('#published_time').datetimepicker({format: 'Y-m-d H:i:s'});
            $('#manage_media').fancybox({
                href: '/admin/manage/upload.php',
                type: 'iframe'
            });
        });
    </script>
<?php include_once('page/footer.php') ?>