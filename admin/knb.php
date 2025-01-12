<?php include_once('page/header.php') ?>
    <form id="validation" action="/admin/manage/add_knb.php" method="post">
        <div class="row-fluid">
            <div class="span12">
                <div class="head">
                    <div class="isw-documents"></div>
                    <h1>Thêm KNB</h1>
                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <div class="row-form">
                        <div class="span3">Server:</div>
                        <div class="span9">
                            <?php
                            include_once '../function/server.php';
                            generateServerSelect('server_id');
                            ?>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="row-form">
                        <div class="span3">Tài khoản:</div>
                        <div class="span9"><input type="text" name="username" class="validate[required]" /></div>
                        <div class="clear"></div>
                    </div>

                    <div class="row-form">
                        <div class="span3">Số KNB:</div>
                        <div class="span9"><input type="number" name="knb" class="validate[required]" /></div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dr"><span></span></div>
        <button class="btn btn-large btn-primary" type="submit">Thêm </button>
    </form>
<?php include_once('page/footer.php') ?>