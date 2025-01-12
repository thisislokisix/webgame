<?php include_once('page/header.php') ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="head">
                <div class="isw-grid"></div>
                <h1>Quản lý Admin</h1>
                <ul class="buttons">
                    <li>
                        <a href="#" class="isw-settings"></a>
                        <ul class="dd-list">
                            <li><a href="/admin/add_admin.php"><span class="isw-plus"></span> Thêm tài khoản</a></li>
                            <li><a href="javascript:void(0);" onclick="multiDelete();"><span class="isw-delete"></span> Xóa Admin</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="block-fluid table-sorting">
                <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_col3">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="checkall"/></th>
                        <th width="10%">ID</th>
                        <th width="30%">Tên đăng nhập</th>
                        <th width="40%">Quyền</th>
                        <th width="20%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include_once '../db/connect.php';
                    $data = $dbh->query("SELECT * FROM `admin_user`")->fetchAll();
                    $areaMaps = json_decode(file_get_contents('http://'. $_SERVER['HTTP_HOST'] .'/admin/get/navigation.php?area=1'), true);
                    foreach ($data as $item):
                        ?>
                        <tr>
                            <td><input type="checkbox" name="checkbox" class="checkbox_item"/></td>
                            <td class="itemId"><?php echo $item['id'] ?></td>
                            <td><?php echo $item['username'] ?></td>
                            <td>
                                <?php
                                if ($item['area'] == '') {
                                    echo 'Toàn bộ';
                                } else {
                                    $areas = json_decode($item['area']);
                                    foreach ($areas as $area) {
                                        echo '<p>' . $areaMaps[$area] . '</p>';
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <a href="/admin/add_admin.php?id=<?php echo $item['id'] ?>">Sửa</a>
                                &nbsp;
                                <a href="javascript:void(0)" onclick="deleteAdmin('<?php echo $item['id'] ?>');">Xóa</a>
                                &nbsp;
                                <a href="/admin/admin_auth.php?id=<?php echo $item['id'] ?>">Phân quyền</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script>
        $("#tSortable_col3").dataTable({"iDisplayLength": 5, "aLengthMenu": [25,50,100,200,500], "sPaginationType": "full_numbers", "aoColumns": [ { "bSortable": false }, null, null, null, { "bSortable": false }]});
        function deleteAdmin(id) {
            var msg = 'Bạn chắc chắn muốn xóa tài khoản quản trị viên này?';
            if (confirm(msg)) {
                location.href = '/admin/manage/delete_admin.php?id=' + id;
            }
            return false;
        }
        function multiDelete(status) {
            if ($('.checkbox_item:checked').length == 0) {
                alert('Vui lòng chọn tài khoản admin!');
                return false;
            }
            var idArray = [];
            $('.checkbox_item:checked').each(function(index, elem) {
                idArray.push(parseInt($(elem).closest('td').next().text()));
            });
            var ids = idArray.join(),
                msg = 'Bạn chắc chắn muốn xóa những tài khoản admin này?';
            if (confirm(msg)) {
                location.href = '/admin/manage/delete_admin.php?multiple=1&id=' + ids;
            }
            return false;
        }
    </script>
<?php include_once('page/footer.php') ?>